<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

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
        // Check if yashodarshi is logged in
        if (!Session::get('yashodarshi_logged_in')) {
            return redirect()->route('yashodarshi.login')
                           ->with('error', 'Please login to access yashodarshi panel');
        }

        // Check if yashodarshi data exists in session
        $yashodarshi = Session::get('yashodarshi_data');
        if (!$yashodarshi) {
            Session::forget(['yashodarshi_logged_in', 'yashodarshi_data']);
            return redirect()->route('yashodarshi.login')
                           ->with('error', 'Session expired. Please login again.');
        }

        // Check if yashodarshi is still active
        if ($yashodarshi->status !== 'active') {
            Session::forget(['yashodarshi_logged_in', 'yashodarshi_data']);
            return redirect()->route('yashodarshi.login')
                           ->with('error', 'Your account has been deactivated. Please contact administrator.');
        }

        return $next($request);
    }
}
