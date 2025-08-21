<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StudentAuth
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
        if (!Auth::guard('student')->check()) {
            return redirect()->route('mobile.login')->with('error', 'Please login as Student to continue.');
        }

        $user = Auth::guard('student')->user();
        if ($user->status !== 'active') {
            Auth::guard('student')->logout();
            return redirect()->route('mobile.login')->with('error', 'Your account is inactive.');
        }

        return $next($request);
    }
}
