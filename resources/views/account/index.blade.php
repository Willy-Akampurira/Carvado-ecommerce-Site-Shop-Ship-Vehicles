@extends('layouts.app')

@section('title', 'My Account')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-10">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Welcome, {{ $user->name }}</h2>

        <div class="space-y-4 text-sm text-gray-700">
            <div class="flex justify-between">
                <span class="font-semibold">Name:</span>
                <span>{{ $user->name }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-semibold">Email:</span>
                <span>{{ $user->email }}</span>
            </div>
            <div class="flex justify-between">
                <span class="font-semibold">Joined:</span>
                <span>{{ $user->created_at->format('F j, Y') }}</span>
            </div>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('account.edit') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded">
                Edit Profile
            </a>
        </div>
    </div>
</div>
@endsection
