<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class YashodarshiAuth
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
        // Check authentication via guard
        if (!Auth::guard('yashodarshi')->check()) {
            return redirect()->route('yashodarshi.login')
                           ->with('error', 'Please login to access yashodarshi panel');
        }

        $yashodarshi = Auth::guard('yashodarshi')->user();

        // Extra safety: ensure active status
        if ($yashodarshi->status !== 'active') {
            Auth::guard('yashodarshi')->logout();
            return redirect()->route('yashodarshi.login')
                           ->with('error', 'Your account has been deactivated. Please contact administrator.');
        }

        return $next($request);
    }
}
