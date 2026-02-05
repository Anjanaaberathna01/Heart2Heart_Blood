<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Hospital;
use App\Models\PasswordResetOtp;
use App\Mail\OtpMail;

class AuthController extends Controller{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $email = $request->email;
        $password = $request->password;

        // Check if user exists (user or admin)
        $user = User::where('email', $email)->first();
        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user, $request->filled('remember'));
            $request->session()->regenerate();

            // Redirect based on role
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard')->with('success', 'Welcome Admin!');
            }

            return redirect()->intended('/dashboard')->with('success', 'Welcome back!');
        }

        // Check if user is a hospital admin
        $hospital = Hospital::where('email', $email)->first();
        if ($hospital && Hash::check($password, $hospital->password)) {
            // Login as hospital admin - store in session with role
            session([
                'hospital_admin_id' => $hospital->id,
                'hospital' => $hospital,
                'role' => 'hospital',
                'hospital_email' => $hospital->email,
            ]);
            $request->session()->regenerate();
            return redirect()->intended('/hospital/dashboard')->with('success', 'Welcome Hospital Admin!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    // Show registration form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
            'phone' => 'nullable|digits:10',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        Auth::login($user);

        return redirect('/dashboard')->with('success', 'Registration successful!');
    }

    // Update Profile
    public function updateProfile(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|digits:10',
            'blood_type' => 'nullable|in:O+,O-,A+,A-,B+,B-,AB+,AB-',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->blood_type = $request->blood_type;
        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    // Show forgot password form
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Send OTP to email
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        // Generate OTP
        $otpRecord = PasswordResetOtp::generateOtp($request->email);

        // Send OTP via email
        try {
            Mail::to($request->email)->send(new OtpMail($otpRecord->otp));

            return redirect()->route('otp.reset.form', ['email' => $request->email])
                ->with('success', 'OTP has been sent to your email address.');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send OTP. Please try again.']);
        }
    }

    // update password form
    public function updatePasswordForm(Request $request){

        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ]);

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password updated successfully.');

    }

    // Show change password form
    public function changePassword(Request $request){

        $request->validate([
            'current_password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6|confirmed',
            'new_password_confirmation' => 'required|string|min:6',
        ]);

        $user = Auth::user();

        // Check if current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
        else if (strlen($request->new_password) < 6){
            return back()->withErrors(['new_password' => 'New password must be at least 6 characters.']);
        }
        else if ($request->new_password != $request->new_password_confirmation){
            return back()->withErrors(['new_password_confirmation' => 'New password confirmation does not match.']);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();
        return back()->with('success', 'Password changed successfully.');

    }

    // Show verify OTP form
    public function showVerifyOtpForm(Request $request)
    {
        return view('auth.reset-password-otp', ['email' => $request->email]);
    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6'
        ]);

        if (!PasswordResetOtp::verifyOtp($request->email, $request->otp)) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        return redirect()->route('otp.reset.form', [
            'email' => $request->email
        ])->with('success', 'OTP verified successfully.');
    }

    // Show reset password form
    public function showResetPasswordForm(Request $request)
    {
        return view('auth.reset-password-otp', [
            'email' => $request->email,
            'otp' => $request->otp
        ]);
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6',
            'password' => 'required|min:6|confirmed'
        ]);

        // Verify OTP again
        if (!PasswordResetOtp::verifyOtp($request->email, $request->otp)) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
        }

        // Update password
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete used OTP
        PasswordResetOtp::where('email', $request->email)->delete();

        return redirect()->route('login')
            ->with('success', 'Password has been reset successfully. Please login.');
    }

    // show donate request form
    public function showDonateRequestForm(){
        if (view()->exists('users.donate-request')) {
            return view('users.donate-request');
        }

        // Fallback placeholder to prevent "View not found" errors.
        return response(
            '<!doctype html><html><head><meta charset="utf-8"><title>Donate Request</title></head><body><h1>Donate Request</h1><p>Placeholder page: create resources/views/auth/donate-request.blade.php to customize this page.</p></body></html>',
            200
        )->header('Content-Type', 'text/html');
    }


    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'You have been logged out successfully.');
    }
}
