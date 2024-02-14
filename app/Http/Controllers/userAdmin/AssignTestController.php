<?php

namespace App\Http\Controllers\userAdmin;

use App\Models\AssignTest;
use App\Models\Program;
use App\Models\Lab;
use App\Models\Instrument;
use App\Models\Test;
use App\Models\Method;
use App\Models\Reagent;
use App\Models\Institution;
use App\Models\SubAssignTest;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AssignTestController extends Controller
{
    public function index()
    {
        $labs = Lab::all();
        $institutions = Institution::all();
        $programs = Program::all();
        $assignTests = AssignTest::with(['lab', 'program', 'instrument', 'reagent', 'test'])
        ->where('added_by', auth()->user()->id)
        ->get();

        return view('useradmin.assign-tests', compact('assignTests', 'labs', 'institutions', 'programs'));
    }

    public function fetchInstruments(Request $request)
    {
        $value = $request->get('value');

        if (!empty($value)) {
            // Assuming you have a relationship between Institution and Instrument
            $instrumentsData = Instrument::where('institution_id', $value)->pluck('instrumentname', 'id');
            return response()->json(['instruments' => $instrumentsData]);
        }

        return response()->json([]);
    }

    public function fetchReagents(Request $request)
    {
        // Fetch reagents based on the selected instrument
        $value = $request->get('value');


        if (!empty($value)) {
            // Assuming you have a relationship between Institution and Instrument
            $ReagentsData = Reagent::where('instrument_id', $value)->pluck('reagent', 'id');
            return response()->json(['reagents' => $ReagentsData]);
        }

        return response()->json([]);
    }

    public function fetchTestCodes(Request $request)
    {
        // Fetch testcodes based on the selected reagent (tanya puan)
        $reagentId = $request->get('reagent_id');

        if (!empty($reagentId)) {
            // Assuming Reagent model has a relationship with Test model
            $reagent = Reagent::find($reagentId);

            // Fetch testcodes with their properties
            $testCodesData = $reagent->tests->map(function ($test) {
                return [
                    'testcode' => $test->testcode,
                    'testname' => $test->testname,
                    // Add other testcode properties as needed
                ];
            });

            return response()->json(['testcodes' => $testCodesData]);
        }

        return response()->json([]);
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
        $institutions = Institution::all();
        $assignTest = AssignTest::findOrFail($id);
        $programs = Program::all();
        $labs = Lab::all();
        $instruments = Instrument::all();
        $reagents = Reagent::all();
        $tests = SubAssignTest::all();

        // Retrieve all the assigned testcodes for this assignment and put them in an array
        $assignedTestCodes = $tests->pluck('testcode')->toArray();

        return view('useradmin.assign.edit-tests', compact('assignTest', 'programs', 'labs', 'instruments', 'tests', 'reagents','assignedTestCodes','institutions'));
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
        $assignTest->update();

        // Get selected test codes from the form
        $assignedTestCodes = $request->input('testcodes', []); // Default to an empty array if no checkboxes are selected

        // Sync the tests for the assign_test record using the pivot table
        $assignTest->tests()->sync($assignedTestCodes);

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
