@extends('layouts.superadmin')

@section('title', 'Manage Fields')

@section('content')
<div class="manage-fields">
    <div class="page-header">
        <h2>Manage Fields</h2>
        <a href="{{ route('superadmin.fields.create') }}" class="btn btn-primary">Add New Field</a>
    </div>

    <div class="filter">
        <form action="{{ route('superadmin.fields.index') }}" method="GET">
            <input type="text" name="search" placeholder="Search by name or location" value="{{ $search }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    @if($fields->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Price/Hour</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fields as $field)
                <tr>
                    <td>{{ $field->name }}</td>
                    <td>{{ $field->location }}</td>
                    <td>Rp {{ number_format($field->price_per_hour, 2) }}</td>
                    <td>
                        <span class="badge badge-{{ $field->is_active ? 'success' : 'danger' }}">
                            {{ $field->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>{{ $field->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('superadmin.fields.edit', $field->id) }}" class="btn btn-small">Edit</a>
                        <form action="{{ route('superadmin.fields.delete', $field->id) }}" method="POST" style="display: inline;">
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
            {{ $fields->links() }}
        </div>
    @else
        <p>No fields found.</p>
    @endif
</div>
@endsection
