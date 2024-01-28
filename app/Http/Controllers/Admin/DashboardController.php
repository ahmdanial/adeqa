<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function registered()
    {
        $users = User::all();

        return view('admin.register', compact('users'));
    }

    public function registerstore(Request $request)
    {
        $users = new User;

        $users->username = $request->input('username');
        $users->email = $request->input('email');
        $users->designation = $request->input('designation');
        $users->department = $request->input('department');
        $users->password = bcrypt($request->input('password'));
        $users->roles = $request->input('roles');

        $users->save();

        Session::flash('statuscode', 'success');
        return redirect('/user-register')->with('status', 'Your Data is Saved');
    }

    public function registeredit(Request $request, $id)
    {
        $users = User::findOrFail($id);
        return view('admin.register-edit')->with('users', $users);
    }

    public function registerupdate(Request $request, $id)
    {
        $users = User::find($id);
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|string',
        ]);

        $users->username = $request->input('username');
        $users->roles = $request->input('roles');

        // Update the password only if it's provided
        if ($request->filled('password')) {
            $users->password = bcrypt($request->input('password'));
        }

        $users->update();

        Session::flash('statuscode', 'info');
        return redirect('/user-register')->with('status', 'Your Data is Updated');
    }

    public function registerdelete($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return redirect('/user-register')->with('status', 'Your Data is Deleted');
    }
}
