@extends('layouts.customer')

@section('title', 'Booking History')

@section('content')
<div class="booking-history">
    <h2>My Booking History</h2>
    
    <div class="filter">
        <form action="{{ route('customer.booking-history') }}" method="GET">
            <select name="status">
                <option value="">All Statuses</option>
                <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="rejected" {{ $status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>

    @if($bookings->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Field</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->field->name }}</td>
                    <td>{{ $booking->booking_date->format('M d, Y') }}</td>
                    <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                    <td>Rp {{ number_format($booking->total_price, 2) }}</td>
                    <td><span class="badge badge-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span></td>
                    <td>
                        @if($booking->payment)
                            <span class="badge badge-{{ $booking->payment->status }}">{{ ucfirst($booking->payment->status) }}</span>
                        @else
                            <span class="badge badge-danger">Not Set</span>
                        @endif
                    </td>
                    <td>
                        @if($booking->status === 'pending' && (!$booking->payment || $booking->payment->status === 'pending'))
                            <a href="{{ route('customer.payment-form', $booking->id) }}" class="btn btn-small">Pay</a>
                        @endif
                        <a href="{{ route('customer.field-details', ['fieldId' => $booking->field_id]) }}" class="btn btn-small">Details</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $bookings->links() }}
        </div>
    @else
        <p>No bookings found. <a href="{{ route('customer.fields') }}">Book a field now!</a></p>
    @endif
</div>
@endsection
