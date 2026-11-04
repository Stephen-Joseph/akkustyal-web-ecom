<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
</head>
<body>
    <h1>Customer Dashboard</h1>

    <h2>Welcome, {{ $customer->first_name }}!</h2>

    <p>Email: {{ $customer->email }}</p>
    <p>Phone: {{ $customer->phone ?? 'Not added' }}</p>

    <form method="POST" action="{{ route('customer.logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>