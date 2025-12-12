@extends('layouts.superadmin')

@section('title', 'Revenue Report')

@section('content')
<div class="revenue-report">
    <h2>Revenue Report</h2>

    <div class="filter">
        <form action="{{ route('superadmin.revenue-report') }}" method="GET">
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Generate Report</button>
        </form>
    </div>

    <div class="report-summary">
        <h3>Summary</h3>
        <div class="summary-card">
            <h4>Total Revenue</h4>
            <p class="large-value">Rp {{ number_format($revenue, 2) }}</p>
        </div>
    </div>

    @if($bookings->count() > 0)
        <h3>Details</h3>
        <table>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Field</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Amount</th>
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
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No bookings in the selected period.</p>
    @endif
</div>
@endsection
