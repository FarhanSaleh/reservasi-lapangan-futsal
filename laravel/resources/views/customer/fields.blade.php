@extends('layouts.customer')

@section('title', 'Available Fields')

@section('content')
<div class="fields-container">
    <h2>Available Futsal Fields</h2>
    
    <div class="date-filter">
        <form action="{{ route('customer.fields') }}" method="GET">
            <label for="date">Select Date:</label>
            <input type="date" id="date" name="date" value="{{ $date }}" required>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>

    <div class="fields-grid">
        @foreach($fields as $field)
        <div class="field-card">
            <h3>{{ $field->name }}</h3>
            <p>{{ $field->description }}</p>
            <p><strong>Location:</strong> {{ $field->location }}</p>
            <p><strong>Price:</strong> Rp {{ number_format($field->price_per_hour, 2) }}/hour</p>
            
            @if($field->facilities)
                <p><strong>Facilities:</strong></p>
                <ul>
                    @foreach(json_decode($field->facilities) as $facility)
                        <li>{{ $facility }}</li>
                    @endforeach
                </ul>
            @endif
            
            <a href="{{ route('customer.field-details', ['fieldId' => $field->id, 'date' => $date]) }}" class="btn btn-primary">View Details</a>
        </div>
        @endforeach
    </div>
</div>
@endsection
