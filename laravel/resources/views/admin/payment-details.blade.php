@extends('layouts.admin')

@section('title', 'Payment Details')

@section('content')
<div class="payment-details">
    <h2>Payment Details</h2>
    
    <div class="details-card">
        <h3>Booking Information</h3>
        <p><strong>Customer:</strong> {{ $payment->booking->customer_name }}</p>
        <p><strong>Email:</strong> {{ $payment->booking->user->email }}</p>
        <p><strong>Field:</strong> {{ $payment->booking->field->name }}</p>
        <p><strong>Date:</strong> {{ $payment->booking->booking_date->format('M d, Y') }}</p>
        <p><strong>Time:</strong> {{ $payment->booking->start_time }} - {{ $payment->booking->end_time }}</p>
    </div>

    <div class="details-card">
        <h3>Payment Information</h3>
        <p><strong>Amount:</strong> Rp {{ number_format($payment->amount, 2) }}</p>
        <p><strong>Status:</strong> <span class="badge badge-{{ $payment->status }}">{{ ucfirst($payment->status) }}</span></p>
        <p><strong>Submitted:</strong> {{ $payment->created_at->format('M d, Y H:i') }}</p>
    </div>

    @if($payment->payment_proof_path)
    <div class="details-card">
        <h3>Payment Proof</h3>
        <div class="image-container">
            <img src="{{ asset('storage/' . $payment->payment_proof_path) }}" alt="Payment Proof" style="max-width: 100%; max-height: 500px;">
        </div>
    </div>
    @endif

    @if($payment->status === 'pending')
    <div class="actions">
        <h3>Take Action</h3>
        
        <div class="action-group">
            <h4>Verify Payment</h4>
            <form action="{{ route('admin.verify-payment', $payment->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="verify_notes">Notes (Optional):</label>
                    <textarea id="verify_notes" name="notes" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Verify</button>
            </form>
        </div>

        <div class="action-group">
            <h4>Reject Payment</h4>
            <form action="{{ route('admin.reject-payment', $payment->id) }}" method="POST">
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
