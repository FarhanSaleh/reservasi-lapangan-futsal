@extends('layouts.superadmin')

@section('title', 'Usage Report')

@section('content')
<div class="usage-report">
    <h2>Field Usage Report</h2>

    <div class="filter">
        <form action="{{ route('superadmin.usage-report') }}" method="GET">
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

    <h3>Field Usage Summary</h3>
    @if($fields->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Field Name</th>
                    <th>Location</th>
                    <th>Total Bookings</th>
                    <th>Total Usage Hours</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fields as $field)
                <tr>
                    <td>{{ $field->name }}</td>
                    <td>{{ $field->location }}</td>
                    <td>{{ $field->bookings->count() }}</td>
                    <td>
                        @php
                            $totalHours = 0;
                            foreach($field->bookings as $booking) {
                                $start = \Carbon\Carbon::createFromFormat('H:i', $booking->start_time);
                                $end = \Carbon\Carbon::createFromFormat('H:i', $booking->end_time);
                                $totalHours += $start->diffInHours($end);
                            }
                        @endphp
                        {{ $totalHours }} hours
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h3>All Bookings</h3>
    @if($bookings->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Field</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Duration</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->field->name }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->booking_date->format('M d, Y') }}</td>
                    <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                    <td>
                        @php
                            $start = \Carbon\Carbon::createFromFormat('H:i', $booking->start_time);
                            $end = \Carbon\Carbon::createFromFormat('H:i', $booking->end_time);
                            $hours = $start->diffInHours($end);
                        @endphp
                        {{ $hours }} hours
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No bookings in the selected period.</p>
    @endif
</div>
@endsection
