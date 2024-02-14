<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user->roles === 'admin') {        // If the user is an admin, check if they have a valid institution_id
            if ($user->institution_id) {
                return $next($request);
            }
                else {
                    return redirect('/home')->with('status', 'You are not allowed to access admin dashboard');
                }
        }

        if ($user->roles === 'superadmin' || $user->roles === 'user') {
            // If the user is a superadmin or regular user, allow them to access the admin dashboard
            return $next($request);
        }

        // If the user is not a superadmin, admin, or user, redirect them
        return redirect('/home')->with('status', 'You are not allowed to access admin dashboard');
    }
}
