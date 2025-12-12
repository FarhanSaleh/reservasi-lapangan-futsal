@extends('layouts.admin')

@section('title', 'Booking Details')

@section('content')
<div class="booking-details">
    <h2>Booking Details</h2>
    
    <div class="details-card">
        <h3>Customer Information</h3>
        <p><strong>Name:</strong> {{ $booking->customer_name }}</p>
        <p><strong>Email:</strong> {{ $booking->user->email }}</p>
        <p><strong>Phone:</strong> {{ $booking->customer_phone }}</p>
    </div>

    <div class="details-card">
        <h3>Booking Information</h3>
        <p><strong>Field:</strong> {{ $booking->field->name }}</p>
        <p><strong>Date:</strong> {{ $booking->booking_date->format('M d, Y') }}</p>
        <p><strong>Time:</strong> {{ $booking->start_time }} - {{ $booking->end_time }}</p>
        <p><strong>Total Price:</strong> Rp {{ number_format($booking->total_price, 2) }}</p>
        <p><strong>Notes:</strong> {{ $booking->notes ?? 'None' }}</p>
    </div>

    @if($booking->payment)
    <div class="details-card">
        <h3>Payment Information</h3>
        <p><strong>Status:</strong> <span class="badge badge-{{ $booking->payment->status }}">{{ ucfirst($booking->payment->status) }}</span></p>
        <p><strong>Amount:</strong> Rp {{ number_format($booking->payment->amount, 2) }}</p>
        
        @if($booking->payment->payment_proof_path)
            <p><strong>Payment Proof:</strong> <a href="{{ asset('storage/' . $booking->payment->payment_proof_path) }}" target="_blank" class="btn btn-small">View</a></p>
        @endif
    </div>
    @endif

    @if($booking->status === 'pending')
    <div class="actions">
        <h3>Take Action</h3>
        
        <div class="action-group">
            <h4>Approve Booking</h4>
            <form action="{{ route('admin.approve-booking', $booking->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="approve_notes">Notes (Optional):</label>
                    <textarea id="approve_notes" name="notes" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Approve</button>
            </form>
        </div>

        <div class="action-group">
            <h4>Reject Booking</h4>
            <form action="{{ route('admin.reject-booking', $booking->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="rejection_reason">Rejection Reason:</label>
                    <textarea id="rejection_reason" name="rejection_reason" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-danger">Reject</button>
            </form>
        </div>
    </div>
    @endif
</div>
@endsection
