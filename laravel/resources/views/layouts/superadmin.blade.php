<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Futsal Reservation') }} - Super Admin @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/superadmin.css') }}">
    @yield('styles')
</head>
<body>
    <nav class="superadmin-navbar">
        <div class="navbar-brand">
            <h1>Super Admin Panel</h1>
        </div>
        <ul class="navbar-menu">
            <li><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('superadmin.admins.index') }}">Manage Admins</a></li>
            <li><a href="{{ route('superadmin.fields.index') }}">Manage Fields</a></li>
            <li><a href="{{ route('superadmin.schedules.index') }}">Manage Schedules</a></li>
            <li><a href="{{ route('superadmin.revenue-report') }}">Revenue Report</a></li>
            <li><a href="{{ route('superadmin.transaction-report') }}">Transaction Report</a></li>
            <li><a href="{{ route('superadmin.usage-report') }}">Usage Report</a></li>
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

    <script src="{{ asset('js/superadmin.js') }}"></script>
    @yield('scripts')
</body>
</html>
