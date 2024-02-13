<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lab;
use App\Models\Institution;
use Illuminate\Support\Facades\Session;

class LabsController extends Controller
{
    public function index()
    {
        $institution = Institution::all();
        $lab = Lab::all();
        return view('admin.labs', compact('institution', 'lab'));

     

        
    }

    public function store(Request $request)
    {
        $lab = new Lab;

        $lab->labname = $request->input('labname');
        $lab->institution_id = $request->input('institution_id');
        $lab->added_by = auth()->user()->id;
        $lab->update_by = auth()->user()->id;

        $lab->save();

        Session::flash('statuscode', 'success');
        return redirect('/labs')->with('status', 'Lab Added Successfully');
    }

    public function edit($id)
    {
        $lab = Lab::findOrFail($id);
        $institution = Institution::all();

        return view('admin.labs.edit', compact('lab', 'institution'));
    }

    public function update(Request $request, $id)
    {
        $lab = Lab::findOrFail($id);

        $lab->labname = $request->input('labname');
        $lab->institution_id = $request->input('institution_id');
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
