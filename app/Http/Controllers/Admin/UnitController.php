<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Support\Facades\Session;

class UnitController extends Controller
{
    public function index()
{
    $units = Unit::all();
    return view('admin.units', compact('units'));
}

    public function store(Request $request)
    {
        $unit = new Unit;

        $unit->unit = $request->input('unit');
        $unit->added_by = auth()->user()->id;
        $unit->update_by = auth()->user()->id;

        $unit->save();

        Session::flash('statuscode', 'success');
        return redirect('/units')->with('status', 'Unit Added Successfully');
    }

    public function edit($id)
    {
        $unit = Unit::findOrFail($id);

        return view('admin.units.edit', compact('unit'));
    }

    public function update(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);

        $unit->unit = $request->input('unit');
        $unit->update_by = auth()->user()->id;

        $unit->update();

        Session::flash('statuscode', 'info');
        return redirect('/units')->with('status', 'Unit Updated Successfully');
    }

    public function delete($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();

        Session::flash('statuscode', 'success');
        return redirect('/units')->with('status', 'Unit Deleted Successfully');
    }
}
