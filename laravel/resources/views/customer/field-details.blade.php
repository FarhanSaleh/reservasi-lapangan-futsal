@extends('layouts.customer')

@section('title', 'Field Details')

@section('content')
<div class="field-details">
    <h2>{{ $field->name }}</h2>
    
    <div class="field-info">
        <p><strong>Location:</strong> {{ $field->location }}</p>
        <p><strong>Description:</strong> {{ $field->description }}</p>
        <p><strong>Price:</strong> Rp {{ number_format($field->price_per_hour, 2) }}/hour</p>
        
        @if($field->facilities)
            <p><strong>Facilities:</strong></p>
            <ul>
                @foreach(json_decode($field->facilities) as $facility)
                    <li>{{ $facility }}</li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="availability">
        <h3>Available Times on {{ \Carbon\Carbon::parse($date)->format('M d, Y') }}</h3>
        
        <div class="time-slots">
            @php
                $dayOfWeek = \Carbon\Carbon::parse($date)->dayOfWeek;
                $times = [];
                for($hour = 8; $hour < 22; $hour++) {
                    $time = sprintf("%02d:00", $hour);
                    $nextTime = sprintf("%02d:00", $hour + 1);
                    
                    // Check if slot is available
                    $isAvailable = $field->isAvailable($date, $time, $nextTime);
                    $times[] = [
                        'start' => $time,
                        'end' => $nextTime,
                        'available' => $isAvailable
                    ];
                }
            @endphp
            
            @foreach($times as $slot)
                @if($slot['available'])
                    <a href="{{ route('customer.booking-form', ['fieldId' => $field->id, 'date' => $date, 'start_time' => $slot['start']]) }}" class="time-slot available">
                        {{ $slot['start'] }} - {{ $slot['end'] }}
                    </a>
                @else
                    <span class="time-slot unavailable">
                        {{ $slot['start'] }} - {{ $slot['end'] }}
                    </span>
                @endif
            @endforeach
        </div>
    </div>

    <a href="{{ route('customer.fields', ['date' => $date]) }}" class="btn btn-secondary">Back to Fields</a>
</div>
@endsection
