<html>
    <body>
        <h1>Hospital Admin Dashboard</h1>
        <p>Welcome to the Hospital Admin Dashboard. Here you can manage your hospital's information, view blood requests, and update your profile.</p>

        <div>
            <a href="{{ route('hospital.password.form') }}">Change Password</a> |
            <a href="{{ route('hospital.donation.requests') }}">View Donation Requests</a> |
            <form method="POST" action="{{ route('hospital.logout') }}" style="display: inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </body>
</html>
