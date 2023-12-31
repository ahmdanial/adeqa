<?php

namespace App\Http\Controllers\Admin;

use App\Models\AssignProgram;
use App\Models\Program;
use App\Models\Lab;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssignProgramController extends Controller
{
    public function index()
    {
        $assignPrograms = AssignProgram::all();
        $programs = Program::all();
        $labs = Lab::all();

        return view('admin.assign-programs', compact('assignPrograms', 'programs', 'labs'));
    }

    public function store(Request $request)
    {
        $assignProgram = new AssignProgram;

        $assignProgram->lab_id = $request->input('lab_id');
        $assignProgram->prog_id = $request->input('prog_id');
        $assignProgram->added_by = auth()->user()->id;
        $assignProgram->update_by = auth()->user()->id;

        $assignProgram->save();

        Session::flash('statuscode', 'success');
        return redirect('/assign-programs')->with('status', 'Program Assigned Successfully');
    }

    public function edit($id)
    {
        $assignProgram = AssignProgram::findOrFail($id);
        $programs = Program::all();
        $labs = Lab::all();

        return view('admin.assign.edit-programs', compact('assignProgram', 'programs', 'labs'));
    }

    public function update(Request $request, $id)
    {
        $assignProgram = AssignProgram::findOrFail($id);

        $assignProgram->lab_id = $request->input('lab_id');
        $assignProgram->prog_id = $request->input('prog_id');
        $assignProgram->update_by = auth()->user()->id;

        $assignProgram->update();

        Session::flash('statuscode', 'info');
        return redirect('/assign-programs')->with('status', 'Assigned Program Updated Successfully');
    }

    public function delete($id)
    {
        $assignProgram = AssignProgram::findOrFail($id);
        $assignProgram->delete();

        Session::flash('statuscode', 'success');
        return redirect('/assign-programs')->with('status', 'Assigned Program Deleted Successfully');
    }
}
