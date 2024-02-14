<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth; // add this line to the top of the file

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo()
    {
        $user = Auth::user();

        if ($user->roles == 'superadmin') {
            return 'user-register';
        } elseif ($user->roles == 'admin') {
            // Add logic to retrieve the user's institution_id
            $institutionId = $user->institution_id;

            // Redirect to 'assign-tests' only if institution_id is present
            return $institutionId ? 'assign-tests' : 'home';
        } elseif ($user->roles == 'user') {
            return 'entry-results';
        } else {
            return 'home';
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
