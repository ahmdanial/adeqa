<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\Test;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class TestController extends Controller
{
    public function index()
    {
        $test = Test::all();
        $departments = Department::all();
        return view('admin.tests', compact('test', 'departments'));
    }

    public function store(Request $request)
    {
        $test = new Test;

        $test->testcode = $request->input('testcode');
        $test->testname = $request->input('testname');
        $test->department_id = $request->input('department_id');
        $test->added_by = auth()->user()->id;
        $test->update_by = auth()->user()->id;

        $test->save();

        Session::flash('statuscode', 'success');
        return redirect('/tests')->with('status', 'Test Added Successfully');
    }

    public function edit($testcode)
    {
        $test = Test::findOrFail($testcode);
        $departments = Department::all();

        return view('admin.tests.edit', compact('test', 'departments'));
    }

    public function update(Request $request, $testcode)
{
    // Validate request...

    // Begin the database transaction
    DB::beginTransaction();

    try {
        // Update foreign key in units table first
        Test::where('testcode', $testcode)->update(['testcode' => $request->input('testcode')]);

        // Then update the testcode in the tests table
        $test = Test::findOrFail($testcode);
        $test->testcode = $request->input('testcode');
        $test->testname = $request->input('testname');

        // Assuming 'department_id' is a valid field in the 'tests' table
        $test->department_id = $request->input('department_id');

        $test->update_by = auth()->user()->id;
        $test->update();

        // Commit the transaction
        DB::commit();

        // Redirect or return a response...
        Session::flash('statuscode', 'info');
        return redirect('/tests')->with('status', 'Test Updated Successfully');
    } catch (\Exception $e) {
        // An error occurred, rollback the transaction
        DB::rollback();

        // Redirect or return a response indicating failure...
        Session::flash('statuscode', 'error');
        return redirect('/tests')->with('status', 'Error updating test');
    }
}


    public function delete($testcode)
    {
        $test = Test::findOrFail($testcode);
        $test->delete();

        Session::flash('statuscode', 'success');
        return redirect('/tests')->with('status', 'Test Deleted Successfully');
    }
}
