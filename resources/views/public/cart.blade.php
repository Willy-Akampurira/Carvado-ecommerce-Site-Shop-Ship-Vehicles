@extends('layouts.app')

@section('content')
<section class="bg-gray-100 min-h-screen px-6 py-12">
  <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">
    Your Shopping Cart
  </h1>

  @php
    $cart = session('cart', []);
  @endphp

  @if (count($cart) > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 justify-center">
      @foreach ($cart as $id => $car)
        <div x-data="{ confirm: false }" class="group bg-white overflow-hidden rounded-md transition-transform transform hover:-translate-y-1 hover:shadow-lg duration-300 max-w-sm w-full mx-auto">
          <img src="{{ asset('storage/' . $car['image']) }}"
               alt="{{ $car['make'] }}"
               class="w-full h-[200px] md:h-[240px] object-cover rounded-md transition-transform duration-300 group-hover:scale-105"
               onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">

          <div class="p-4 flex flex-col gap-2">
            <h2 class="text-lg font-semibold text-gray-800 group-hover:text-red-600 transition-colors">
              {{ $car['make'] }}
            </h2>

            <span class="text-red-600 font-bold text-base">
              ${{ number_format($car['price']) }}
            </span>

            <button @click="confirm = true"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded text-sm transition w-full">
              <i class="fa-solid fa-trash me-1"></i> Remove
            </button>

            <!-- Confirm Deletion -->
            <div x-show="confirm" x-transition class="mt-3">
              <form action="{{ route('cart.remove', $id) }}" method="POST">
                @csrf
                <p class="text-sm text-gray-600 mb-2">Are you sure you want to remove this car?</p>
                <div class="flex gap-3">
                  <button type="submit"
                          class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                    Yes, Remove
                  </button>
                  <button type="button"
                          @click="confirm = false"
                          class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm">
                    Cancel
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-12 text-center">
      @php
        $total = array_reduce($cart, fn($sum, $car) => $sum + $car['price'], 0);
      @endphp
      <p class="text-xl font-semibold text-gray-800 mb-4">
        Subtotal: <span class="text-red-600">${{ number_format($total) }}</span>
      </p>

      <a href="{{ route('checkout') }}"
         class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg text-lg font-semibold transition transform hover:scale-105">
        Proceed to Checkout
      </a>
    </div>
  @else
    <div class="text-center text-gray-500">
      <p class="text-lg">Your cart is empty. Browse our collection to add some cars!</p>
      <a href="{{ route('shop.index') }}"
         class="mt-4 inline-block bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg font-medium transition">
        <i class="fa-solid fa-shop me-1"></i> Return to Shop
      </a>
    </div>
  @endif
</section>
@endsection
