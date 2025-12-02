@extends('layouts.app')

@section('content')
<style>
    .center-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
    }
</style>

<div class="center-wrapper">
    <div class="card shadow p-4" style="max-width: 500px; width: 100%;">
        <h2 class="mb-4 text-center">Payment Confirmation</h2>

        <p><strong>Order ID:</strong> {{ $order }}</p>
        <p><strong>Tracking ID:</strong> {{ $trackingId ?? 'Pending' }}</p>

        @if($trackingId)
            <p>Your payment is being processed. You can check the status below:</p>
            <form method="GET" action="{{ route('payment.status', $trackingId) }}">
                <button type="submit" class="btn btn-primary w-100">Check Payment Status</button>
            </form>
        @else
            <p class="text-danger text-center">Payment initiation failed or is still pending.</p>
        @endif
    </div>
</div>
@endsection
