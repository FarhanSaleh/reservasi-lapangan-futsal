@extends('layouts.superadmin')

@section('title', 'Add New Admin')

@section('content')
<div class="admin-form">
    <h2>Create New Admin</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('superadmin.admins.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Admin</button>
        <a href="{{ route('superadmin.admins.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
