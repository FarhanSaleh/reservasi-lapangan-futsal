<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Futsal Reservation') }} - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('styles')
    <style>
        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-info {
            color: white;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-brand">
            <h1>⚽ FUTSAL RESERVASI</h1>
        </div>
        <ul class="navbar-menu">
            <li><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('customer.fields') }}">Lapangan</a></li>
            <li><a href="{{ route('customer.booking-history') }}">Riwayat Booking</a></li>
            <li><a href="{{ route('customer.notifications') }}">Notifikasi</a></li>
            <li>
                <div class="user-menu">
                    <span class="user-info">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-logout">Logout</button>
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success" style="animation: slideIn 0.3s;">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" style="animation: slideIn 0.3s;">{{ session('error') }}</div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning" style="animation: slideIn 0.3s;">{{ session('warning') }}</div>
        @endif

        <h2 style="margin-bottom: 1rem; color: #333;">@yield('page-title')</h2>

        @yield('content')
    </div>

    <footer>
        <p>&copy; 2025 Sistem Reservasi Lapangan Futsal. Semua hak dilindungi.</p>
        <p style="margin-top: 0.5rem; font-size: 0.9rem;">Hubungi kami: info@futsal-reservasi.com | +62-XXX-XXX-XXX</p>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
