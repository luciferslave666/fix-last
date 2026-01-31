<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Lowongan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{ route('lowongan.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="judul_pekerjaan" :value="__('Judul Pekerjaan (Posisi)')" />
                            <x-text-input id="judul_pekerjaan" name="judul_pekerjaan" type="text" class="mt-1 block w-full" :value="old('judul_pekerjaan')" required placeholder="Contoh: Barista, Staff Gudang, Admin Toko" />
                            <x-input-error class="mt-2" :messages="$errors->get('judul_pekerjaan')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="jenis_pekerjaan" :value="__('Tipe Pekerjaan')" />
                                <select id="jenis_pekerjaan" name="jenis_pekerjaan" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="Part-time">Part-time (Paruh Waktu)</option>
                                    <option value="Harian">Pekerja Harian / Lepas</option>
                                    <option value="Full-time">Full-time (Penuh Waktu)</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('jenis_pekerjaan')" />
                            </div>

                            <div>
                                <x-input-label for="gaji" :value="__('Gaji / Upah (Rupiah)')" />
                                <x-text-input id="gaji" name="gaji" type="number" class="mt-1 block w-full" :value="old('gaji')" required placeholder="Contoh: 1500000" />
                                <x-input-error class="mt-2" :messages="$errors->get('gaji')" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="lokasi" :value="__('Lokasi Kerja')" />
                                <x-text-input id="lokasi" name="lokasi" type="text" class="mt-1 block w-full" :value="old('lokasi')" required placeholder="Contoh: Bandung, Jakarta Selatan" />
                                <x-input-error class="mt-2" :messages="$errors->get('lokasi')" />
                            </div>

                            <div>
                                <x-input-label for="jam_kerja" :value="__('Jam Kerja')" />
                                <x-text-input id="jam_kerja" name="jam_kerja" type="text" class="mt-1 block w-full" :value="old('jam_kerja')" required placeholder="Contoh: 08:00 - 16:00 WIB" />
                                <x-input-error class="mt-2" :messages="$errors->get('jam_kerja')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="jumlah_kebutuhan" :value="__('Jumlah Orang Dibutuhkan')" />
                            <x-text-input id="jumlah_kebutuhan" name="jumlah_kebutuhan" type="number" class="mt-1 block w-full" :value="old('jumlah_kebutuhan', 1)" required />
                        </div>

                        <div>
                            <x-input-label for="deskripsi" :value="__('Deskripsi & Persyaratan')" />
                            <textarea id="deskripsi" name="deskripsi" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="5" required placeholder="Jelaskan tanggung jawab dan syarat pelamar...">{{ old('deskripsi') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('deskripsi')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Terbitkan Lowongan') }}</x-primary-button>
                            <a href="{{ route('lowongan.index') }}" class="text-gray-600 hover:text-gray-900">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>