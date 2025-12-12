@extends('layouts.customer')

@section('title', 'Booking Form')

@section('content')
<div class="booking-form">
    <h2>Book {{ $field->name }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('customer.store-booking') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>Field</label>
            <p>{{ $field->name }}</p>
            <input type="hidden" name="field_id" value="{{ $field->id }}">
        </div>

        <div class="form-group">
            <label>Date</label>
            <p>{{ \Carbon\Carbon::parse($date)->format('M d, Y') }}</p>
            <input type="hidden" name="booking_date" value="{{ $date }}">
        </div>

        <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="time" id="start_time" name="start_time" value="{{ $startTime }}" required>
        </div>

        <div class="form-group">
            <label for="end_time">End Time</label>
            <input type="time" id="end_time" name="end_time" required>
        </div>

        <div class="form-group">
            <label for="customer_name">Your Name</label>
            <input type="text" id="customer_name" name="customer_name" value="{{ auth()->user()->name }}" required>
        </div>

        <div class="form-group">
            <label for="customer_phone">Phone Number</label>
            <input type="text" id="customer_phone" name="customer_phone" value="{{ auth()->user()->phone }}" required>
        </div>

        <div class="form-group">
            <label for="notes">Additional Notes (Optional)</label>
            <textarea id="notes" name="notes" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label>Estimated Price</label>
            <p id="estimated-price">Calculating...</p>
        </div>

        <button type="submit" class="btn btn-primary">Proceed to Payment</button>
        <a href="{{ route('customer.field-details', ['fieldId' => $field->id, 'date' => $date]) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
document.getElementById('end_time').addEventListener('change', function() {
    const startTime = document.getElementById('start_time').value;
    const endTime = this.value;
    
    if(startTime && endTime) {
        const start = new Date(`2000-01-01 ${startTime}`);
        const end = new Date(`2000-01-01 ${endTime}`);
        const hours = (end - start) / (1000 * 60 * 60);
        const price = hours * {{ $field->price_per_hour }};
        document.getElementById('estimated-price').textContent = 'Rp ' + price.toLocaleString('id-ID', {minimumFractionDigits: 2});
    }
});
</script>
@endsection
