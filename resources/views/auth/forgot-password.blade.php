<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Forgot Password?</h2>
        <p class="text-sm text-gray-500 mt-2">
            {{ __('No problem. Just let us know your email address and we will email you a password reset link.') }}
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-xs font-semibold uppercase tracking-wider text-gray-700" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="email" class="block w-full border-gray-300 text-gray-900 bg-white placeholder-gray-400 focus:border-red-600 focus:ring-2 focus:ring-red-600 rounded-lg shadow-sm transition duration-150 ease-in-out" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="name@example.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-600" />
        </div>

        <div>
            <x-primary-button class="w-full justify-center py-2.5 rounded-lg text-sm font-semibold tracking-wide bg-neutral-900 hover:bg-red-700 active:bg-neutral-950 text-white shadow-md transition duration-150 ease-in-out border border-transparent focus:ring-2 focus:ring-offset-2 focus:ring-red-600">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>

        <div class="text-center text-sm text-gray-600">
            <a href="{{ route('login') }}" class="font-semibold text-red-600 hover:text-red-800 transition duration-150 ease-in-out underline decoration-2 offset-2">
                {{ __('Back to Login') }}
            </a>
        </div>
    </form>
</x-guest-layout>