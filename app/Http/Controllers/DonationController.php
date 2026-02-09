<?php

namespace App\Http\Controllers;

use App\Models\DonationRequest;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    // Show donate request form
    public function showDonateRequestForm()
    {
        return view('users.donate-request');
    }

    // Store donation request
    public function storeDonationRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|digits:10',
            'blood_type' => 'required|string|in:O+,O-,A+,A-,B+,B-,AB+,AB-',
            'district' => 'required|string',
            'hospital_id' => 'required|exists:hospitals,id',
            'reason' => 'nullable|string|max:500'
        ]);

        // Create donation request
        $donationRequest = DonationRequest::create([
            'user_id' => Auth::id(),
            'hospital_id' => $request->hospital_id,
            'blood_type' => $request->blood_type,
            'reason' => $request->reason,
            'status' => 'pending'
        ]);

        return redirect()->route('dashboard')->with('success', 'Donation request submitted successfully!');

    }

    // View user's own donation requests
    public function viewMyRequests()
    {
        $requests = DonationRequest::where('user_id', Auth::id())
            ->with(['hospital'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('users.history', ['requests' => $requests]);
    }

    // View user's inbox (approved requests with reference numbers)
    public function viewInbox()
    {
        $approvedRequests = DonationRequest::where('user_id', Auth::id())
            ->where('status', 'approved')
            ->orderBy('approved_at', 'desc')
            ->get();

        foreach ($approvedRequests as $request) {
            if (!$request->reference_number) {
                $request->reference_number = 'H2H-' . now()->format('Ymd') . '-' . str_pad($request->id, 6, '0', STR_PAD_LEFT);
                $request->save();
            }
        }

        return view('users.inbox', ['approvedRequests' => $approvedRequests]);
    }

    // Get hospital details
    public function getHospitalDetails(Hospital $hospital)
    {
        return response()->json([
            'id' => $hospital->id,
            'name' => $hospital->user_name,
            'phone' => $hospital->mobile_number1,
            'email' => $hospital->email,
            'address' => $hospital->address,
            'district' => $hospital->district,
            'available' => $hospital->available_for_donation
        ]);
    }

}
