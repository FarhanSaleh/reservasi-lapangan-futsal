@extends('layouts.admin')

@section('title', 'Pending Payments')

@section('content')
<div class="pending-payments">
    <h2>Pending Payments</h2>
    
    <div class="filter">
        <form action="{{ route('admin.pending-payments') }}" method="GET">
            <select name="sort_by">
                <option value="created_at" selected>Newest First</option>
                <option value="amount">By Amount</option>
            </select>
            <button type="submit" class="btn btn-primary">Sort</button>
        </form>
    </div>

    @if($payments->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Field</th>
                    <th>Amount</th>
                    <th>Proof</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->booking->user->name }}</td>
                    <td>{{ $payment->booking->field->name }}</td>
                    <td>Rp {{ number_format($payment->amount, 2) }}</td>
                    <td>
                        @if($payment->payment_proof_path)
                            <a href="{{ asset('storage/' . $payment->payment_proof_path) }}" target="_blank" class="btn btn-small">View</a>
                        @else
                            Not uploaded
                        @endif
                    </td>
                    <td>{{ $payment->created_at->format('M d, Y H:i') }}</td>
                    <td><a href="{{ route('admin.payment-details', $payment->id) }}" class="btn btn-primary">Review</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $payments->links() }}
        </div>
    @else
        <p>No pending payments.</p>
    @endif
</div>
@endsection
