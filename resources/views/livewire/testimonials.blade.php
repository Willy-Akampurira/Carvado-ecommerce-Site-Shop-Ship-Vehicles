<section class="bg-gray-50 py-16">
  <div class="container mx-auto px-4 max-w-4xl">

    {{-- Section Title --}}
    <h2 class="text-3xl font-bold text-center mb-10">What Our Customers Say</h2>

    {{-- Success Message --}}
    @if (session()->has('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-6 text-center">
        {{ session('success') }}
      </div>
    @endif

    {{-- Testimonial Form --}}
    <form wire:submit.prevent="submit" class="space-y-4 bg-white shadow p-6 rounded mb-10" enctype="multipart/form-data">
      <div>
        <input
          type="text"
          wire:model.lazy="name"
          placeholder="Your name"
          class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
        >
        @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
      </div>

      <div>
        <textarea
          wire:model.lazy="text"
          placeholder="Your testimonial"
          class="w-full border rounded px-3 py-2 h-24 resize-none focus:outline-none focus:ring focus:border-blue-300"
        ></textarea>
        @error('text') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
      </div>

      <div>
        <input
          type="number"
          wire:model="rating"  {{-- ← remove .lazy --}}
          min="1" max="5"
          placeholder="Rating (1–5)"
          class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300"
        />
        @error('rating') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
      </div>

      <div>
        <input
          type="file"
          wire:model="photo"
          class="w-full border rounded px-3 py-2"
        >
        @error('photo') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
      </div>

      {{-- Preview Before Submit --}}
      @if ($photo)
        <img src="{{ $photo->temporaryUrl() }}" class="w-20 h-20 rounded-full object-cover mt-4 mx-auto" />
      @endif

      <button
        type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
      >
        Send
      </button>
    </form>

    {{-- Testimonials List --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach ($testimonials as $index => $t)
        @php
          $photoPath = $t->photo && Str::startsWith($t->photo, 'photos/')
            ? asset('storage/' . $t->photo)
            : asset('storage/default-avatar.png');
        @endphp

        <div
          class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition duration-300 transform hover:-translate-y-1 text-center"
          data-aos="fade-up"
          data-aos-delay="{{ $index * 150 }}"
          data-aos-duration="700"
        >
          {{-- Photo --}}
          <img 
            src="{{ $photoPath }}" 
            alt="{{ $t->name }}"
            class="mx-auto rounded-full w-16 h-16 mb-4 object-cover"
          />

          {{-- Name --}}
          <h5 class="text-lg font-semibold">{{ $t->name ?? 'Anonymous User' }}</h5>

          {{-- Star Rating --}}
            <div class="flex justify-center mt-2 mb-4 animate-fade-in">
              @for ($i = 1; $i <= 5; $i++)
                @php
                  $isFilled = $i <= (int) $t->rating;
                  $starClass = $isFilled
                    ? 'text-yellow-500 hover:scale-110 drop-shadow-md'
                    : 'text-gray-300';
                @endphp
                <svg
                  class="w-5 h-5 mx-0.5 transition-transform duration-300 ease-in-out {{ $starClass }}"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path d="M9.049 2.927a1 1 0 011.902 0l1.17 3.6h3.805a1 1 0 
                    01.588 1.81l-3.08 2.236 1.17 3.6a1 1 0 
                    01-1.54 1.21L10 13.347l-3.084 2.236a1 1 0 
                    01-1.54-1.21l1.17-3.6-3.08-2.236a1 1 0 
                    01.588-1.81h3.805l1.17-3.6z"/>
                </svg>
              @endfor
            </div>

          {{-- Comment --}}
          <p class="text-gray-600 italic">
            "{{ $t->text }}"
          </p>
        </div>
      @endforeach
    </div>

  </div>
</section>
