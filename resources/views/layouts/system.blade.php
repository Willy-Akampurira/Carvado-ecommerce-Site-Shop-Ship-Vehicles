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

  <div class="fixed top-0 w-full z-50">
      @include('layouts.navigation')
  </div>

  @if(auth()->check())
    <button 
      x-show="!sidebarOpen"
      @click="sidebarOpen = true" 
      class="md:hidden absolute top-[13.5rem] left-6 z-[40] p-2 rounded shadow-md text-white flex items-center justify-center transition active:scale-95 cursor-pointer"
      style="background-color: #2b0d0d; width: 40px; height: 40px;"
    >
      <i class="fa-solid fa-bars text-lg"></i>
    </button>
  @endif

  <div class="pt-52 md:pt-32 flex min-h-screen">
    
    @if(auth()->check())
      <div 
        x-show="sidebarOpen || window.innerWidth >= 768"
        :class="sidebarOpen ? 'fixed top-32 left-0 bottom-0 z-50 w-full' : 'hidden md:!block w-64 flex-shrink-0 items-start'"
        @click.self="sidebarOpen = false"
      >
        <div 
          class="md:hidden fixed inset-0 top-48 bg-black bg-opacity-20" 
          @click="sidebarOpen = false"
        ></div>

        <div 
          :class="sidebarOpen ? 'fixed top-48 left-0 h-[calc(100vh-8rem)] w-64 bg-white shadow-lg overflow-y-auto z-50' : 'sticky top-32 h-[calc(100vh-8rem)] w-64 bg-white shadow-lg overflow-y-auto z-30'"
        >
            @include('layouts.sidebar')
        </div>
      </div>
    @endif

    <div class="flex-1 w-full min-w-0">
      
      @isset($header)
        <header class="mb-6 text-center">
          <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold text-gray-800">{{ $header }}</h1>
          </div>
        </header>
      @endisset

      <main class="p-4 md:p-6">
        @yield('content')
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
    </div>
  </div>

  @livewireScripts
</body>
</html>