<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Welcome Back to Carvado</h2>
        <p class="text-sm text-gray-500 mt-1">Please sign in to manage your vehicles</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-xs font-semibold uppercase tracking-wider text-gray-700" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="email" class="block w-full border-gray-300 text-gray-900 bg-white placeholder-gray-400 focus:border-red-600 focus:ring-2 focus:ring-red-600 rounded-lg shadow-sm transition duration-150 ease-in-out" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="name@example.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-600" />
        </div>

        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Password')" class="text-xs font-semibold uppercase tracking-wider text-gray-700" />
                @if (Route::has('password.request'))
                    <a class="text-xs text-red-600 hover:text-red-800 transition duration-150 ease-in-out font-medium" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="password" class="block w-full border-gray-300 text-gray-900 bg-white placeholder-gray-400 focus:border-red-600 focus:ring-2 focus:ring-red-600 rounded-lg shadow-sm transition duration-150 ease-in-out"
                                type="password"
                                name="password"
                                required autocomplete="current-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-red-600" />
        </div>

        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-600 w-4 h-4 transition duration-150 ease-in-out" name="remember">
                <span class="ms-2 text-sm text-gray-600 selection:bg-transparent">{{ __('Keep me logged in') }}</span>
            </label>
        </div>

        @if (Route::has('register'))
            <div class="text-center text-sm text-gray-600 mt-2">
                {{ __("Don't have an account?") }}
                <a href="{{ route('register') }}" class="font-semibold text-red-600 hover:text-red-800 transition duration-150 ease-in-out underline decoration-2 offset-2">
                    {{ __('Please Signup') }}
                </a>
            </div>
        @endif

        <hr class="border-gray-200 my-2" />

        <div class="mt-4">
            <x-primary-button class="w-full justify-center py-2.5 rounded-lg text-sm font-semibold tracking-wide bg-neutral-900 hover:bg-red-700 active:bg-neutral-950 text-white shadow-md transition duration-150 ease-in-out border border-transparent focus:ring-2 focus:ring-offset-2 focus:ring-red-600">
                {{ __('Login') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>