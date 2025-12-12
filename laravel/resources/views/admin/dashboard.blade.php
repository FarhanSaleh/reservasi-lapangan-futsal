@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="admin-dashboard">
    <h2>Admin Dashboard</h2>
    
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Pending Bookings</h3>
            <p class="stat-value">{{ $stats['pending_bookings'] }}</p>
            <a href="{{ route('admin.pending-bookings') }}">View</a>
        </div>
        <div class="stat-card">
            <h3>Pending Payments</h3>
            <p class="stat-value">{{ $stats['pending_payments'] }}</p>
            <a href="{{ route('admin.pending-payments') }}">View</a>
        </div>
        <div class="stat-card">
            <h3>Confirmed Bookings</h3>
            <p class="stat-value">{{ $stats['confirmed_bookings'] }}</p>
        </div>
        <div class="stat-card">
            <h3>Total Revenue</h3>
            <p class="stat-value">Rp {{ number_format($stats['total_revenue'], 2) }}</p>
        </div>
    </div>

    <div class="pending-section">
        <h3>Recent Pending Bookings</h3>
        @if($pendingBookings->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Field</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingBookings as $booking)
                    <tr>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->field->name }}</td>
                        <td>{{ $booking->booking_date->format('M d, Y') }}</td>
                        <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                        <td>Rp {{ number_format($booking->total_price, 2) }}</td>
                        <td><a href="{{ route('admin.booking-details', $booking->id) }}" class="btn btn-small">Review</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="pending-payments-section">
        <h3>Recent Pending Payments</h3>
        @if($pendingPayments->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Field</th>
                        <th>Amount</th>
                        <th>Proof</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingPayments as $payment)
                    <tr>
                        <td>{{ $payment->booking->user->name }}</td>
                        <td>{{ $payment->booking->field->name }}</td>
                        <td>Rp {{ number_format($payment->amount, 2) }}</td>
                        <td>
                            @if($payment->payment_proof_path)
                                <a href="{{ asset('storage/' . $payment->payment_proof_path) }}" target="_blank" class="btn btn-small">View</a>
                            @else
                                Not uploaded
                            @endif
                        </td>
                        <td><a href="{{ route('admin.payment-details', $payment->id) }}" class="btn btn-small">Review</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
