@extends('layouts.user')

@section('title', 'My Profile - Heart2Heart LK')

@section('content')
<style>
    .profile-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
    }

    .profile-header {
        background: linear-gradient(135deg, #dc3545 0%, #a71e2a 100%);
        color: white;
        padding: 40px;
        border-radius: 10px;
        margin-bottom: 30px;
        text-align: center;
    }

    .profile-header h1 {
        margin-bottom: 5px;
        font-size: 28px;
    }

    .profile-header p {
        opacity: 0.9;
    }

    .profile-section {
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .profile-section h2 {
        color: #dc3545;
        margin-bottom: 20px;
        font-size: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #eee;
    }

    .profile-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .info-group {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 6px;
    }

    .info-group label {
        display: block;
        color: #666;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    .info-group span {
        display: block;
        color: #333;
        font-size: 16px;
        font-weight: 500;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        color: #333;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 14px;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
        font-family: 'Poppins', Arial, sans-serif;
        transition: border-color 0.3s;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="tel"]:focus,
    textarea:focus {
        outline: none;
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }

    textarea {
        resize: vertical;
        min-height: 100px;
    }

    .btn {
        padding: 12px 30px;
        background-color: #dc3545;
        color: white;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #b80500;
    }

    .btn-secondary {
        background-color: #667eea;
        margin-left: 10px;
    }

    .btn-secondary:hover {
        background-color: #5568d3;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }

    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
    }

    .stat-card .number {
        font-size: 24px;
        font-weight: 700;
        display: block;
    }

    .stat-card .label {
        font-size: 12px;
        opacity: 0.9;
        margin-top: 5px;
    }

    .alert {
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    @media (max-width: 768px) {
        .profile-container {
            padding: 10px;
        }

        .profile-section {
            padding: 20px;
        }

        .profile-info {
            grid-template-columns: 1fr;
        }

        .btn-secondary {
            margin-left: 0;
            margin-top: 10px;
        }
    }
</style>

<div class="profile-container">
    <!-- Profile Header -->
    <div class="profile-header">
        <h1><i class="fas fa-user-circle"></i> My Profile</h1>
        <p>Manage your account information and preferences</p>
    </div>

    <!-- Personal Information -->
    <div class="profile-section">
        <h2>Personal Information</h2>

        <div class="profile-info">
            <div class="info-group">
                <label>Full Name</label>
                <input type="text" value="{{ auth()->user()->name ?? '' }}" disabled>
            </div>
            <div class="info-group">
                <label>Email Address</label>
                <input type="email" value="{{ auth()->user()->email ?? '' }}" disabled>
            </div>
            <div class="info-group">
                <label>Phone Number</label>
                <input type="tel" value="{{ auth()->user()->phone ?? '' }}" disabled>
            </div>
            <div class="info-group">
                <label>Blood Type</label>
                <input type="text" value="{{ auth()->user()->blood_type ?? '' }}" disabled>
            </div>
            <div class="info-group">
                <label>Member Since</label>
                <input type="text" value="{{ auth()->user()->created_at->format('F d, Y') }}" disabled>
            </div>
            <div class="info-group">
                <label>Account Status</label>
                <span><span style="background: #d4edda; color: #155724; padding: 4px 8px; border-radius: 4px;">Active</span></span>
            </div>
        </div>
    </div>

    <!-- Donation Statistics -->
    <div class="profile-section">
        <h2>Donation Statistics</h2>
        <div class="stats-grid">
            <div class="stat-card">
                <span class="number">0</span>
                <span class="label">Donations Made</span>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <span class="number">{{ auth()->user()->donations()->count() }}</span>
                <span class="label">Requests Made</span>
            </div>
            <div class="stat-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <span class="number">0</span>
                <span class="label">Units Received</span>
            </div>
        </div>
    </div>

    <!-- Edit Profile Form -->
    <div class="profile-section">
        <h2>Update Profile</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('user.profile.update') }}">
            @csrf
            @method('POST')
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" value="{{ auth()->user()->name ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" value="{{ auth()->user()->phone ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label>Blood Type</label>
                    <select name="blood_type" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; font-family: 'Poppins', Arial, sans-serif;">
                        <option value="">Select Blood Type</option>
                        <option value="O+" {{ auth()->user()->blood_type == 'O+' ? 'selected' : '' }}>O+ (O Positive)</option>
                        <option value="O-" {{ auth()->user()->blood_type == 'O-' ? 'selected' : '' }}>O- (O Negative)</option>
                        <option value="A+" {{ auth()->user()->blood_type == 'A+' ? 'selected' : '' }}>A+ (A Positive)</option>
                        <option value="A-" {{ auth()->user()->blood_type == 'A-' ? 'selected' : '' }}>A- (A Negative)</option>
                        <option value="B+" {{ auth()->user()->blood_type == 'B+' ? 'selected' : '' }}>B+ (B Positive)</option>
                        <option value="B-" {{ auth()->user()->blood_type == 'B-' ? 'selected' : '' }}>B- (B Negative)</option>
                        <option value="AB+" {{ auth()->user()->blood_type == 'AB+' ? 'selected' : '' }}>AB+ (AB Positive)</option>
                        <option value="AB-" {{ auth()->user()->blood_type == 'AB-' ? 'selected' : '' }}>AB- (AB Negative)</option>
                    </select>
                </div>
            </div>

            <div class="form-group" style="grid-column: 1 / -1;">
                <label>Bio / Additional Notes</label>
                <textarea name="bio" placeholder="Tell us something about yourself...">I am a regular blood donor and willing to help others in need.</textarea>
            </div>

            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <button type="submit" class="btn">Save Changes</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>

    <!-- Change Password Section -->
    <div class="profile-section">
        <h2>Change Password</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>

        @endif
        <form method="POST" action="{{ route('user.change-password') }}">
            @csrf

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; max-width: 600px;">
                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" name="current_password" required>
                </div>

                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="new_password" required>
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" required>
                </div>
            </div>

            <button type="submit" class="btn">Update Password</button>
        </form>
    </div>

    <!-- Danger Zone -->
    <div class="profile-section" style="border-left: 4px solid #dc3545;">
        <h2 style="color: #dc3545;">Danger Zone</h2>
        <p style="color: #666; margin-bottom: 15px;">Be careful with these actions. They cannot be undone.</p>

        <form method="POST" action="/deactivate-account" onsubmit="return confirm('Are you sure you want to deactivate your account?');">
            @csrf
            <button type="submit" style="background-color: #dc3545; color: white; padding: 12px 30px; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">
                <i class="fas fa-warning"></i> Deactivate Account
            </button>
        </form>
    </div>
</div>
@endsection
