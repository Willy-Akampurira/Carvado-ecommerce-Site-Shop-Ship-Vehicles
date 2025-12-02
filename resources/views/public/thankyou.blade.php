@extends('layouts.app') {{-- Or use your preferred layout --}}

@section('title', 'Order Confirmed')

@section('content')
<div class="container py-5 text-center">
    <h1 class="mb-4">🎉 Thank You, {{ session('order_id') ? 'Order #' . session('order_id') : 'Customer' }}!</h1>
    <p>Your order has been successfully placed and confirmed.</p>
    <p>We’ve sent a confirmation email to your inbox.</p>
    <a href="{{ route('home') }}" class="btn btn-primary mt-4">Return to Homepage</a>
</div>
@endsection
