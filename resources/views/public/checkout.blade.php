@extends('layouts.app')

@section('content')
<section class="bg-gray-100 min-h-screen px-6 py-12">
  <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Checkout</h1>

  @php
    $cart = session('cart', []);
    $total = array_reduce($cart, fn($sum, $car) => $sum + $car['price'], 0);
  @endphp

  @if (count($cart) > 0)
    <div class="max-w-4xl mx-auto bg-white rounded-md shadow-md p-6">
      <h2 class="text-xl font-semibold text-gray-700 mb-4">Your Order</h2>
      <ul class="divide-y divide-gray-200 mb-6">
        @foreach ($cart as $car)
          <li class="py-4 flex justify-between items-center">
            <span>{{ $car['make'] }}</span>
            <span class="font-semibold text-red-600">${{ number_format($car['price']) }}</span>
          </li>
        @endforeach
        <li class="pt-4 flex justify-between text-lg font-bold text-gray-800">
          <span>Subtotal:</span>
          <span class="text-red-600">${{ number_format($total) }}</span>
        </li>
      </ul>

      <h2 class="text-xl font-semibold text-gray-700 mb-4">Shipping Info</h2>
      <form action="{{ route('checkout.process') }}" method="POST" class="space-y-4">
        @csrf
        <input type="text" name="name" placeholder="Full Name" required class="w-full border border-gray-300 rounded px-4 py-2">
        <input type="email" name="email" placeholder="Email Address" required class="w-full border border-gray-300 rounded px-4 py-2">
        <input type="text" name="address" placeholder="Shipping Address" required class="w-full border border-gray-300 rounded px-4 py-2">

        <!-- Payment Method Selector with PNG Icons -->
        <fieldset>
          <legend class="block text-sm font-medium text-gray-700 mb-2">Select Payment Method</legend>
          <div class="space-y-3">
            <label class="flex items-center space-x-3">
              <input type="radio" name="payment_method" value="mobile_money" required>
              <img src="{{ asset('icons/payment/mobile-money.png') }}" alt="Mobile Money" class="h-6 w-6">
              <span>Mobile Money</span>
            </label>

            <label class="flex items-center space-x-3">
              <input type="radio" name="payment_method" value="airtel_money">
              <img src="{{ asset('icons/payment/airtel-money.png') }}" alt="Airtel Money" class="h-6 w-6">
              <span>Airtel Money</span>
            </label>

            <label class="flex items-center space-x-3">
              <input type="radio" name="payment_method" value="visa">
              <img src="{{ asset('icons/payment/visa.png') }}" alt="Visa" class="h-6 w-6">
              <span>Visa</span>
            </label>

            <label class="flex items-center space-x-3">
              <input type="radio" name="payment_method" value="mastercard">
              <img src="{{ asset('icons/payment/mastercard.png') }}" alt="Mastercard" class="h-6 w-6">
              <span>Mastercard</span>
            </label>
          </div>
        </fieldset>

        <!-- Dynamic Credential Inputs -->
        <div id="mobileFields" class="hidden">
          <input type="text" name="mobile_number" placeholder="Mobile Money Number" class="w-full border border-gray-300 rounded px-4 py-2 mt-2">
        </div>

        <div id="cardFields" class="hidden">
          <input type="text" name="card_number" placeholder="Card Number" class="w-full border border-gray-300 rounded px-4 py-2 mt-2">
          <input type="text" name="card_expiry" placeholder="MM/YY" class="w-full border border-gray-300 rounded px-4 py-2 mt-2">
          <input type="text" name="card_cvc" placeholder="CVC" class="w-full border border-gray-300 rounded px-4 py-2 mt-2">
        </div>

        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-md text-lg font-semibold transition">
          Complete Order
        </button>
      </form>
    </div>
  @else
    <div class="text-center text-gray-500">
      <p class="text-lg">Your cart is empty. You’ll need to add some cars first.</p>
      <a href="{{ route('shop.index') }}" class="mt-4 inline-block bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg font-medium transition">
        <i class="fa-solid fa-shop me-1"></i> Back to Shop
      </a>
    </div>
  @endif
</section>

<!-- Toggle Credential Fields -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const radios = document.querySelectorAll('input[name="payment_method"]');
    const mobileFields = document.getElementById('mobileFields');
    const cardFields = document.getElementById('cardFields');

    radios.forEach(radio => {
      radio.addEventListener('change', function () {
        mobileFields.classList.add('hidden');
        cardFields.classList.add('hidden');

        if (this.value === 'mobile_money' || this.value === 'airtel_money') {
          mobileFields.classList.remove('hidden');
        } else if (this.value === 'visa' || this.value === 'mastercard') {
          cardFields.classList.remove('hidden');
        }
      });
    });
  });
</script>
@endsection
