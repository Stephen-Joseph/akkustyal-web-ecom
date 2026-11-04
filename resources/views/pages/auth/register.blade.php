<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
</head>
<body>
    <h1>Create your account</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('pages.auth.register.submit') }}">
        @csrf

        <input name="first_name" placeholder="First name"
               value="{{ old('first_name') }}" required>

        <input name="last_name" placeholder="Last name"
               value="{{ old('last_name') }}" required>

        <input type="email" name="email" placeholder="Email address"
               value="{{ old('email') }}" required>

        <input name="phone" placeholder="Phone number"
               value="{{ old('phone') }}">

        <input type="password" name="password"
               placeholder="Password" required>

        <input type="password" name="password_confirmation"
               placeholder="Confirm password" required>

        <button type="submit">Create Account</button>
    </form>

    <p>Already registered?
        <a href="{{ route('pages.auth.login') }}">Login</a>
    </p>
</body>
</html>