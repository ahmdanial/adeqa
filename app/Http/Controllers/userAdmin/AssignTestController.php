<?php

namespace App\Http\Controllers\userAdmin;

use App\Models\AssignTest;
use App\Models\Program;
use App\Models\Lab;
use App\Models\Instrument;
use App\Models\Reagent;
use App\Models\Method;
use App\Models\Unit;
use App\Models\Test;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssignTestController extends Controller
{
    public function index()
    {
        $assignTests = AssignTest::all();
        $programs = Program::all();
        $labs = Lab::all();
        $instruments = Instrument::all();
        $reagents = Reagent::all();
        $methods = Method::all();
        $units = Unit::all();
        $tests = Test::all();

        return view('useradmin.assign-tests', compact('assignTests', 'programs', 'labs', 'instruments', 'reagents', 'methods', 'units', 'tests'));
    }

    public function store(Request $request)
    {
        $assignTest = new AssignTest;

        $assignTest->lab_id = $request->input('lab_id');
        $assignTest->prog_id = $request->input('prog_id');
        $assignTest->instrument_id = $request->input('instrument_id');
        $assignTest->reagent_id = $request->input('reagent_id');
        $assignTest->testcode = $request->input('testcode');
        $assignTest->method_id = $request->input('method_id');
        $assignTest->unit_id = $request->input('unit_id');
        $assignTest->added_by = auth()->user()->id;
        $assignTest->update_by = auth()->user()->id;

        $assignTest->save();

        Session::flash('statuscode', 'success');
        return redirect('/assign-tests')->with('status', 'Test Assigned Successfully');
    }

    public function edit($id)
    {
        $assignTest = AssignTest::findOrFail($id);
        $programs = Program::all();
        $labs = Lab::all();
        $instruments = Instrument::all();
        $reagents = Reagent::all();
        $methods = Method::all();
        $units = Unit::all();
        $tests = Test::all();

        return view('useradmin.assign.edit-tests', compact('assignTest', 'programs', 'labs', 'instruments', 'reagents', 'methods', 'units', 'tests'));
    }

    public function update(Request $request, $id)
    {
        $assignTest = AssignTest::findOrFail($id);

        $assignTest->lab_id = $request->input('lab_id');
        $assignTest->prog_id = $request->input('prog_id');
        $assignTest->instrument_id = $request->input('instrument_id');
        $assignTest->reagent_id = $request->input('reagent_id');
        $assignTest->testcode = $request->input('testcode');
        $assignTest->method_id = $request->input('method_id');
        $assignTest->unit_id = $request->input('unit_id');
        $assignTest->update_by = auth()->user()->id;

        $assignTest->update();

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
