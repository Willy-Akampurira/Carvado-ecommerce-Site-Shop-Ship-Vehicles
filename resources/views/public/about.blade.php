{{-- resources/views/public/about.blade.php --}}
@extends('layouts.app')

@section('title', 'About Us - Carvado')

@section('content')
{{-- Hero Banner --}}
<section class="relative overflow-hidden h-[250px]">
    <div class="absolute inset-0 z-0 bg-cover bg-center opacity-30"
         style="background-image: url('{{ asset('images/showroom-banner.png') }}');"></div>

    <div class="absolute inset-0 z-10 bg-gradient-to-r from-red-800 to-gray-600 mix-blend-multiply"></div>

    <div class="relative z-20 max-w-7xl mx-auto h-full flex flex-col justify-center items-center px-4 sm:px-6 lg:px-8 text-white text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">Welcome to Carvado</h1>
        <p class="mt-4 text-lg md:text-xl">Driven by passion. Defined by quality.</p>
    </div>
</section>

{{-- Main Content --}}
<section class="bg-gray-50 py-12 px-4 sm:px-6 lg:px-8" x-data="{ show: false }" x-init="setTimeout(() => show = true, 500)">
    <div class="max-w-4xl mx-auto" x-show="show"
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 translate-y-6"
         x-transition:enter-end="opacity-100 translate-y-0">

        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">About Carvado</h2>
            <p class="mt-2 text-gray-600 text-lg">Bringing quality vehicles closer to East Africa’s dreamers and doers.</p>
        </div>

        <div class="grid gap-12 md:grid-cols-2 text-gray-700">
            @foreach([
                ['icon' => 'car', 'title' => 'Who We Are', 'content' => 'Carvado is East Africa’s trusted online vehicle marketplace — connecting you with premium cars, transparent pricing, and exceptional service under one roof.

'],
                ['icon' => 'gear', 'title' => 'What Sets Us Apart', 'list' => [
                    'Curated Selection: Every car is handpicked for quality, performance, and style.',
                    'Smooth Buying Experience: Easy online shopping with secure checkout and flexible options.',
                    'Customer-First Approach: We go beyond selling — we guide, support, and serve at every step.'
                ]],
                ['icon' => 'team', 'title' => 'Our Journey', 'content' => 'Carvado started with one mission: to simplify car buying for everyday people and businesses. From humble beginnings, we’ve become a leading name in digital car commerce — trusted by hundreds across the region.
'],
                ['icon' => 'map', 'title' => 'Where We Work', 'content' => 'Our main office and showroom are located at Easy View Complex, Mbaguta Street, Mbarara.  
We serve all of Uganda and deliver across East Africa — fast, safe, and trackable.', 'map' => true],
                ['icon' => 'handshake', 'title' => 'Our Promise', 'content' => 'At Carvado, we promise more than just cars. We promise transparency, trust, and a seamless shopping journey. Every vehicle we list has been vetted for quality, and every customer gets our full attention.
'],
                ['icon' => 'shield', 'title' => 'Why Choose Us', 'list' => [
                    'Secure Transactions – Your payments and data are protected end-to-end.',
                    'Mobile-Friendly Experience – Shop anytime, anywhere with ease.',
                    'Customer-Centered Support – Quick help, honest advice, and clear communication.',
                    'Expertly Curated Inventory – Every car is carefully selected for value, reliability, and style.'
                ]],
            ] as $section)
                <div class="flex flex-col">
                    <div class="flex items-center gap-2 mb-2">
                        <img src="{{ asset('icons/' . $section['icon'] . '.png') }}"
                             alt="{{ $section['title'] }} icon"
                             class="h-8 w-8 sm:h-9 sm:w-8 object-contain opacity-80 transition duration-300 hover:scale-105">
                        <h3 class="text-xl font-semibold leading-tight">{{ $section['title'] }}</h3>
                    </div>
                    @isset($section['content'])
                        <p class="text-gray-700 mb-4">{{ $section['content'] }}</p>
                    @endisset
                    @isset($section['list'])
                        <ul class="list-disc pl-6 space-y-1 text-gray-700">
                            @foreach($section['list'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    @endisset
                    @if(!empty($section['map']))
                        <div class="mt-4 rounded-lg overflow-hidden shadow-md border">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3977.2108474990264!2d30.65864297571838!3d-0.6070659343116438!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19d91a4f39fa76a7%3A0x64bb7640ec7de90!2sEasy%20View%20Complex%2C%20Mbaguta%20Street%2C%20Mbarara!5e0!3m2!1sen!2sus!4v1690450012345"
                                width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>

                            <div class="mt-2 text-center">
                                <a href="https://www.google.com/maps/dir/?api=1&destination=Easy+View+Complex,+Mbarara"
                                target="_blank"
                                class="inline-block bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition text-sm font-medium">
                                    Get Directions
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="mt-16 text-center">
            <a href="{{ route('shop.index') }}"
               class="inline-block bg-red-600 text-white px-6 py-3 rounded-full text-lg shadow-md hover:bg-red-700 transition">
                Find Your Next Ride
            </a>
        </div>
    </div>
</section>
@endsection
