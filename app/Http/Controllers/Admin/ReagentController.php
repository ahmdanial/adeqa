<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reagent;
use App\Models\Instrument;
use Illuminate\Support\Facades\Session;

class ReagentController extends Controller
{
    public function index()
    {
        $instrument = Instrument::all();
        $reagent = Reagent::all();
        return view('admin.reagents', compact('instrument', 'reagent'));
    }

    public function store(Request $request)
    {
        $reagent = new Reagent;

        $reagent->reagent = $request->input('reagent');
        $reagent->instrument_id = $request->input('instrument_id');
        $reagent->added_by = auth()->user()->id;
        $reagent->update_by = auth()->user()->id;

        $reagent->save();

        Session::flash('statuscode', 'success');
        return redirect('/reagents')->with('status', 'Reagent Added Successfully');
    }

    public function edit($id)
    {
        $reagent = Reagent::findOrFail($id);
        $instrument = Instrument::all();

        return view('admin.reagents.edit', compact('reagent', 'instrument'));
    }

    public function update(Request $request, $id)
    {
        $reagent = Reagent::findOrFail($id);

        $reagent->reagent = $request->input('reagent');
        $reagent->instrument_id = $request->input('instrument_id');
        $reagent->update_by = auth()->user()->id;

        $reagent->update();

        Session::flash('statuscode', 'info');
        return redirect('/reagents')->with('status', 'Reagent Updated Successfully');
    }

    public function delete($id)
    {
        $reagent = Reagent::findOrFail($id);
        $reagent->delete();

        Session::flash('statuscode', 'success');
        return redirect('/reagents')->with('status', 'Reagent Deleted Successfully');
    }
}
