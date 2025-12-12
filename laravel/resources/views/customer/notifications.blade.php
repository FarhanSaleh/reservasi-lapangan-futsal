@extends('layouts.customer')

@section('title', 'Notifications')

@section('content')
<div class="notifications">
    <h2>My Notifications</h2>

    @if($notifications->count() > 0)
        <div class="notifications-list">
            @foreach($notifications as $notification)
            <div class="notification-item notification-{{ $notification->type }}">
                <h4>{{ $notification->title }}</h4>
                <p>{{ $notification->message }}</p>
                <small>{{ $notification->created_at->diffForHumans() }}</small>
                
                @if(!$notification->is_read)
                    <form action="{{ route('customer.mark-notification-read', $notification->id) }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-small">Mark as Read</button>
                    </form>
                @endif
            </div>
            @endforeach
        </div>

        <div class="pagination">
            {{ $notifications->links() }}
        </div>
    @else
        <p>No notifications yet.</p>
    @endif
</div>
@endsection
