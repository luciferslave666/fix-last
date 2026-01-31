@php
    /** @var \App\Models\User $user */
@endphp

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi Profil') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Perbarui informasi profil, alamat, dan data pekerjaan Anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nama Akun')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        @if($user->role === 'pelamar')
            <div class="p-4 bg-blue-50 rounded-lg border border-blue-100 space-y-4">
                <h3 class="font-bold text-blue-800">Data Pelamar</h3>
                
                <div>
                    <x-input-label for="no_hp" :value="__('No WhatsApp / HP')" />
                    <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full" :value="old('no_hp', $user->profilPelamar->no_hp ?? '')" placeholder="Contoh: 08123456789" />
                </div>

                <div>
                    <x-input-label for="pendidikan_terakhir" :value="__('Pendidikan Terakhir')" />
                    <select name="pendidikan_terakhir" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @php $pend = $user->profilPelamar->pendidikan_terakhir ?? ''; @endphp
                        <option value="SMA/SMK" {{ $pend == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                        <option value="D3" {{ $pend == 'D3' ? 'selected' : '' }}>D3</option>
                        <option value="S1" {{ $pend == 'S1' ? 'selected' : '' }}>S1</option>
                    </select>
                </div>

                <div>
                    <x-input-label for="alamat" :value="__('Alamat Domisili')" />
                    <textarea name="alamat" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="2">{{ old('alamat', $user->profilPelamar->alamat ?? '') }}</textarea>
                </div>

                <div>
                    <x-input-label for="cv" :value="__('Update CV (PDF)')" />
                    
                    @if($user->profilPelamar->cv)
                        <div class="text-sm text-green-600 mb-2">
                            ✓ CV saat ini: <a href="{{ asset('storage/'.$user->profilPelamar->cv) }}" target="_blank" class="underline font-bold">Lihat File</a>
                        </div>
                    @else
                         <div class="text-sm text-red-600 mb-2">⚠ Belum ada CV diupload</div>
                    @endif

                    <input type="file" name="cv" accept=".pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                    <p class="text-xs text-gray-500 mt-1">Upload file baru untuk mengganti yang lama.</p>
                </div>
            </div>
        @endif

        @if($user->role === 'umkm')
            <div class="p-4 bg-orange-50 rounded-lg border border-orange-100 space-y-4">
                <h3 class="font-bold text-orange-800">Data Usaha (UMKM)</h3>

                <div>
                    <x-input-label for="nama_usaha" :value="__('Nama Usaha')" />
                    <x-text-input id="nama_usaha" name="nama_usaha" type="text" class="mt-1 block w-full" :value="old('nama_usaha', $user->profilUmkm->nama_usaha ?? '')" />
                </div>

                <div>
                    <x-input-label for="no_hp" :value="__('Kontak HP')" />
                    <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full" :value="old('no_hp', $user->profilUmkm->no_hp ?? '')" />
                </div>

                <div>
                    <x-input-label for="alamat" :value="__('Alamat Usaha')" />
                    <textarea name="alamat" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="2">{{ old('alamat', $user->profilUmkm->alamat ?? '') }}</textarea>
                </div>
            </div>
        @endif

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-gray-600">{{ __('Data berhasil disimpan.') }}</p>
            @endif
        </div>
    </form>
</section>