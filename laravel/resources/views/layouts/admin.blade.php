<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Futsal Reservation') }} - Admin @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @yield('styles')
</head>
<body>
    <nav class="admin-navbar">
        <div class="navbar-brand">
            <h1>Admin Panel</h1>
        </div>
        <ul class="navbar-menu">
            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('admin.pending-bookings') }}">Pending Bookings</a></li>
            <li><a href="{{ route('admin.pending-payments') }}">Pending Payments</a></li>
            <li><a href="{{ route('admin.all-bookings') }}">All Bookings</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </li>
        </ul>
    </nav>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>

    <footer>
        <p>&copy; 2025 Futsal Reservation System. All rights reserved.</p>
    </footer>

    <script src="{{ asset('js/admin.js') }}"></script>
    @yield('scripts')
</body>
</html>
