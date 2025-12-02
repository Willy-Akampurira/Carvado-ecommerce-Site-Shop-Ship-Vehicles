@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-10">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Edit Your Profile</h2>

        @if(session('success'))
            <div class="mb-4 text-green-600 font-semibold text-sm text-center">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('account.update') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500" required>
                @error('name') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500" required>
                @error('email') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <div class="flex justify-between pt-4">
                <a href="{{ route('account.index') }}"
                   class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded">
                    Cancel
                </a>
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded">
                    Update Profile
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
