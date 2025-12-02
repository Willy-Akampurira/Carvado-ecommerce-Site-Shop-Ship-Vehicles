@props(['title', 'icon'])

<div class="bg-white p-4 rounded shadow flex items-center space-x-4">
  <i class="fa-solid {{ $icon }} text-gray-400 text-2xl"></i>
  <div>
    <h3 class="text-sm font-semibold text-gray-600">{{ $title }}</h3>
    <p class="text-lg font-bold text-gray-800">--</p> <!-- Replace with dynamic value -->
  </div>
</div>
