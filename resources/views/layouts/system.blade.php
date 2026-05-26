<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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

<body class="font-sans antialiased bg-gray-100 text-gray-900">

  @include('layouts.navigation')

  <div class="min-h-screen flex">
    @if(auth()->check())
      @include('layouts.sidebar')
    @endif

    <div class="flex-1">
      @isset($header)
        <header class="bg-white shadow">
          <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
          </div>
        </header>
      @endisset

      <main class="p-6">
        @yield('content')
      </main>
    </div>
  </div>

  <footer class="bg-gray-900 text-white py-6 w-full overflow-x-hidden border-t border-gray-800 mt-auto">
      <div class="w-full px-6 md:px-12">
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