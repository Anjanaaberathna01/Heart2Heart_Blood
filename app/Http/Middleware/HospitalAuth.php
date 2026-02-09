<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HospitalAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('hospital')->check()) {
            return redirect()->route('login');
        }

        $hospital = Auth::guard('hospital')->user();
        $isDefaultPassword = $hospital && Hash::check('12345678', $hospital->password);
        $isPasswordRoute = $request->routeIs('hospital.password.form', 'hospital.password.update');
        $isLogoutRoute = $request->routeIs('hospital.logout');

        if ($isDefaultPassword && !$isPasswordRoute && !$isLogoutRoute) {
            return redirect()->route('hospital.password.form')
                ->with('warning', 'Please change your default password to continue.');
        }

        return $next($request);
    }
}
