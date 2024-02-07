<?php

namespace App\Http\Controllers\userAdmin;

use App\Models\AssignTest;
use App\Models\Program;
use App\Models\Lab;
use App\Models\Instrument;
use App\Models\Test;
use App\Models\Method;
use App\Models\Reagent;
use App\Models\Department;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AssignTestController extends Controller
{
    public function index()
    {
        $assignTests = AssignTest::all();
        $departments = Department::all();
        $programs = Program::all();
        $labs = Lab::all();
        $instruments = Instrument::all();
        $tests = Test::all();
        $methods = Method::all();
        $reagents = Reagent::all();

        return view('useradmin.assign-tests', compact('departments', 'assignTests', 'programs', 'labs', 'instruments', 'tests','methods','reagents' ));
    }

    public function fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = [];

        if ($select == 'department_id' && $value != '') {
            // Assuming you have a relationship between Department and Instrument
            $instrumentsData = Instrument::where('department_id', $value)->pluck('instrumentname', 'id');
            $data['instruments'] = $instrumentsData;

            // Fetch reagents based on the selected instrument
            if ($dependent == 'reagent_id' && $request->has('instrument_id') && $request->get('instrument_id') != '') {
                // Assuming Instrument model has a relationship with Reagent model
                $instrument = Instrument::find($request->get('instrument_id'));

                Log::info('Reagents data:', $instrument->reagents);
                // Fetch reagents with their properties
                $data['reagents'] = $instrument->reagents->map(function ($reagent) {
                    return [
                        'id' => $reagent->id,
                        'reagent' => $reagent->reagent,
                        // Add other reagent properties as needed
                    ];
                });

                // Fetch testcodes based on the selected reagent
                if ($request->has('reagent_id') && $request->get('reagent_id') != '') {
                    // Assuming Reagent model has a relationship with Test model
                    $reagent = Reagent::find($request->get('reagent_id'));

                    // Fetch testcodes with their properties
                    $data['testcodes'] = $reagent->tests->map(function ($test) {
                        return [
                            'id' => $test->id,
                            'testcode' => $test->testcode,
                            // Add other testcode properties as needed
                        ];
                    });
                }
            }
        }

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'lab_id' => 'required',
            'prog_id' => 'required',
            'instrument_id' => 'required',
            'reagent_id' => 'required',
            'testcodes' => 'required|array', // Update this to 'testcodes' instead of 'testcode'
            'testcodes.*' => 'exists:tests,testcode',
        ]);

        $assignTest = new AssignTest;

        $assignTest->lab_id = $request->input('lab_id');
        $assignTest->prog_id = $request->input('prog_id');
        $assignTest->instrument_id = $request->input('instrument_id');
        $assignTest->reagent_id = $request->input('reagent_id');
        $assignTest->added_by = auth()->user()->id;
        $assignTest->update_by = auth()->user()->id;

        // Save the main record
        $assignTest->save();

        // Get selected test codes from the form
        $selectedTestCodes = $request->input('testcodes', []); // Default to an empty array if no checkboxes are selected

        // Attach the tests to the assign_test record using the pivot table
        if (is_array($selectedTestCodes) && count($selectedTestCodes) > 0) {
            foreach ($selectedTestCodes as $testCode) {
                DB::table('subassigntest')->insert([
                    'assign_test_id' => $assignTest->id,
                    'testcode' => $testCode,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        Session::flash('statuscode', 'success');
        return redirect('/assign-tests')->with('status', 'Test Assigned Successfully');
    }


    public function edit($id)
    {
        $assignTest = AssignTest::findOrFail($id);
        $programs = Program::all();
        $labs = Lab::all();
        $instruments = Instrument::all();
        $tests = Test::all();
        $methods = Method::all();

        return view('useradmin.assign.edit-tests', compact('assignTest', 'programs', 'labs', 'instruments', 'tests', 'methods'));
    }

    public function update(Request $request, $id)
    {
        $assignTest = AssignTest::findOrFail($id);

        $assignTest->lab_id = $request->input('lab_id');
        $assignTest->prog_id = $request->input('prog_id');
        $assignTest->instrument_id = $request->input('instrument_id');
        $assignTest->reagent_id = $request->input('reagent_id');
        // Remove the following line, as 'testcode' is not a direct property of AssignTest
        // $assignTest->testcode = $request->input('testcode');
        $assignTest->update_by = auth()->user()->id;

        // Save the main record
        $assignTest->save();

        // Get selected test codes from the form
        $selectedTestCodes = $request->input('testcodes', []); // Default to an empty array if no checkboxes are selected

        // Sync the tests for the assign_test record using the pivot table
        $assignTest->tests()->sync($selectedTestCodes);

        Session::flash('statuscode', 'info');
        return redirect('/assign-tests')->with('status', 'Assigned Test Updated Successfully');
    }

    public function delete($id)
    {
        $assignTest = AssignTest::findOrFail($id);
        $assignTest->delete();

        Session::flash('statuscode', 'success');
        return redirect('/assign-tests')->with('status', 'Assigned Test Deleted Successfully');
    }
}
