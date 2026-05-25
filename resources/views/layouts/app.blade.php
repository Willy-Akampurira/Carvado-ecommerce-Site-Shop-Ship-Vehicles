<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="overflow-x-hidden">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Carvado | Shop & Ship Vehicles</title>

  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  @livewireStyles

  <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
</head>

{{-- Changed: Added overflow-x-hidden to prevent horizontal page shifting on small touchscreens --}}
<body class="font-sans antialiased bg-gray-100 text-gray-900 overflow-x-hidden w-full flex flex-col min-h-screen">

  @include('layouts.navigation')

  @isset($header)
    <header class="bg-white shadow w-full">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        {{ $header }}
      </div>
    </header>
  @endisset

  {{-- Changed: Ensured full width containment and proper scaling space --}}
  <main class="min-h-screen w-full overflow-x-hidden flex-grow">
    @yield('content')
  </main>

  <footer class="bg-gray-900 text-white py-12 w-full overflow-x-hidden">
  <div class="w-full px-6 md:px-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-x-12 gap-y-8 justify-between">
      
      <div class="text-left flex flex-col justify-start">
          <h3 class="text-lg font-semibold mb-3 flex items-center">
            <i class="fa-solid fa-location-dot mr-2 text-red-500"></i> 
            Location
          </h3>
          <p class="text-gray-300 text-sm leading-relaxed max-w-xs">Easy View Complex, Mbaguta Street, Mbarara</p>
          <p class="mt-4 text-sm flex items-center">
            <i class="fa-solid fa-envelope mr-2 text-red-500"></i> 
            <a href="mailto:support@carvado.com" class="hover:text-red-400 underline transition">support@carvado.com</a>
          </p>
          <p class="mt-2 text-sm flex items-center">
            <i class="fa-solid fa-phone mr-2 text-red-500"></i>
            <a href="tel:+256777123456" class="hover:text-red-400 underline transition">+256 777 123 456</a>
          </p>
      </div>

      <div class="text-left md:mx-auto">
          <h3 class="text-lg font-semibold mb-3 flex items-center">
            <i class="fa-solid fa-link mr-2 text-red-500"></i> 
            Quick Links
          </h3>
          <ul class="space-y-2 text-sm text-gray-300">
              <li><a href="{{ route('home') }}" class="hover:text-white transition hover:underline">Home</a></li>
              <li><a href="{{ route('shop.index') }}" class="hover:text-white transition hover:underline">Shop</a></li>
              <li><a href="{{ route('about.index') }}" class="hover:text-white transition hover:underline">About</a></li>
              <li><a href="{{ route('contact.index') }}" class="hover:text-white transition hover:underline">Contact</a></li>
          </ul>
      </div>

      <div class="text-left md:mx-auto">
          <h3 class="text-lg font-semibold mb-3 flex items-center">
            <i class="fa-solid fa-file-contract mr-2 text-red-500"></i> 
            Legal
          </h3>
          <ul class="space-y-2 text-sm text-gray-300">
              <li><a href="{{ url('/terms') }}" class="hover:text-white transition hover:underline">Terms & Conditions</a></li>
              <li><a href="{{ url('/privacy') }}" class="hover:text-white transition hover:underline">Privacy Policy</a></li>
          </ul>
      </div>

      <div class="text-left flex flex-col justify-start md:ml-auto max-w-xs w-full">
          <div class="flex items-center gap-2 mb-4">
              <img src="{{ asset('images/logo.png') }}" alt="Carvado Logo" class="h-8 w-auto">
              <span class="text-xl font-bold tracking-tight">Carvado</span>
          </div>
          
          <h3 class="text-sm font-semibold mb-2 text-gray-300 flex items-center">
            <i class="fa-solid fa-envelope-open-text mr-2 text-red-500"></i> 
            Subscribe to News
          </h3>
          <button onclick="window.location.href='{{ url('/newsletter') }}'" class="bg-yellow-500 text-black text-sm font-semibold px-4 py-2.5 rounded hover:bg-yellow-400 transition w-full sm:w-auto inline-block text-center">
              Join Newsletter
          </button>

          <h3 class="text-xs font-semibold mt-6 mb-2 text-gray-400 uppercase tracking-wider flex items-center">
            <i class="fa-solid fa-credit-card mr-2 text-red-500"></i> 
            We Accept
          </h3>
          <div class="flex items-center justify-start gap-3 mt-1 bg-gray-800/50 p-2 rounded-lg w-fit">
            <img src="{{ asset('icons/payment/visa.png') }}" alt="Visa" class="h-5 w-auto object-contain">
            <img src="{{ asset('icons/payment/mobile-money.png') }}" alt="Mobile Money" class="h-5 w-auto object-contain">
            <img src="{{ asset('icons/payment/airtel-money.png') }}" alt="Airtel Money" class="h-5 w-auto object-contain">
            <img src="{{ asset('icons/payment/mastercard.png') }}" alt="Mastercard" class="h-5 w-auto object-contain">
          </div>
      </div>
  </div>

  <div class="mt-12 border-t border-gray-800 pt-6 w-full px-6 md:px-12">
      <div class="flex flex-col sm:flex-row justify-between items-center gap-4 text-sm text-gray-400">
          <p>© {{ date('Y') }} Carvado. All rights reserved.</p>
          <div class="flex gap-6">
              <a href="{{ url('/terms') }}" class="hover:text-white transition hover:underline">Terms</a>
              <a href="{{ url('/privacy') }}" class="hover:text-white transition hover:underline">Privacy</a>
          </div>
      </div>
  </div>
</footer>

  @livewireScripts
</body>
</html>