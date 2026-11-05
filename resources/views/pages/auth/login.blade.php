<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <title>Customer Login</title>
</head>
<body>
    <h1>Welcome Back</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <p style="color: red;">
        @if (session('error'))
            {{ session('error') }}
        @endif
    </p>

    <form method="POST" action="{{ route('pages.auth.login.submit') }}">
        @csrf

        <input type="email" name="email"
               placeholder="Email address"
               value="{{ old('email') }}" required>

        <input type="password" name="password"
               placeholder="Password" required>

        <button type="submit">Login</button>
    </form>

    <p>New customer?
        <a href="{{ route('pages.auth.register') }}">Create account</a>
    </p>
</body>
</html>