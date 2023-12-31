<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{
    public function index()
    {
        $department = Department::all();
        return view('admin.departments')
        ->with('departments', $department);
    }

    public function store(Request $request)
    {
        $department = new Department;

        $department->department = $request->input('department');
        $department->added_by = auth()->user()->id;
        $department->update_by = auth()->user()->id;

        $department->save();

        Session::flash('statuscode', 'success');
        return redirect('/departments')->with('status', 'Department Added Successfully');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);

        return view('admin.departments.edit')->with('department', $department);
    }

    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        $department->department = $request->input('department');
        $department->update_by = auth()->user()->id;

        $department->update();

        Session::flash('statuscode', 'info');
        return redirect('/departments')->with('status', 'Department Updated Successfully');
    }

    public function delete($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        Session::flash('statuscode', 'success');
        return redirect('/departments')->with('status', 'Department Deleted Successfully');
    }
}
