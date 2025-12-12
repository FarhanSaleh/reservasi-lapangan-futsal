@extends('layouts.superadmin')

@section('title', 'Manage Admins')

@section('content')
<div class="manage-admins">
    <div class="page-header">
        <h2>Manage Admins</h2>
        <a href="{{ route('superadmin.admins.create') }}" class="btn btn-primary">Add New Admin</a>
    </div>

    <div class="filter">
        <form action="{{ route('superadmin.admins.index') }}" method="GET">
            <input type="text" name="search" placeholder="Search by name or email" value="{{ $search }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    @if($admins->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->phone ?? '-' }}</td>
                    <td>
                        <span class="badge badge-{{ $admin->is_active ? 'success' : 'danger' }}">
                            {{ $admin->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>{{ $admin->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('superadmin.admins.edit', $admin->id) }}" class="btn btn-small">Edit</a>
                        <form action="{{ route('superadmin.admins.delete', $admin->id) }}" method="POST" style="display: inline;">
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
            {{ $admins->links() }}
        </div>
    @else
        <p>No admins found.</p>
    @endif
</div>
@endsection
