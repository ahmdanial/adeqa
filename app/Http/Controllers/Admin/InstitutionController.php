<?php

namespace App\Http\Controllers\Admin;

use App\Models\Institution;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InstitutionController extends Controller
{
    public function index()
    {
        $institution = Institution::all();
        return view('admin.institutions')
        ->with('institutions', $institution);
    }

    public function store(Request $request)
    {
        $institution = new Institution;

        $institution->institution = $request->input('institution');          
        $institution->address = $request->input('address');        
        $institution->city = $request->input('city');
        $institution->state = $request->input('state');
        $institution->postalcode = $request->input('postalcode');
        $institution->country = $request->input('country');
        $institution->contactno = $request->input('contactno');
        $institution->added_by = auth()->user()->id;
        $institution->update_by = auth()->user()->id;

        $institution->save();

        Session::flash('statuscode', 'success');
        return redirect('/institutions')->with('status', 'Institution Added Successfully');
    }

    public function edit($id)
    {
        $institution = Institution::findOrFail($id);

        return view('admin.institutions.edit')->with('institution', $institution);
    }

    public function update(Request $request, $id)
    {
        $institution = Institution::findOrFail($id);

        $institution->institution = $request->input('institution');   
        
        $institution->address = $request->input('address');        
        $institution->city = $request->input('city');
        $institution->state = $request->input('state');
        $institution->postalcode = $request->input('postalcode');
        $institution->country = $request->input('country');
        $institution->contactno = $request->input('contactno');
        
        $institution->update_by = auth()->user()->id;


        $institution->update();

        Session::flash('statuscode', 'info');
        return redirect('/institutions')->with('status', 'Institution Updated Successfully');
    }

    public function delete($id)
    {
        $institution = Institution::findOrFail($id);
        $institution->delete();

        Session::flash('statuscode', 'success');
        return redirect('/institutions')->with('status', 'Institution Deleted Successfully');
    }
}
