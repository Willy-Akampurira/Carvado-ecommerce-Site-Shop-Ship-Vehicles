<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Confirm Access</h2>
        <p class="text-sm text-gray-500 mt-2">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Password')" class="text-xs font-semibold uppercase tracking-wider text-gray-700" />
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="password" class="block w-full border-gray-300 text-gray-900 bg-white placeholder-gray-400 focus:border-red-600 focus:ring-2 focus:ring-red-600 rounded-lg shadow-sm transition duration-150 ease-in-out" 
                       type="password" 
                       name="password" 
                       required 
                       autocomplete="current-password" 
                       placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-red-600" />
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-2.5 rounded-lg text-sm font-semibold tracking-wide bg-neutral-900 hover:bg-red-700 active:bg-neutral-950 text-white shadow-md transition duration-150 ease-in-out border border-transparent focus:ring-2 focus:ring-offset-2 focus:ring-red-600">
                {{ __('Confirm Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>