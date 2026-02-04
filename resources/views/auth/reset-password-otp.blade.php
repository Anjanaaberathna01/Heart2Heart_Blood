<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reset Password with OTP</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Enter OTP and Reset Password</h1>

        @if (session('status'))
            <p>{{ session('status') }}</p>
        @endif

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('otp.reset') }}">
            @csrf
            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', request('email')) }}" placeholder="Email Address" required>
            </div>
            <div>
                <label>OTP</label>
                <input type="text" name="otp" value="{{ old('otp') }}" placeholder="6-digit OTP" inputmode="numeric" pattern="\d{6}" maxlength="6" required>
            </div>
            <div>
                <label>New Password</label>
                <input type="password" name="password" placeholder="New Password" required>
            </div>
            <div>
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            </div>
            <button type="submit">Reset Password</button>
        </form>

        <p>
            Remembered your password? <a href="{{ route('login') }}">Back to login</a>
        </p>
    </body>
</html>
