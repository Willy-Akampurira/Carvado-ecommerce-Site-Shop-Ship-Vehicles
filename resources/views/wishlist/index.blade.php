@extends('layouts.app')

@section('title', 'My Wishlist')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-10">
    <div class="w-full max-w-3xl bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">My Wishlist</h2>

        @if($wishlist->isEmpty())
            <p class="text-center text-gray-500">Your wishlist is empty.</p>
        @else
            <ul class="divide-y divide-gray-200">
                @foreach($wishlist as $item)
                    <li class="py-4 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">{{ $item->car->name }}</h3>
                            <p class="text-sm text-gray-600">${{ number_format($item->car->price, 2) }}</p>
                        </div>
                        <a href="{{ route('shop.show', $item->car->id) }}" class="text-red-600 hover:underline">View</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
