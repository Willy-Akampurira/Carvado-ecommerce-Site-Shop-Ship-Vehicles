@props(['insights'])

<div class="bg-white p-6 rounded shadow mb-16">
  <h2 class="text-xl font-semibold text-gray-700 mb-4">📊 AI Insights</h2>
  @if(count($insights))
    <ul class="list-disc pl-5 space-y-2 text-gray-600">
      @foreach($insights as $insight)
        <li>{{ $insight }}</li>
      @endforeach
    </ul>
  @else
    <p class="text-gray-500">No insights available at the moment.</p>
  @endif
</div>
