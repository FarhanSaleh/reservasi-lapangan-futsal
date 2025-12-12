@extends('layouts.admin')

@section('title', 'All Bookings')

@section('content')
<div class="all-bookings">
    <h2>All Bookings</h2>
    
    <div class="filter">
        <form action="{{ route('admin.all-bookings') }}" method="GET">
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
                    <th>Customer</th>
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
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->field->name }}</td>
                    <td>{{ $booking->booking_date->format('M d, Y') }}</td>
                    <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                    <td>Rp {{ number_format($booking->total_price, 2) }}</td>
                    <td><span class="badge badge-{{ $booking->status }}">{{ ucfirst($booking->status) }}</span></td>
                    <td>
                        @if($booking->payment)
                            <span class="badge badge-{{ $booking->payment->status }}">{{ ucfirst($booking->payment->status) }}</span>
                        @endif
                    </td>
                    <td><a href="{{ route('admin.booking-details', $booking->id) }}" class="btn btn-small">View</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $bookings->links() }}
        </div>
    @else
        <p>No bookings found.</p>
    @endif
</div>
@endsection
