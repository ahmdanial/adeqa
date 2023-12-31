<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lab;
use App\Models\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LabsController extends Controller
{
    public function index()
    {
        $labs = Lab::with('department')->get();
        $departments = Department::all();
        return view('admin.labs', compact('labs', 'departments'));
    }

    public function store(Request $request)
    {
        $lab = new Lab;

        $lab->labname = $request->input('labname');
        $lab->address = $request->input('address');
        $lab->department_id = $request->input('department_id');
        $lab->city = $request->input('city');
        $lab->state = $request->input('state');
        $lab->postalcode = $request->input('postalcode');
        $lab->country = $request->input('country');
        $lab->contactno = $request->input('contactno');
        $lab->added_by = auth()->user()->id;

        $lab->save();

        Session::flash('statuscode', 'success');
        return redirect('/labs')->with('status', 'Lab Added Successfully');
    }

    public function edit($id)
    {
        $lab = Lab::findOrFail($id);
        $departments = Department::all();

        return view('admin.labs.edit', compact('lab', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $lab = Lab::findOrFail($id);

        $lab->labname = $request->input('labname');
        $lab->address = $request->input('address');
        $lab->department_id = $request->input('department_id');
        $lab->city = $request->input('city');
        $lab->state = $request->input('state');
        $lab->postalcode = $request->input('postalcode');
        $lab->country = $request->input('country');
        $lab->contactno = $request->input('contactno');
        $lab->update_by = auth()->user()->id;

        $lab->update();

        Session::flash('statuscode', 'info');
        return redirect('/labs')->with('status', 'Lab Updated Successfully');
    }

    public function delete($id)
    {
        $lab = Lab::findOrFail($id);
        $lab->delete();

        Session::flash('statuscode', 'success');
        return redirect('/labs')->with('status', 'Lab Deleted Successfully');
    }
}
