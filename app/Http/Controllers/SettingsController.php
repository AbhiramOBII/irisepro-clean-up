<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuperAdmin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    /**
     * Display the settings page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('superadmin.settings.index');
    }

    /**
     * Update the administrator password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $superAdmin = Auth::guard('superadmin')->user();
        
        if (!$superAdmin) {
            return redirect()->back()
                ->with('error', 'Super admin not found.');
        }

        // Verify current password
        if (!Hash::check($request->current_password, $superAdmin->password)) {
            return redirect()->back()
                ->with('error', 'Current password is incorrect.');
        }

        // Update password
        $superAdmin->password = Hash::make($request->new_password);
        $superAdmin->save();

        return redirect()->back()
            ->with('success', 'Password updated successfully.');
    }
}
