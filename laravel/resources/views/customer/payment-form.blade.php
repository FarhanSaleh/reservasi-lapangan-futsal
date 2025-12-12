@extends('layouts.customer')

@section('title', 'Payment Proof Upload')

@section('content')
<div class="payment-form">
    <h2>Payment Proof Upload</h2>

    <div class="booking-summary">
        <h3>Booking Summary</h3>
        <p><strong>Field:</strong> {{ $booking->field->name }}</p>
        <p><strong>Date:</strong> {{ $booking->booking_date->format('M d, Y') }}</p>
        <p><strong>Time:</strong> {{ $booking->start_time }} - {{ $booking->end_time }}</p>
        <p><strong>Total Price:</strong> Rp {{ number_format($booking->total_price, 2) }}</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('customer.store-payment', $booking->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="payment_proof">Upload Payment Proof (Image)</label>
            <input type="file" id="payment_proof" name="payment_proof" accept="image/*" required>
            <small>Accepted formats: JPEG, PNG, JPG. Maximum size: 2MB</small>
        </div>

        <div class="form-group">
            <p>After uploading the payment proof, the admin will verify it. Your booking status will be updated once verified.</p>
        </div>

        <button type="submit" class="btn btn-primary">Upload Payment Proof</button>
        <a href="{{ route('customer.booking-history') }}" class="btn btn-secondary">Back to Bookings</a>
    </form>
</div>
@endsection
