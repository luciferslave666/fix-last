<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Lowongan Kerja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form method="POST" action="{{ route('lowongan.update', $lowongan->id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="judul_pekerjaan" :value="__('Judul Pekerjaan (Posisi)')" />
                            <x-text-input id="judul_pekerjaan" name="judul_pekerjaan" type="text" class="mt-1 block w-full" :value="old('judul_pekerjaan', $lowongan->judul_pekerjaan)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('judul_pekerjaan')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="jenis_pekerjaan" :value="__('Tipe Pekerjaan')" />
                                <select id="jenis_pekerjaan" name="jenis_pekerjaan" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="Part-time" {{ $lowongan->jenis_pekerjaan == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                                    <option value="Harian" {{ $lowongan->jenis_pekerjaan == 'Harian' ? 'selected' : '' }}>Harian</option>
                                    <option value="Full-time" {{ $lowongan->jenis_pekerjaan == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                                </select>
                            </div>

                            <div>
                                <x-input-label for="gaji" :value="__('Gaji / Upah')" />
                                <x-text-input id="gaji" name="gaji" type="number" class="mt-1 block w-full" :value="old('gaji', $lowongan->gaji)" required />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="lokasi" :value="__('Lokasi Kerja')" />
                                <x-text-input id="lokasi" name="lokasi" type="text" class="mt-1 block w-full" :value="old('lokasi', $lowongan->lokasi)" required />
                            </div>

                            <div>
                                <x-input-label for="jam_kerja" :value="__('Jam Kerja')" />
                                <x-text-input id="jam_kerja" name="jam_kerja" type="text" class="mt-1 block w-full" :value="old('jam_kerja', $lowongan->jam_kerja)" required />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="jumlah_kebutuhan" :value="__('Jumlah Orang Dibutuhkan')" />
                                <x-text-input id="jumlah_kebutuhan" name="jumlah_kebutuhan" type="number" class="mt-1 block w-full" :value="old('jumlah_kebutuhan', $lowongan->jumlah_kebutuhan)" required />
                            </div>

                            <div>
                                <x-input-label for="status" :value="__('Status Lowongan')" />
                                <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="aktif" {{ $lowongan->status == 'aktif' ? 'selected' : '' }}>Aktif (Tampil)</option>
                                    <option value="tutup" {{ $lowongan->status == 'tutup' ? 'selected' : '' }}>Tutup (Sembunyikan)</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <x-input-label for="deskripsi" :value="__('Deskripsi & Persyaratan')" />
                            <textarea id="deskripsi" name="deskripsi" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="5" required>{{ old('deskripsi', $lowongan->deskripsi) }}</textarea>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>
                            <a href="{{ route('lowongan.index') }}" class="text-gray-600 hover:text-gray-900">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>