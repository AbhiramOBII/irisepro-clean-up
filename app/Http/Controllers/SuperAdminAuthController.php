<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuperAdmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SuperAdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('superadmin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'superadmin_email' => 'required|email',
            'password' => 'required'
        ]);

        $superadmin = SuperAdmin::where('superadmin_email', $request->superadmin_email)
                                ->where('status', 'active')
                                ->first();

        if ($superadmin && Hash::check($request->password, $superadmin->password)) {
            // Update last login info
            $superadmin->update([
                'last_login' => now(),
                'last_login_ip' => $request->ip()
            ]);

            // Authenticate via guard
            Auth::guard('superadmin')->login($superadmin);

            return redirect()->route('superadmin.dashboard');
        }

        return back()->with('error', 'Invalid credentials or account is inactive');
    }

    public function dashboard()
    {
        if (!Auth::guard('superadmin')->check()) {
            return redirect()->route('superadmin.login');
        }

        $superadmin = Auth::guard('superadmin')->user();
        return view('superadmin.dashboard', compact('superadmin'));
    }

    public function logout()
    {
        Auth::guard('superadmin')->logout();
        return redirect()->route('superadmin.login');
    }
}
