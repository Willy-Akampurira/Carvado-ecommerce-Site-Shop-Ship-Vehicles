@extends('layouts.app')

@section('content')

{{-- AOS CSS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />

{{-- HERO SECTION --}}
<section class="bg-gray-900 text-white min-h-screen flex flex-col justify-center items-center px-4 pt-12 pb-12 text-center">
  <h1 class="text-4xl font-bold mb-4 animate-fade-in">Find Your Perfect Car</h1>
  <p class="text-gray-300 text-lg max-w-xl mb-6 animate-fade-in delay-200">
    Explore our range of high-quality vehicles to find the best fit for your needs and budget.
  </p>
  <a href="{{ route('shop.index') }}" class="shop-now-btn inline-block mb-8 animate-fade-in delay-400">
    <i class="fa-solid fa-shop me-2"></i> Shop Now
  </a>
  <div class="w-full max-w-5xl animate-fade-in delay-600">
    <div id="carSlider" class="splide">
      <div class="splide__track">
        <ul class="splide__list">
          @foreach(['carvado_featured.png', 'carvado_featured_1.png', 'carvado_featured_2.png', 'carvado_featured_3.png'] as $image)
            <li class="splide__slide">
              <img src="{{ asset('storage/cars/' . $image) }}" alt="Featured Car" class="w-full object-cover max-h-[600px]">
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</section>

{{-- BRAND LOGOS SECTION --}}
@php 
  $logos = [
    'audi.png',
    'ferrari.webp',
    'ford.webp',
    'toyota.webp',
    'bmw.webp',
    'mercedes.webp',
    'nissan.webp',
    'lamborghini.png',
    'land-rover.webp',
    'bentley.webp',
    'chevrolet.webp',
    'dodge.png',
    'lexus.webp',
    'mazda.webp',
    'porsche.webp',
    'subaru.webp',
    ];
@endphp
<section class="bg-white py-10">
  <div class="container mx-auto px-4 text-center">
    <div class="flex flex-wrap justify-center items-center gap-6">
      @foreach($logos as $logo)
        <img src="{{ asset('images/logos/' . $logo) }}" alt="{{ $logo }} logo" class="h-12 w-auto transition duration-300 hover:scale-105">
      @endforeach
    </div>
  </div>
</section>

{{-- FEATURED CARS SECTION --}}
@if($featuredCars->count())
<section class="bg-white py-16">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold text-center mb-10">Luxury on Display</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @foreach($featuredCars as $index => $car)
        <div 
          class="bg-white rounded-lg shadow hover:shadow-xl transition transform hover:scale-105 overflow-hidden text-center" 
          data-aos="fade-up" 
          data-aos-delay="{{ $index * 150 }}" 
          data-aos-duration="700"
        >
          <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->make }}" class="w-full h-48 object-cover">
          <!-- 💖 Wishlist Button -->
          <form method="POST" action="{{ route('wishlist.add', $car->id) }}" class="absolute top-3 right-3 z-10">
            @csrf
            <button type="submit" class="text-gray-400 hover:text-red-600 transition">
              <i class="fa-solid fa-heart text-lg"></i>
            </button>
          </form>
          <div class="p-4">
            <h5 class="text-xl font-bold">{{ $car->make }}</h5>
            <p class="text-gray-700 text-lg mb-2">${{ number_format($car->price, 2) }}</p>
            <form method="POST" action="{{ route('cart.add', ['id' => $car->id]) }}">
              @csrf
              <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                <i class="fas fa-cart-plus mr-2"></i> Add to Cart
              </button>
            </form>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@else
<section class="bg-white py-16 text-center">
  <p class="text-gray-600 text-lg">🚧 No featured cars are currently available. Check back soon!</p>
</section>
@endif

{{-- WHY CARVADO SECTION --}}
<section class="bg-gray-50 py-16">
  <div class="container mx-auto px-4 text-center">
    <h2 class="text-3xl font-bold mb-10">Why Carvado?</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div>
        <i class="fas fa-check-circle fa-2x text-red-600 mb-4"></i>
        <h5 class="text-xl font-semibold">Quality Guaranteed</h5>
        <p class="text-gray-600 mt-2">We carefully vet every vehicle before listing it. Only top-condition, high-performance cars make it to our platform — no compromises.</p>
      </div>
      <div>
        <i class="fas fa-tags fa-2x text-red-600 mb-4"></i>
        <h5 class="text-xl font-semibold">Fair Pricing</h5>
        <p class="text-gray-600 mt-2">We believe in honest deals. No hidden fees, no last-minute charges. Just straightforward pricing and clear cost breakdowns.</p>
      </div>
      <div>
        <i class="fas fa-truck fa-2x text-red-600 mb-4"></i>
        <h5 class="text-xl font-semibold">Reliable Shipping</h5>
        <p class="text-gray-600 mt-2">From our warehouse to your driveway — fast, safe, and trackable deliveries across East Africa with dedicated logistics support.</p>
      </div>
    </div>
  </div>
</section>

{{-- 🚀 Testimonials Section --}}
{{-- 🔥 Testimonials Livewire Component --}}
<section class="bg-white py-16">
  <div class="container mx-auto px-4">
    @livewire('testimonials')
  </div>
</section>

<section class="car-categories mt-5 text-center">
    <h2 class="text-xl font-semibold mb-3">Browse by Category</h2>
    <div class="flex flex-wrap justify-center gap-3">
        @foreach($categories as $category)
            <form method="GET" action="{{ route('shop.byCategory') }}">
                <input type="hidden" name="category" value="{{ $category }}">
                <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-600">
                    {{ $category }}
                </button>
            </form>
        @endforeach
    </div>
</section>

<section class="promo-banners mt-10 mb-16 text-center">
    <h2 class="text-2xl font-bold mb-4">🔥 Seasonal Offers & Promotions</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-4">
        <div class="bg-yellow-100 p-6 rounded shadow">
            <h3 class="text-lg font-semibold mb-2">🎉 Back-to-School Deal</h3>
            <p>Get up to <strong>15% off</strong> on all Sedans this August!</p>
        </div>
        <div class="bg-blue-100 p-6 rounded shadow">
            <h3 class="text-lg font-semibold mb-2">🚗 SUV Weekend Flash Sale</h3>
            <p>Enjoy <strong>free shipping</strong> on all SUVs this weekend only.</p>
        </div>
        <div class="bg-red-100 p-6 rounded shadow">
            <h3 class="text-lg font-semibold mb-2">💎 Luxury Clearance</h3>
            <p>Save up to <strong>$5,000</strong> on select luxury models.</p>
        </div>
    </div>
</section>

<section class="shipping-countdown bg-gradient-to-r from-red-800 via-black to-gray-600 text-white py-10 mt-0 text-center">
    <h2 class="text-2xl font-bold mb-4">🚚 Next Shipment Leaves In:</h2>
    <div id="countdown" class="text-4xl font-mono tracking-wide"></div>
    <p class="mt-4 text-sm text-gray-300">Secure your order before the deadline to be included in this batch.</p>
</section>



{{-- SPLIDE & AOS JS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css">
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    new Splide('#carSlider', {
      type: 'loop',
      autoplay: true,
      interval: 4000,
      pauseOnHover: true,
      arrows: false,
      pagination: true,
    }).mount();

    AOS.init();
  });

  // Set the target date (e.g., August 15, 2025 at 5:00 PM)
    const targetDate = new Date("2025-08-15T17:00:00").getTime();

    const countdown = document.getElementById("countdown");
    const interval = setInterval(() => {
        const now = new Date().getTime();
        const distance = targetDate - now;

        if (distance < 0) {
            clearInterval(interval);
            countdown.innerHTML = "🚚 Shipment Departed!";
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        countdown.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
    }, 1000);
</script>

@endsection
