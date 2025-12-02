@extends('layouts.app')

@section('content')
<section class="bg-gray-100 min-h-screen px-6 py-12">
  <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">
    Explore Our Vehicle Collection
  </h1>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-8">
    @foreach ($cars as $car)
      <div class="relative group bg-white overflow-hidden rounded transition-transform transform hover:-translate-y-1 hover:shadow-lg duration-300">
        <!-- 📷 Car Image -->
        <img src="{{ asset('storage/' . $car->image) }}"
             alt="{{ $car->make }}"
             class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105"
             onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">

        <!-- 💖 Wishlist Button -->
        <form method="POST" action="{{ route('wishlist.add', $car->id) }}" class="absolute top-3 right-3 z-10">
          @csrf
          <button type="submit" class="text-gray-400 hover:text-red-600 transition">
            <i class="fa-solid fa-heart text-lg"></i>
          </button>
        </form>

        <!-- 🚗 Car Info + Cart Button -->
        <div class="p-4 flex flex-col gap-2 transition-opacity duration-300 group-hover:opacity-90">
          <h2 class="text-lg font-semibold text-gray-800 group-hover:text-red-600 transition-colors duration-300">
            {{ $car->make }}
          </h2>

          <span class="text-red-600 font-bold text-base">
            ${{ number_format($car->price, 2) }}
          </span>

          <form method="POST" action="{{ route('cart.add', $car->id) }}">
            @csrf
            <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm text-center transition-transform duration-200 hover:scale-105 w-full">
              <i class="fa-solid fa-cart-shopping mr-1"></i> Add to Cart
            </button>
          </form>
        </div>
      </div>
    @endforeach
  </div>
</section>
@endsection
