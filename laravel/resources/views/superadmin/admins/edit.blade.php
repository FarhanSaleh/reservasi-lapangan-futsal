@extends('layouts.superadmin')

@section('title', 'Edit Admin')

@section('content')
<div class="admin-form">
    <h2>Edit Admin</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('superadmin.admins.update', $admin->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $admin->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $admin->email) }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $admin->phone) }}">
        </div>

        <div class="form-group">
            <label for="password">Password (Leave blank to keep current)</label>
            <input type="password" id="password" name="password">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>

        <div class="form-group">
            <label for="is_active">
                <input type="checkbox" id="is_active" name="is_active" {{ $admin->is_active ? 'checked' : '' }}>
                Active
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Update Admin</button>
        <a href="{{ route('superadmin.admins.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
