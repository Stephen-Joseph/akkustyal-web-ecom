<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: #f4f5f7;
            font-family: Arial, sans-serif;
        }

        .login-box {
            width: 90%;
            max-width: 400px;
            padding: 35px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 35px #00000010;
        }

        h2 { margin-top: 0; }

        input {
            width: 100%;
            padding: 13px;
            margin: 9px 0 18px;
            border: 1px solid #ddd;
            border-radius: 7px;
        }

        button {
            width: 100%;
            padding: 13px;
            border: 0;
            border-radius: 7px;
            background: #171717;
            color: white;
            cursor: pointer;
        }

        .error { color: #dc2626; }
    </style>
</head>
<body>

<div class="login-box">

    <h2>Admin Login</h2>
    <p>Sign in to access your dashboard.</p>

    @if ($errors->any())
        <p class="error">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf

        <label>Username or Email</label>
        <input
            type="text"
            name="login"
            value="{{ old('login') }}"
            placeholder="Enter username or email"
            autocomplete="username"
            required
            autofocus
        >

        <label>Password</label>
        <input
            type="password"
            name="password"
            placeholder="Enter password"
            autocomplete="current-password"
            required
        >

        <label>
            <input type="checkbox" name="remember" value="1"
                   style="width:auto; margin:0 5px 15px 0;">
            Remember me
        </label>

        <button type="submit">Login</button>
    </form>

</div>

</body>
</html>