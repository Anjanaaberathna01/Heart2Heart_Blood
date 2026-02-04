<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\DonationRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    // show dashboard
    public function showDashboard(){
        $hospitals = Hospital::orderBy('created_at', 'desc')->get();

        $requestStats = [
            'pending' => DonationRequest::where('status', 'pending')->count(),
            'approved' => DonationRequest::where('status', 'approved')->count(),
            'rejected' => DonationRequest::where('status', 'rejected')->count(),
        ];

        $latestRequests = DonationRequest::with(['user', 'hospital'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('blood_admin.dashboard', [
            'hospitals' => $hospitals,
            'requestStats' => $requestStats,
            'latestRequests' => $latestRequests,
        ]);
    }

    // Show add hospital form
    public function showAddHospitalForm()
    {
        return view('blood_admin.add-hospital');
    }

    // edit hospital form
    public function editHospital(Hospital $hospital){
        return view('blood_admin.edit-hospital', compact('hospital'));
    }

    // update hospital
    public function updateHospital(Request $request, Hospital $hospital){
        $request->validate([
            'hospital_id' => 'required|string|unique:hospitals,hospital_id,' . $hospital->id,
            'hospital_reg_number' => 'required|string|unique:hospitals,hospital_reg_number,' . $hospital->id,
            'user_name' => 'required|string|unique:hospitals,user_name,' . $hospital->id,
            'email' => 'required|email|unique:hospitals,email,' . $hospital->id,
            'mobile_number1' => 'required|string|digits:10',
            'mobile_number2' => 'nullable|string|digits:10',
            'address' => 'required|string',
            'district' => 'required|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $hospital->update($request->only([
            'hospital_id', 'hospital_reg_number', 'user_name', 'email',
            'mobile_number1', 'mobile_number2', 'address', 'district',
            'latitude', 'longitude'
        ]));

        return redirect()->route('admin.dashboard')->with('success', 'Hospital updated successfully.');
    }

    // Delete hospital
    public function destroyHospital(Hospital $hospital){
        $hospital->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Hospital deleted successfully.');
    }

    // Store hospital
    public function storeHospital(Request $request)
    {
        $request->validate([
            'hospital_id' => 'required|string|unique:hospitals',
            'hospital_reg_number' => 'required|string|unique:hospitals',
            'mobile_number1' => 'required|string|digits:10',
            'mobile_number2' => 'nullable|string|digits:10',
            'address' => 'required|string',
            'district' => 'required|string',
            'user_name' => 'required|string|unique:hospitals',
            'email' => 'required|email|unique:hospitals',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $defaultPassword = '12345678';

        Hospital::create([
            'hospital_id' => $request->hospital_id,
            'hospital_reg_number' => $request->hospital_reg_number,
            'mobile_number1' => $request->mobile_number1,
            'mobile_number2' => $request->mobile_number2,
            'address' => $request->address,
            'district' => $request->district,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => $defaultPassword,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('login')->with('success', 'Hospital registered successfully! Please log in with your email and default password: ' . $defaultPassword);
    }

    // Show manage availability page
    public function manageAvailability()
    {
        $hospitals = Hospital::orderBy('created_at', 'desc')->get();
        return view('blood_admin.available-hospital', ['hospitals' => $hospitals]);
    }

    // Toggle hospital availability
    public function toggleAvailability(Hospital $hospital)
    {
        $hospital->available_for_donation = !$hospital->available_for_donation;
        $hospital->save();

        $status = $hospital->available_for_donation ? 'available' : 'unavailable';
        return redirect()->route('admin.available-hospital')
            ->with('success', $hospital->user_name . ' marked as ' . $status . ' for blood donation.');
    }

    // List all hospitals
    public function listHospitals()
    {
        $hospitals = Hospital::all();
        return view('blood_admin.hospitals-list', ['hospitals' => $hospitals]);
    }

    // Show hospitals map
    public function showHospitalsMap()
    {
        $hospitals = Hospital::orderBy('created_at', 'desc')->get();
        return view('blood_admin.hospitals-map', ['hospitals' => $hospitals]);
    }

    // show donate request form
    public function showLoginForm(){
        return view('blood_admin.donate-request');
    }

    // View all donation requests
    public function viewDonationRequests()
    {
        $requests = DonationRequest::with(['user', 'hospital'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('blood_admin.donate-request', [
            'donationRequests' => $requests
        ]);
    }

    // Approve donation request
    public function approveDonationRequest(DonationRequest $donationRequest, Request $request)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:500'
        ]);

        $donationRequest->update([
            'status' => 'approved',
            'admin_notes' => $request->admin_notes,
            'approved_at' => now()
        ]);

        return back()->with('success', 'Donation request approved successfully!');
    }

    // Reject donation request
    public function rejectDonationRequest(DonationRequest $donationRequest, Request $request)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:500'
        ]);

        $donationRequest->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes,
            'rejected_at' => now()
        ]);

        return back()->with('success', 'Donation request rejected successfully!');
    }

    // Handle admin logout
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }

}
