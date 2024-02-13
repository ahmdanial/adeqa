<?php

namespace App\Http\Controllers\Admin;

use App\Models\Program;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProgramController extends Controller
{
    public function index()
    {
        $program = Program::all();
        return view('admin.programs')
        ->with('programs', $program);
    }

    public function store(Request $request)
    {
        $program = new Program;

        $program->programname = $request->input('programname');
        $program->opendate = $request->input('opendate');
        $program->closedate = $request->input('closedate');
        $program->added_by = auth()->user()->id;
        $program->update_by = auth()->user()->id;

        $program->save();

        Session::flash('statuscode', 'success');
        return redirect('/programs')->with('status', 'Program Added Successfully');
    }

    public function edit($id)
    {
        $program = Program::findOrFail($id);

        return view('admin.programs.edit')->with('program', $program);
    }

    public function update(Request $request, $id)
    {
        $program = Program::findOrFail($id);

        $program->programname = $request->input('programname');
        $program->opendate = $request->input('opendate');
        $program->closedate = $request->input('closedate');
        $program->update_by = auth()->user()->id;

        $program->update();

        Session::flash('statuscode', 'info');
        return redirect('/programs')->with('status', 'Program Updated Successfully');
    }

    public function delete($id)
    {
        $program = Program::findOrFail($id);
        $program->delete();

        Session::flash('statuscode', 'success');
        return redirect('/programs')->with('status', 'Program Deleted Successfully');
    }
}
