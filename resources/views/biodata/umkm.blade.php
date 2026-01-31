<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Profil UMKM') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('biodata.update') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nama_usaha" :value="__('Nama Usaha / Toko')" />
                                <x-text-input id="nama_usaha" name="nama_usaha" type="text" class="mt-1 block w-full" :value="old('nama_usaha', $profil->nama_usaha)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_usaha')" />
                            </div>

                            <div>
                                <x-input-label for="pemilik" :value="__('Nama Pemilik')" />
                                <x-text-input id="pemilik" name="pemilik" type="text" class="mt-1 block w-full" :value="old('pemilik', $profil->pemilik)" required />
                            </div>

                            <div>
                                <x-input-label for="bidang_usaha" :value="__('Bidang Usaha (Contoh: Kuliner, Jasa, Retail)')" />
                                <x-text-input id="bidang_usaha" name="bidang_usaha" type="text" class="mt-1 block w-full" :value="old('bidang_usaha', $profil->bidang_usaha)" required />
                            </div>

                            <div>
                                <x-input-label for="no_hp" :value="__('Nomor Telepon / WhatsApp Usaha')" />
                                <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full" :value="old('no_hp', $profil->no_hp)" required />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="alamat" :value="__('Alamat Lengkap Usaha')" />
                            <textarea id="alamat" name="alamat" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" required>{{ old('alamat', $profil->alamat) }}</textarea>
                        </div>

                        <div>
                            <x-input-label for="deskripsi" :value="__('Deskripsi Singkat Usaha')" />
                            <textarea id="deskripsi" name="deskripsi" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4">{{ old('deskripsi', $profil->deskripsi) }}</textarea>
                            <p class="text-sm text-gray-500 mt-1">Jelaskan apa yang usaha Anda tawarkan agar pelamar tertarik.</p>
                        </div>

                        <div>
                            <x-input-label for="logo" :value="__('Logo Usaha (Opsional)')" />
                            @if($profil->logo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $profil->logo) }}" alt="Logo Usaha" class="w-24 h-24 object-contain border p-1 rounded">
                                </div>
                            @endif
                            <input id="logo" name="logo" type="file" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            <x-input-error class="mt-2" :messages="$errors->get('logo')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan Profil UMKM') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>