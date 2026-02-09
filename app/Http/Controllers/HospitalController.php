<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class HospitalController extends Controller
{
    // show Hospital Dashboard
    public function showDashboard()
    {
        $hospital = Auth::guard('hospital')->user();

        if (!$hospital) {
            return redirect('/login')->with('error', 'Hospital not found. Please log in again.');
        }

        return view('hospital_admin.dashboard', ['hospital' => $hospital]);
    }

    public function showChangePasswordForm()
    {
        return view('hospital_admin.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string|min:6',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $hospital = Auth::guard('hospital')->user();

        if (!$hospital || !Hash::check($request->current_password, $hospital->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $hospital->password = $request->new_password;
        $hospital->save();

        return redirect()->route('hospital.dashboard')->with('success', 'Password updated successfully.');
    }

    public function logout(Request $request)
    {
        Auth::guard('hospital')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}
