<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Forgot Password</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>Forgot Password</h1>

            @if (session('status') || session('email'))
                <p>
                    {{ session('status') ?? 'OTP sent to your email.' }}
                    @if (session('email'))
                        <strong>{{ session('email') }}</strong>
                    @endif
                </p>
            @endif

        <form method="POST" action="{{ route('otp.email') }}">
            @csrf
            <input type="email" name="email" placeholder="Email Address" required>
            <button type="submit">Send Password Reset OTP</button>
        </form>
    </body>
</html>
