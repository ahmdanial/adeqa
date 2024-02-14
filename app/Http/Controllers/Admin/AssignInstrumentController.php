<?php

namespace App\Http\Controllers\Admin;

use App\Models\AssignInstrument;
use App\Models\User;
use App\Models\Instrument;
use App\Models\Institution;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssignInstrumentController extends Controller
{
    public function index()
    {
        $assignInstruments = AssignInstrument::all();
        $institutions = Institution::all();
        $instruments = Instrument::all();
        $users = User::all();

        return view('admin.assign-instruments', compact('assignInstruments', 'users', 'instruments', 'institutions'));
    }

    public function store(Request $request)
    {
        $assignInstrument = new AssignInstrument;

        $assignInstrument->institution_id = $request->input('institution_id');
        $assignInstrument->instrument_id = $request->input('instrument_id');
        $assignInstrument->added_by = auth()->user()->id;
        $assignInstrument->update_by = auth()->user()->id;

        $assignInstrument->save();

        Session::flash('statuscode', 'success');
        return redirect('/assign-instruments')->with('status', 'User Assigned Successfully');
    }

    public function edit($id)
    {
        $assignInstrument = AssignInstrument::findOrFail($id);
        $institutions = Institution::all();
        $instruments = Instrument::all();
        $users = User::all();

        return view('admin.assign.edit-instruments', compact('assignInstrument', 'users', 'institutions', 'instruments'));
    }

    public function update(Request $request, $id)
    {
        $assignInstrument = AssignInstrument::findOrFail($id);

        $assignInstrument->institution_id = $request->input('institution_id');
        $assignInstrument->instrument_id = $request->input('instrument_id');
        $assignInstrument->update_by = auth()->user()->id;

        $assignInstrument->update();

        Session::flash('statuscode', 'info');
        return redirect('/assign-instruments')->with('status', 'Assigned User Updated Successfully');
    }

    public function delete($id)
    {

        $assignInstrument = AssignInstrument::findOrFail($id);
        $assignInstrument->delete();

        Session::flash('statuscode', 'success');
        return redirect('/assign-instruments')->with('status', 'Assigned User Deleted Successfully');
    }
}
