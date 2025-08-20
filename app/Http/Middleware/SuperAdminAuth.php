<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperAdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('superadmin')->check()) {
            return redirect()->route('superadmin.login')->with('error', 'Please login as Super Admin to continue.');
        }

        $user = Auth::guard('superadmin')->user();
        if ($user->status !== 'active') {
            Auth::guard('superadmin')->logout();
            return redirect()->route('superadmin.login')->with('error', 'Your account is inactive.');
        }

        return $next($request);
    }
}
