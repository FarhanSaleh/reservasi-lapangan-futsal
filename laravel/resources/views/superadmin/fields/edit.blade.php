@extends('layouts.superadmin')

@section('title', 'Edit Field')

@section('content')
<div class="field-form">
    <h2>Edit Field</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('superadmin.fields.update', $field->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Field Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $field->name) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4">{{ old('description', $field->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" id="location" name="location" value="{{ old('location', $field->location) }}" required>
        </div>

        <div class="form-group">
            <label for="price_per_hour">Price per Hour (Rp)</label>
            <input type="number" id="price_per_hour" name="price_per_hour" value="{{ old('price_per_hour', $field->price_per_hour) }}" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="is_active">
                <input type="checkbox" id="is_active" name="is_active" {{ $field->is_active ? 'checked' : '' }}>
                Active
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Update Field</button>
        <a href="{{ route('superadmin.fields.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
