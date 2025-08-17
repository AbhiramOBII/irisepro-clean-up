<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuperAdmin;
use Illuminate\Support\Facades\Hash;
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

            // Store in session
            Session::put('superadmin_id', $superadmin->id);
            Session::put('superadmin_logged_in', true);

            return redirect()->route('superadmin.dashboard');
        }

        return back()->with('error', 'Invalid credentials or account is inactive');
    }

    public function dashboard()
    {
        if (!Session::get('superadmin_logged_in')) {
            return redirect()->route('superadmin.login');
        }

        $superadmin = SuperAdmin::find(Session::get('superadmin_id'));
        return view('superadmin.dashboard', compact('superadmin'));
    }

    public function logout()
    {
        Session::forget(['superadmin_id', 'superadmin_logged_in']);
        return redirect()->route('superadmin.login');
    }
}
