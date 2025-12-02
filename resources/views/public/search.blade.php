@extends('layouts.app')

@section('content')
<section class="bg-gray-100 min-h-screen px-6 py-12">
  <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">
    Search Results for: <span class="text-red-600">{{ $query }}</span>
  </h1>

  @if ($cars->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 justify-center">
      @foreach ($cars as $car)
        <div class="group bg-white overflow-hidden rounded-md transition-transform transform hover:-translate-y-1 hover:shadow-lg duration-300 max-w-sm w-full mx-auto">
          <img src="{{ asset('storage/' . $car->image) }}"
               alt="{{ $car->make }}"
               class="w-full h-[200px] md:h-[240px] object-cover rounded-md transition-transform duration-300 group-hover:scale-105"
               onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">

          <div class="p-4 flex flex-col gap-2">
            <h2 class="text-lg font-semibold text-gray-800 group-hover:text-red-600 transition-colors">
              {{ $car->make }}
            </h2>

            <span class="text-red-600 font-bold text-base">
              ${{ number_format($car->price) }}
            </span>

            <a href="{{ route('cart.add', $car->id) }}"
               class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm text-center transition-transform duration-200 hover:scale-105">
              <i class="fa-solid fa-cart-shopping mr-1"></i> Add to Cart
            </a>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <div class="text-center text-gray-500 mt-12">
      <p class="text-lg">No vehicles found matching: <span class="font-semibold text-red-600">{{ $query }}</span></p>
      <a href="{{ route('shop.index') }}"
         class="mt-6 inline-block bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg font-medium transition">
        <i class="fa-solid fa-shop me-1"></i> Return to Shop
      </a>
    </div>
  @endif
</section>
@endsection
