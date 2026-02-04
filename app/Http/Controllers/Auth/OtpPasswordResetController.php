<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class OtpPasswordResetController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => ['required', 'email']]);

        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if ($user) {
            $otp = random_int(100000, 999999);
            Cache::put("pwd-otp:{$email}", Hash::make($otp), now()->addMinutes(10));
            Mail::to($email)->send(new OtpMail($otp));
        }

        // Redirect straight to the OTP reset form, carrying the email
        return redirect()
            ->route('otp.reset.form', ['email' => $email])
            ->with('status', 'OTP sent to your email.');
    }

    public function showResetForm(Request $request)
    {
        return view('auth.reset-password-otp');
    }

    public function resetWithOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'otp' => ['required', 'digits:6'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $email = $request->input('email');
        $otp = $request->input('otp');

        $cachedHash = Cache::get("pwd-otp:{$email}");

        if (!$cachedHash || !Hash::check($otp, $cachedHash)) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP.'])->withInput();
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email not found.'])->withInput();
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        Cache::forget("pwd-otp:{$email}");

        // Use 'success' to match the login view's flash message key
        return redirect()->route('login')->with('success', 'Password reset successful.');
    }
}
