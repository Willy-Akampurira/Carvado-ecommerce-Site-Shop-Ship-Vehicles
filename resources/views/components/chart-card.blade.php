@props(['title', 'canvasId'])

<div class="bg-white p-4 rounded shadow">
  <h3 class="text-md font-semibold text-gray-600 mb-2">{{ $title }}</h3>
  <canvas id="{{ $canvasId }}" class="w-full h-48"></canvas>
</div>
