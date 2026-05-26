<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="overflow-x-hidden">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Carvado | Welcome</title>

  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  @livewireStyles

  <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
</head>

<body class="font-sans antialiased bg-gray-100 text-gray-900 overflow-x-hidden w-full flex flex-col min-h-screen">

  @include('layouts.navigation')

  <main class="relative flex-grow w-full overflow-x-hidden flex flex-col justify-center items-center py-16 px-4 bg-cover bg-center"
        style="background-image: url('{{ asset('images/showroom-banner.png') }}');">
    
    <div class="absolute inset-0 bg-gradient-to-br from-red-950/80 to-gray-950/90 z-0"></div>

    <div class="relative z-10 w-full max-w-md flex flex-col items-center">
        
        <div class="mb-6">
            <a href="/" class="flex flex-col items-center group">
                <img src="{{ asset('images/logo.png') }}" alt="Carvado Logo" class="h-16 w-auto drop-shadow-md transition duration-300 group-hover:scale-105">
                <span class="text-2xl font-black text-white tracking-wider mt-2 uppercase">Carvado</span>
            </a>
        </div>

        <div class="w-full px-8 py-8 bg-white/95 backdrop-blur-md shadow-2xl border border-white/10 rounded-2xl overflow-hidden">
            {{ $slot }}
        </div>
    </div>
  </main>

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