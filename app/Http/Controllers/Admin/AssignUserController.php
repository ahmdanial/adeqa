<?php

namespace App\Http\Controllers\Admin;

use App\Models\AssignUser;
use App\Models\User;
use App\Models\Lab;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssignUserController extends Controller
{
    public function index()
    {
        $assignUsers = AssignUser::all();
        $users = User::all();
        $labs = Lab::all();

        return view('admin.assign-users', compact('assignUsers', 'users', 'labs'));
    }

    public function store(Request $request)
    {
        $assignUser = new AssignUser;

        $assignUser->user_code = $request->input('user_code');
        $assignUser->user_id = $request->input('user_id');
        $assignUser->lab_id = $request->input('lab_id');
        $assignUser->added_by = auth()->user()->id;
        $assignUser->update_by = auth()->user()->id;

        $assignUser->save();

        Session::flash('statuscode', 'success');
        return redirect('/assign-users')->with('status', 'User Assigned Successfully');
    }

    public function edit($user_code)
    {
        $assignUser = AssignUser::findOrFail($user_code);
        $users = User::all();
        $labs = Lab::all();

        return view('admin.assign.edit-users', compact('assignUser', 'users', 'labs'));
    }

    public function update(Request $request, $user_code)
    {
        $assignUser = AssignUser::findOrFail($user_code);

        $assignUser->user_code = $request->input('user_code');
        $assignUser->user_id = $request->input('user_id');
        $assignUser->lab_id = $request->input('lab_id');
        $assignUser->update_by = auth()->user()->id;

        $assignUser->update();

        Session::flash('statuscode', 'info');
        return redirect('/assign-users')->with('status', 'Assigned User Updated Successfully');
    }

    public function delete($user_code)
    {

        $assignUser = AssignUser::findOrFail($user_code);
        $assignUser->delete();

        Session::flash('statuscode', 'success');
        return redirect('/assign-users')->with('status', 'Assigned User Deleted Successfully');
    }
}
