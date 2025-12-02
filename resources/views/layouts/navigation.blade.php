<!-- 🔒 Sticky Wrapper: Keeps both bars pinned together -->
<div class="sticky top-0 z-50">
  
  <!-- 🌐 Top Info Bar -->
  <div class="bg-gray-100 text-sm text-gray-700 py-2 border-b border-gray-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between flex-wrap gap-y-2">
      <!-- 📍 Address -->
      <div class="flex items-center gap-2">
        <i class="fa-solid fa-location-dot text-red-500"></i>
        <span>Easy View Complex, Mbaguta Street, Mbarara</span>
      </div>

      <!-- 📬 Email -->
      <div class="flex items-center gap-2">
        <i class="fa-solid fa-envelope text-red-500"></i>
        <a href="mailto:support@carvado.com" class="hover:underline">support@carvado.com</a>
      </div>

      <!-- 📞 Phone -->
      <div class="flex items-center gap-2">
        <i class="fa-solid fa-phone text-red-500"></i>
        <a href="tel:+256777123456" class="hover:underline">+256 777 123 456</a>
      </div>

      <!-- 📱 Social Media -->
      <div class="flex items-center gap-3">
        <a href="https://facebook.com/carvado" target="_blank" class="text-blue-600 hover:text-blue-800">
          <i class="fa-brands fa-facebook-f"></i>
        </a>
        <a href="https://instagram.com/carvado" target="_blank" class="text-pink-500 hover:text-pink-700">
          <i class="fa-brands fa-instagram"></i>
        </a>
        <a href="https://twitter.com/carvado" target="_blank" class="text-blue-400 hover:text-blue-600">
          <i class="fa-brands fa-x-twitter"></i>
        </a>
        <a href="https://linkedin.com/company/carvado" target="_blank" class="text-blue-700 hover:text-blue-900">
          <i class="fa-brands fa-linkedin-in"></i>
        </a>
      </div>
    </div>
  </div>

  <!-- 🚗 Main Navigation -->
  <nav x-data="{ open: false, showSearch: false }" class="bg-white shadow border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center py-6 justify-between">
        <!-- 🏁 Logo Section -->
        <div class="flex items-center gap-3 pr-80">
          <a href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Carvado Logo" class="h-12 w-auto">
          </a>
          <span class="text-2xl font-bold text-gray-800 tracking-tight">Carvado</span>
        </div>

        <!-- 🖥️ Navigation + Actions -->
        <div class="hidden sm:flex items-center justify-between flex-grow ml-8">
          <div class="flex items-center gap-6 text-base font-medium text-gray-700">
            <a href="{{ route('home') }}" class="hover:text-red-600 transition">Home</a>
            <a href="{{ route('shop.index') }}" class="hover:text-red-600 transition">Shop</a>
            <a href="{{ route('about.index') }}" class="hover:text-red-600 transition">About</a>
            <a href="{{ route('contact.index') }}" class="hover:text-red-600 transition">Contact</a>
          </div>
          <div class="flex items-center gap-4 ml-auto">
            <button @click="showSearch = !showSearch" class="hover:text-red-600 transition focus:outline-none">
              <i class="fa-solid fa-magnifying-glass text-xl"></i>
            </button>

            <!-- 👤 User Account Icon -->
            <a href="{{ route('account.index') }}" class="hover:text-red-600 transition">
              <i class="fa-solid fa-user text-lg"></i>
            </a>

            <!-- 💖 Wishlist Icon -->
            <a href="{{ route('wishlist.index') }}" class="hover:text-red-600 transition">
              <i class="fa-solid fa-heart text-lg"></i>
            </a>

            <!-- 🛒 Cart Icon with Item Count -->
            <a href="{{ route('cart.index') }}" class="relative hover:text-red-600 transition">
              <i class="fa-solid fa-cart-shopping text-lg"></i>
              @if(session('cart') && count(session('cart')) > 0)
                <span class="absolute top-[-6px] right-[-8px] bg-red-500 text-white text-xs px-1 rounded-full">
                  {{ count(session('cart')) }}
                </span>
              @endif
            </a>

            <!-- 🔐 Log In / Sign Up Buttons -->
              <div class="ml-4 flex gap-2">
                <a href="{{ route('login') }}" class="px-3 py-1.5 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition">
                  Log In
                </a>
                <a href="{{ route('register') }}" class="px-3 py-1.5 border border-red-600 text-red-600 text-sm rounded hover:bg-red-50 transition">
                  Sign Up
                </a>
              </div>
          </div>
        </div>

        <!-- 🍔 Mobile Tools -->
        <div class="sm:hidden flex items-center gap-4">
          <button @click="showSearch = !showSearch" class="text-gray-600 hover:text-red-600 transition focus:outline-none">
            <i class="fa-solid fa-magnifying-glass text-lg"></i>
          </button>
          <button @click="open = !open" class="p-3 text-gray-500 hover:text-gray-700 focus:outline-none">
            <i class="fa-solid fa-bars text-xl"></i>
          </button>
        </div>
      </div>

      <!-- 🔍 Search Input -->
      <div x-show="showSearch" x-transition class="relative mt-2">
        <form action="{{ route('search') }}" method="GET"
              class="absolute right-0 w-full sm:w-96 bg-white border border-gray-300 rounded-md shadow-lg p-3 flex items-center gap-2">
          <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
          <input type="text" name="query" placeholder="Search vehicles..."
                 class="w-full border-none focus:ring-0 text-sm text-gray-800" />
          <button type="submit" class="text-red-600 hover:text-red-700 font-semibold text-sm">Go</button>
        </form>
      </div>
    </div>

    <!-- 📱 Mobile Menu -->
    <div x-show="open" x-transition class="sm:hidden px-4 pb-4 space-y-3 text-base text-gray-700 font-semibold">
      <a href="{{ route('home') }}" class="block hover:text-red-600">Home</a>
      <a href="{{ route('shop.index') }}" class="block hover:text-red-600">Shop</a>
      <a href="{{ route('about.index') }}" class="block hover:text-red-600">About</a>
      <a href="{{ route('contact.index') }}" class="block hover:text-red-600">Contact</a>

      <!-- 👤 User Account (Mobile) -->
      <a href="{{ route('account.index') }}" class="block hover:text-red-600">
        <i class="fa-solid fa-user mr-2"></i> My Account
      </a>

      <!-- 💖 Wishlist (Mobile) -->
      <a href="{{ route('wishlist.index') }}" class="block hover:text-red-600">
        <i class="fa-solid fa-heart mr-2"></i> Wishlist
      </a>

      <!-- 🛒 Cart (Mobile) --> 
      <a href="{{ route('cart.index') }}" class="block hover:text-red-600 relative">
        <i class="fa-solid fa-cart-shopping mr-2"></i> Cart
        @if(session('cart') && count(session('cart')) > 0)
          <span class="absolute top-[-2px] left-24 bg-red-500 text-white text-xs px-1 rounded-full">
            {{ count(session('cart')) }}
          </span>
        @endif
      </a>

      <!-- 🔐 Log In / Sign Up (Mobile) -->
      
        <a href="{{ route('login') }}" class="block text-red-600 font-semibold">Log In</a>
        <a href="{{ route('register') }}" class="block text-red-600 font-semibold">Sign Up</a>
      
    </div>
  </nav>
</div>
