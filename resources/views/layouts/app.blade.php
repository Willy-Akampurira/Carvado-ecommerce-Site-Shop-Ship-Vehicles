<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Carvado | Shop & Ship Vehicles</title>

  <!-- Figtree Font from Bunny.net -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <!-- Tailwind & AlpineJS -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- Livewire Styles -->
  @livewireStyles

  <!-- Optional Favicon -->
  <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
</head>

<body class="font-sans antialiased bg-gray-100 text-gray-900">

  <!-- Navbar Include -->
  @include('layouts.navigation')

  <!-- Page Heading Slot -->
  @isset($header)
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        {{ $header }}
      </div>
    </header>
  @endisset

  <!-- Page Content -->
  <main class="min-h-screen">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white py-10 px-6">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Contact Widget -->
        <div>
            <h3 class="text-lg font-semibold mb-2">
              <i class="fa-solid fa-location-dot mr-2 text-red-500"></i> 
              Location
            </h3>
            <p>Easy View Complex, Mbaguta Street, Mbarara</p>
            <p class="mt-2">
              <i class="fa-solid fa-envelope mr-2 text-red-500"></i> 
              <a href="mailto:support@carvado.com" class="underline">support@carvado.com</a>
            </p>
            <p>
              <i class="fa-solid fa-phone mr-2 text-red-500"></i>
              <a href="tel:+256777123456" class="underline">+256 777 123 456</a>
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h3 class="text-lg font-semibold mb-2">
              <i class="fa-solid fa-link mr-2 text-red-500"></i> 
              Quick Links
            </h3>
            <ul class="space-y-1">
                <li><a href="{{ route('home') }}" class="hover:underline">Home</a></li>
                <li><a href="{{ route('shop.index') }}" class="hover:underline">Shop</a></li>
                <li><a href="{{ route('about.index') }}" class="hover:underline">About</a></li>
                <li><a href="{{ route('contact.index') }}" class="hover:underline">Contact</a></li>
            </ul>
        </div>

        <!-- Legal Links -->
        <div>
            <h3 class="text-lg font-semibold mb-2">
              <i class="fa-solid fa-file-contract mr-2 text-red-500"></i> 
              Legal
            </h3>
            <ul class="space-y-1">
                <li><a href="{{ url('/terms') }}" class="hover:underline">Terms & Conditions</a></li>
                <li><a href="{{ url('/privacy') }}" class="hover:underline">Privacy Policy</a></li>
            </ul>
        </div>

        <!-- Newsletter & Logo -->
        <div class="text-center md:text-left">
            <img src="{{ asset('images/logo.png') }}" alt="Carvado Logo" class="h-10 mb-3 mx-auto md:mx-0">
            <h3 class="text-lg font-semibold mb-2">
              <i class="fa-solid fa-envelope-open-text mr-2 text-red-500"></i> 
              Subscribe to News
            </h3>
            <button onclick="window.location.href='{{ url('/newsletter') }}'" class="bg-yellow-500 text-black px-4 py-2 rounded hover:bg-yellow-400">
                Join Newsletter
            </button>

            <!-- Payment Icons -->
              <h3 class="text-lg font-semibold mt-6 mb-2">
              <i class="fa-solid fa-credit-card mr-2 text-red-500"></i> 
              We Accept
            </h3>
            <div class="mt-6 flex justify-center md:justify-start space-x-4">
              <img src="{{ asset('icons/payment/visa.png') }}" alt="Visa" class="h-6 w-auto">
              <img src="{{ asset('icons/payment/mobile-money.png') }}" alt="Mobile Money" class="h-6 w-auto">
              <img src="{{ asset('icons/payment/airtel-money.png') }}" alt="Airtel Money" class="h-6 w-auto">
              <img src="{{ asset('icons/payment/mastercard.png') }}" alt="Mastercard" class="h-6 w-auto">
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="mt-10 border-t border-gray-700 pt-4 text-sm text-gray-400 flex justify-between items-center">
        <p>© 2025 Carvado. All rights reserved.</p>
        <div class="space-x-4">
            <a href="{{ url('/terms') }}" class="hover:underline">Terms</a>
            <a href="{{ url('/privacy') }}" class="hover:underline">Privacy</a>
        </div>
    </div>
  </footer>

  <!-- Livewire Scripts -->
  @livewireScripts
</body>
</html>
