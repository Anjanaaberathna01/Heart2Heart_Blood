<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password</title>
</head>
<body>
    <h1>Change Password</h1>

    @if (session('warning'))
        <p style="color: #b45309;">{{ session('warning') }}</p>
    @endif
    @if (session('success'))
        <p style="color: #15803d;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <ul style="color: #b91c1c;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('hospital.password.update') }}">
        @csrf
        <div>
            <label for="current_password">Current Password</label>
            <input id="current_password" name="current_password" type="password" required>
        </div>
        <div>
            <label for="new_password">New Password</label>
            <input id="new_password" name="new_password" type="password" required>
        </div>
        <div>
            <label for="new_password_confirmation">Confirm New Password</label>
            <input id="new_password_confirmation" name="new_password_confirmation" type="password" required>
        </div>
        <div>
            <button type="submit">Update Password</button>
        </div>
    </form>
</body>
</html>
