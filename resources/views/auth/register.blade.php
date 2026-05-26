<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Create Your Carvado Account</h2>
        <p class="text-sm text-gray-500 mt-1">Register to start managing your vehicle platform</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Full Name')" class="text-xs font-semibold uppercase tracking-wider text-gray-700" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="name" class="block w-full border-gray-300 text-gray-900 bg-white placeholder-gray-400 focus:border-red-600 focus:ring-2 focus:ring-red-600 rounded-lg shadow-sm transition duration-150 ease-in-out" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-1.5 text-xs text-red-600" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-xs font-semibold uppercase tracking-wider text-gray-700" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="email" class="block w-full border-gray-300 text-gray-900 bg-white placeholder-gray-400 focus:border-red-600 focus:ring-2 focus:ring-red-600 rounded-lg shadow-sm transition duration-150 ease-in-out" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="name@example.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-red-600" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" class="text-xs font-semibold uppercase tracking-wider text-gray-700" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="password" class="block w-full border-gray-300 text-gray-900 bg-white placeholder-gray-400 focus:border-red-600 focus:ring-2 focus:ring-red-600 rounded-lg shadow-sm transition duration-150 ease-in-out"
                                type="password"
                                name="password"
                                required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-red-600" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-xs font-semibold uppercase tracking-wider text-gray-700" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="password_confirmation" class="block w-full border-gray-300 text-gray-900 bg-white placeholder-gray-400 focus:border-red-600 focus:ring-2 focus:ring-red-600 rounded-lg shadow-sm transition duration-150 ease-in-out"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5 text-xs text-red-600" />
        </div>

        <div class="text-center text-sm text-gray-600 pt-2">
            {{ __('Already have an account?') }}
            <a href="{{ route('login') }}" class="font-semibold text-red-600 hover:text-red-800 transition duration-150 ease-in-out underline decoration-2 offset-2">
                {{ __('Please Login') }}
            </a>
        </div>

        <hr class="border-gray-200 my-2" />

        <div class="mt-4">
            <x-primary-button class="w-full justify-center py-2.5 rounded-lg text-sm font-semibold tracking-wide bg-neutral-900 hover:bg-red-700 active:bg-neutral-950 text-white shadow-md transition duration-150 ease-in-out border border-transparent focus:ring-2 focus:ring-offset-2 focus:ring-red-600">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>