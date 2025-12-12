@extends('layouts.admin')

@section('title', 'Pending Bookings')

@section('content')
<div class="pending-bookings">
    <h2>Pending Bookings</h2>
    
    <div class="filter">
        <form action="{{ route('admin.pending-bookings') }}" method="GET">
            <select name="sort_by">
                <option value="created_at" selected>Newest First</option>
                <option value="booking_date">By Date</option>
            </select>
            <button type="submit" class="btn btn-primary">Sort</button>
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
                    <td><a href="{{ route('admin.booking-details', $booking->id) }}" class="btn btn-primary">Review</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $bookings->links() }}
        </div>
    @else
        <p>No pending bookings.</p>
    @endif
</div>
@endsection
