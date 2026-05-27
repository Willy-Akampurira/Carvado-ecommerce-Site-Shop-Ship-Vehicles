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
</head>

<body class="font-sans antialiased bg-gray-100 text-gray-900" x-data="{ sidebarOpen: false }">

  @include('layouts.navigation')

  <div class="min-h-screen flex relative">
    
    @if(auth()->check())
      <div 
        :class="sidebarOpen ? 'fixed inset-0 z-40 flex' : 'hidden md:flex'" 
        class="md:relative md:z-0"
      >
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black opacity-50 md:hidden"></div>
        
        <div class="relative bg-white w-64 h-full shadow-lg overflow-y-auto">
            @include('layouts.sidebar')
        </div>
      </div>
    @endif

    <div class="flex-1 w-full overflow-hidden relative">
      
      <!-- Mobile Sidebar Toggle Button -->
      @if(auth()->check())
        <button 
          @click="sidebarOpen = !sidebarOpen" 
          class="md:hidden absolute top-4 left-4 z-30 p-2 rounded shadow-md text-white"
          style="background-color: #2b0d0d;"
        >
          <i class="fa-solid fa-bars"></i>
        </button>
      @endif

      @isset($header)
        <header class="bg-white shadow">
          <!-- Added padding-left for mobile to accommodate the button if needed -->
          <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 {{ auth()->check() ? 'pl-16 md:pl-8' : '' }}">
            {{ $header }}
          </div>
        </header>
      @endisset

      <main class="p-4 md:p-6">
        @yield('content')
      </main>
    </div>
  </div>

  <footer class="bg-gray-900 text-white py-6 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row justify-between items-center gap-4 text-sm text-gray-400">
        <p>© {{ date('Y') }} Carvado. All rights reserved.</p>
        <div class="flex gap-6">
            <a href="{{ url('/terms') }}" class="hover:text-white transition">Terms</a>
            <a href="{{ url('/privacy') }}" class="hover:text-white transition">Privacy</a>
        </div>
    </div>
  </footer>

  @livewireScripts
</body>
</html>