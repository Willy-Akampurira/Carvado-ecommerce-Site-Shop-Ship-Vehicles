<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Verify Your Email</h2>
        <p class="text-sm text-gray-500 mt-2">
            {{ __('Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just emailed to you.') }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-sm text-green-700 font-medium text-center">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="space-y-6">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="w-full justify-center py-2.5 rounded-lg text-sm font-semibold tracking-wide bg-neutral-900 hover:bg-red-700 active:bg-neutral-950 text-white shadow-md transition duration-150 ease-in-out border border-transparent focus:ring-2 focus:ring-offset-2 focus:ring-red-600">
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </form>

        <div class="text-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm font-semibold text-gray-600 hover:text-red-700 transition duration-150 ease-in-out underline underline-offset-4">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>