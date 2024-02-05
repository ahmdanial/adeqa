<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reagent;
use App\Models\Test;
use App\Models\Unit;
use App\Models\Method;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MethodController extends Controller
{
    public function index()
    {
        $method = Method::all();
        $reagent = Reagent::all();
        $tests = Test::all();
        $units = Unit::all();
        return view('admin.methods', compact('method', 'reagent', 'tests', 'units'));
    }

    public function store(Request $request)
    {
        $method = new method;

        $method->methodname = $request->input('methodname');
        $method->reagent_id = $request->input('reagent_id');
        $method->testcode = $request->input('testcode');
        $method->unit_id = $request->input('unit_id');
        $method->added_by = auth()->user()->id;
        $method->update_by = auth()->user()->id;

        $method->save();

        Session::flash('statuscode', 'success');
        return redirect('/methods')->with('status', 'Method Added Successfully');
    }

    public function edit($id)
    {
        $method = Method::findOrFail($id);
        $reagent = Reagent::all();
        $tests = Test::all();
        $units = Unit::all();

        return view('admin.methods.edit', compact('method', 'reagent', 'tests', 'units'));
    }

    public function update(Request $request, $id)
    {
        $method = Method::findOrFail($id);

        $method->methodname = $request->input('methodname');
        $method->reagent_id = $request->input('reagent_id');
        $method->testcode = $request->input('testcode');
        $method->unit_id = $request->input('unit_id');

        $method->update_by = auth()->user()->id;
        $method->update();

        Session::flash('statuscode', 'info');
        return redirect('/methods')->with('status', 'Method Updated Successfully');
    }

    public function delete($id)
    {

        $method = Method::findOrFail($id);
        $method->delete();

        Session::flash('statuscode', 'success');
        return redirect('/methods')->with('status', 'Method Deleted Successfully');
    }
}
