@extends('layouts.superadmin')

@section('title', 'Dashboard')

@section('content')
<div class="superadmin-dashboard">
    <h2>Super Admin Dashboard</h2>
    
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Users</h3>
            <p class="stat-value">{{ $stats['total_users'] }}</p>
        </div>
        <div class="stat-card">
            <h3>Total Admins</h3>
            <p class="stat-value">{{ $stats['total_admins'] }}</p>
        </div>
        <div class="stat-card">
            <h3>Total Fields</h3>
            <p class="stat-value">{{ $stats['total_fields'] }}</p>
        </div>
        <div class="stat-card">
            <h3>Total Bookings</h3>
            <p class="stat-value">{{ $stats['total_bookings'] }}</p>
        </div>
        <div class="stat-card">
            <h3>Total Revenue</h3>
            <p class="stat-value">Rp {{ number_format($stats['total_revenue'], 2) }}</p>
        </div>
        <div class="stat-card">
            <h3>Pending Payments</h3>
            <p class="stat-value">{{ $stats['pending_payments'] }}</p>
        </div>
    </div>

    <div class="quick-links">
        <h3>Quick Links</h3>
        <div class="link-grid">
            <a href="{{ route('superadmin.admins.index') }}" class="quick-link">Manage Admins</a>
            <a href="{{ route('superadmin.fields.index') }}" class="quick-link">Manage Fields</a>
            <a href="{{ route('superadmin.schedules.index') }}" class="quick-link">Manage Schedules</a>
            <a href="{{ route('superadmin.revenue-report') }}" class="quick-link">Revenue Report</a>
            <a href="{{ route('superadmin.transaction-report') }}" class="quick-link">Transaction Report</a>
            <a href="{{ route('superadmin.usage-report') }}" class="quick-link">Usage Report</a>
        </div>
    </div>

    <div class="recent-bookings">
        <h3>Recent Bookings</h3>
        @if($recentBookings->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Field</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentBookings as $booking)
                    <tr>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->field->name }}</td>
                        <td>{{ $booking->booking_date->format('M d, Y') }}</td>
                        <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                        <td>Rp {{ number_format($booking->total_price, 2) }}</td>
                        <td><span class="badge badge-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
