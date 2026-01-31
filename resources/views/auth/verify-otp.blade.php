<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Terima kasih telah mendaftar! Kode OTP telah dikirim ke email Anda. Masukkan kode 6 digit tersebut di bawah ini.') }}
    </div>

    <form method="POST" action="{{ route('otp.check') }}">
        @csrf

        <div>
            <x-input-label for="otp" :value="__('Kode OTP')" />
            <x-text-input id="otp" class="block mt-1 w-full text-center text-2xl tracking-widest" type="text" name="otp" required autofocus />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Verifikasi Akun') }}
            </x-primary-button>
        </div>
    </form>
    
    <form method="POST" action="{{ route('logout') }}" class="mt-4 text-center">
        @csrf
        <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 underline">
            {{ __('Log Out') }}
        </button>
    </form>
</x-guest-layout>