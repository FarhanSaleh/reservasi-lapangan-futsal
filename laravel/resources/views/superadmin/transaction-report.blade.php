@extends('layouts.superadmin')

@section('title', 'Transaction Report')

@section('content')
<div class="transaction-report">
    <h2>Transaction Report</h2>

    <div class="filter">
        <form action="{{ route('superadmin.transaction-report') }}" method="GET">
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Generate Report</button>
        </form>
    </div>

    <div class="report-summary">
        <h3>Summary</h3>
        <div class="summary-grid">
            <div class="summary-card">
                <h4>Verified Payments</h4>
                <p class="value">{{ $summary['total_verified'] }}</p>
            </div>
            <div class="summary-card">
                <h4>Pending Payments</h4>
                <p class="value">{{ $summary['total_pending'] }}</p>
            </div>
            <div class="summary-card">
                <h4>Rejected Payments</h4>
                <p class="value">{{ $summary['total_rejected'] }}</p>
            </div>
        </div>
    </div>

    @if($transactions->count() > 0)
        <h3>Details</h3>
        <table>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Field</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Verified By</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->booking->user->name }}</td>
                    <td>{{ $transaction->booking->field->name }}</td>
                    <td>Rp {{ number_format($transaction->amount, 2) }}</td>
                    <td><span class="badge badge-{{ $transaction->status }}">{{ ucfirst($transaction->status) }}</span></td>
                    <td>{{ $transaction->verifiedBy?->name ?? '-' }}</td>
                    <td>{{ $transaction->created_at->format('M d, Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $transactions->links() }}
        </div>
    @else
        <p>No transactions in the selected period.</p>
    @endif
</div>
@endsection
