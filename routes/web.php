<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonationController;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\Auth\OtpPasswordResetController;

// Public routes
Route::get('/', function () {
    return view('users.index');
});


/*
    /
    /
        User routes
    /
    /
*/


// User dashboard with hospitals map
Route::get('/dashboard', function () {
    $hospitals = \App\Models\Hospital::orderBy('created_at', 'desc')->get();
    return view('users.dashboard', ['hospitals' => $hospitals]);
})->name('dashboard');

// User history page
Route::get('/history', function () {
    return view('users.history');
})->name('user.history');

// User profile page
Route::get('/profile', function () {
    return view('users.profile');
})->name('user.profile');

// User profile update
Route::post('/profile', [AuthController::class, 'updateProfile'])->name('user.profile.update');

// User hospitals map page
Route::get('/hospitals-map', function () {
    $hospitals = \App\Models\Hospital::orderBy('created_at', 'desc')->get();
    return view('users.hospitals-map', ['hospitals' => $hospitals]);
})->name('user.hospitals-map');

// Guest routes (not authenticated)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Password reset routes
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    })->name('password.email');

    Route::post('/forgot-password-otp', [OtpPasswordResetController::class, 'sendOtp'])->name('otp.email');
    Route::get('/reset-password-otp', [OtpPasswordResetController::class, 'showResetForm'])->name('otp.reset.form');
    Route::post('/reset-password-otp', [OtpPasswordResetController::class, 'resetWithOtp'])->name('otp.reset');

    Route::get('/reset-password/{token}', function (string $token) {
        return view('auth.reset-password-otp', ['token' => $token]);
    })->name('password.reset');

    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    })->name('password.update');

    Route::put('profile/update-password', [AuthController::class, 'updatePasswordForm'])->name('user.profile-update');
    Route::post('profile/change-password', [AuthController::class, 'changePassword'])->name('user.change-password');

});

                /*
                    /
                    /
                        Authenticated routes
                    /
                    /
                */


// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
     // Show donate request form
    Route::get('/donate-request', [DonationController::class, 'showDonateRequestForm'])->name('donate.request');
    Route::post('/donate-request', [DonationController::class, 'storeDonationRequest'])->name('donate.request.store');

});

                /*
                    /                   /
                    /                   /
                        Admin routes
                    /                   /
                    /                   /
                */
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('admin/login',[AdminController::class,'showLoginForm'])->name('admin.login');
    Route::post('admin/login',[AdminController::class,'login']);
    Route::get('admin/dashboard',[AdminController::class,'showDashboard'])->name('admin.dashboard');
    Route::post('admin/logout',[AdminController::class,'logout'])->name('admin.logout');
    Route::get('/admin/hospitals/add', [AdminController::class, 'showAddHospitalForm'])->name('admin.add.hospital');
    Route::post('/admin/hospitals/store', [AdminController::class, 'storeHospital'])->name('admin.store.hospital');
    Route::get('/admin/hospitals', [AdminController::class, 'listHospitals'])->name('admin.hospitals');
    Route::get('/admin/hospitals/{hospital}/edit', [AdminController::class, 'editHospital'])->name('admin.hospitals.edit');
    Route::put('/admin/hospitals/{hospital}', [AdminController::class, 'updateHospital'])->name('admin.hospitals.update');
    Route::delete('/admin/hospitals/{hospital}', [AdminController::class, 'destroyHospital'])->name('admin.hospitals.destroy');
    Route::get('/admin/hospitals/availability/manage', [AdminController::class, 'manageAvailability'])->name('admin.available-hospital');
    Route::put('/admin/hospitals/{hospital}/toggle-availability', [AdminController::class, 'toggleAvailability'])->name('admin.hospitals.toggle-availability');
    Route::get('/admin/hospitals-map', [AdminController::class, 'showHospitalsMap'])->name('admin.hospitals-map');
    Route::get('/admin/donate-request', [AdminController::class, 'viewDonationRequests'])->name('admin.donate.request');
    Route::get('/admin/donate-requests/all', [AdminController::class, 'allRequests'])->name('admin.donate.all');
    Route::get('/admin/donate-requests/pending', [AdminController::class, 'pendingRequests'])->name('admin.donate.pending');
    Route::get('/admin/donate-requests/approved',[AdminController::class, 'approvedRequests'])->name('admin.donate.approved');
    Route::get('/admin/donate-requests/rejected',[AdminController::class, 'rejectedRequests'])->name('admin.donate.rejected');
    Route::post('/admin/donate-request/{donationRequest}/approve', [AdminController::class, 'approveDonationRequest'])->name('admin.donate.approve');
    Route::post('/admin/donate-request/{donationRequest}/reject', [AdminController::class, 'rejectDonationRequest'])->name('admin.donate.reject');
});
