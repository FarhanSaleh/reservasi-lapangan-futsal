@extends('layouts.superadmin')

@section('title', 'Add New Schedule')

@section('content')
<div class="schedule-form">
    <h2>Create New Schedule</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('superadmin.schedules.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="field_id">Field</label>
            <select id="field_id" name="field_id" required>
                <option value="">Select Field</option>
                @foreach($fields as $field)
                    <option value="{{ $field->id }}" {{ old('field_id') == $field->id ? 'selected' : '' }}>{{ $field->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="day_of_week">Day of Week</label>
            <select id="day_of_week" name="day_of_week" required>
                <option value="">Select Day</option>
                <option value="0" {{ old('day_of_week') == '0' ? 'selected' : '' }}>Sunday</option>
                <option value="1" {{ old('day_of_week') == '1' ? 'selected' : '' }}>Monday</option>
                <option value="2" {{ old('day_of_week') == '2' ? 'selected' : '' }}>Tuesday</option>
                <option value="3" {{ old('day_of_week') == '3' ? 'selected' : '' }}>Wednesday</option>
                <option value="4" {{ old('day_of_week') == '4' ? 'selected' : '' }}>Thursday</option>
                <option value="5" {{ old('day_of_week') == '5' ? 'selected' : '' }}>Friday</option>
                <option value="6" {{ old('day_of_week') == '6' ? 'selected' : '' }}>Saturday</option>
            </select>
        </div>

        <div class="form-group">
            <label for="open_time">Open Time</label>
            <input type="time" id="open_time" name="open_time" value="{{ old('open_time') }}" required>
        </div>

        <div class="form-group">
            <label for="close_time">Close Time</label>
            <input type="time" id="close_time" name="close_time" value="{{ old('close_time') }}" required>
        </div>

        <div class="form-group">
            <label for="price_per_hour">Price per Hour (Rp)</label>
            <input type="number" id="price_per_hour" name="price_per_hour" value="{{ old('price_per_hour') }}" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Schedule</button>
        <a href="{{ route('superadmin.schedules.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
