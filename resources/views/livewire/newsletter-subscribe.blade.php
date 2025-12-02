<div class="mt-4">
    @if (session()->has('success'))
        <div class="text-green-600">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="subscribe" class="flex flex-col sm:flex-row gap-2">
        <input type="email" wire:model.defer="email" placeholder="Enter your email"
               class="px-4 py-2 border rounded w-full sm:w-auto" required>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Subscribe
        </button>
    </form>

    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>
