<?php

namespace App\Http\Controllers\Admin;

use App\Models\Instrument;
//use App\Models\Institution;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    public function index()
    {
        $instrument = Instrument::all();
        //$institutions = Institution::all();
        //return view('admin.instruments', compact('instrument', 'institutions'));
        return view('admin.instruments')->with('instrument', $instrument);
    }

    public function store(Request $request)
    {
        $instrument = new Instrument;

        $instrument->instrumentname = $request->input('instrumentname');
        //$instrument->institution_id = $request->input('institution_id');
        $instrument->added_by = auth()->user()->id;
        $instrument->update_by = auth()->user()->id;

        $instrument->save();

        Session::flash('statuscode', 'success');
        return redirect('/instruments')->with('status', 'Instrument Added Successfully');
    }

    public function edit($id)
    {
        $instrument = Instrument::findOrFail($id);
        //$institutions = Institution::all();

        //return view('admin.instruments.edit', compact('instrument', 'institutions'));
        return view('admin.instruments.edit')->with('instrument', $instrument);
    }

    public function update(Request $request, $id)
    {
        $instrument = Instrument::findOrFail($id);

        $instrument->instrumentname = $request->input('instrumentname');
       // $instrument->institution_id = $request->input('institution_id');
        $instrument->update_by = auth()->user()->id;
        $instrument->update();

        Session::flash('statuscode', 'info');
        return redirect('/instruments')->with('status', 'Instrument Updated Successfully');
    }

    public function delete($id)
    {
        $instrument = Instrument::findOrFail($id);
        $instrument->delete();

        Session::flash('statuscode', 'success');
        return redirect('/instruments')->with('status', 'Instrument Deleted Successfully');
    }
}
