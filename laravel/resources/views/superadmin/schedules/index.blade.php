@extends('layouts.superadmin')

@section('title', 'Manage Schedules')

@section('content')
<div class="manage-schedules">
    <div class="page-header">
        <h2>Manage Schedules</h2>
        <a href="{{ route('superadmin.schedules.create') }}" class="btn btn-primary">Add New Schedule</a>
    </div>

    <div class="filter">
        <form action="{{ route('superadmin.schedules.index') }}" method="GET">
            <select name="field_id">
                <option value="">All Fields</option>
                @foreach(\App\Models\Field::all() as $field)
                    <option value="{{ $field->id }}" {{ $fieldId == $field->id ? 'selected' : '' }}>{{ $field->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>

    @if($schedules->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Field</th>
                    <th>Day</th>
                    <th>Open Time</th>
                    <th>Close Time</th>
                    <th>Price/Hour</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->field->name }}</td>
                    <td>{{ ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][$schedule->day_of_week] }}</td>
                    <td>{{ $schedule->open_time }}</td>
                    <td>{{ $schedule->close_time }}</td>
                    <td>Rp {{ number_format($schedule->price_per_hour, 2) }}</td>
                    <td>
                        <a href="{{ route('superadmin.schedules.edit', $schedule->id) }}" class="btn btn-small">Edit</a>
                        <form action="{{ route('superadmin.schedules.delete', $schedule->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-small btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $schedules->links() }}
        </div>
    @else
        <p>No schedules found.</p>
    @endif
</div>
@endsection
