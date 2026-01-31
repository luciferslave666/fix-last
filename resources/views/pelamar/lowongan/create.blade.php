<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-stone-900 leading-tight">
            {{ __('Buat Lowongan Baru') }}
        </h2>
        <p class="text-stone-500 text-sm mt-1">Isi detail pekerjaan untuk merekrut talenta terbaik.</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-stone-100">
                <div class="p-8">
                    
                    <form method="POST" action="{{ route('lowongan.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div class="col-span-1 md:col-span-2">
                                <x-input-label for="judul_pekerjaan" :value="__('Judul Pekerjaan')" />
                                <x-text-input id="judul_pekerjaan" class="block mt-1 w-full" type="text" name="judul_pekerjaan" :value="old('judul_pekerjaan')" required autofocus placeholder="Contoh: Barista Part Time" />
                                <x-input-error :messages="$errors->get('judul_pekerjaan')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="jenis_pekerjaan" :value="__('Jenis Pekerjaan')" />
                                <select id="jenis_pekerjaan" name="jenis_pekerjaan" class="block mt-1 w-full border-stone-300 focus:border-orange-500 focus:ring-orange-500 rounded-xl shadow-sm transition-colors text-stone-700">
                                    <option value="Part Time" {{ old('jenis_pekerjaan') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                                    <option value="Full Time" {{ old('jenis_pekerjaan') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                                    <option value="Freelance" {{ old('jenis_pekerjaan') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                                    <option value="Magang" {{ old('jenis_pekerjaan') == 'Magang' ? 'selected' : '' }}>Magang</option>
                                </select>
                                <x-input-error :messages="$errors->get('jenis_pekerjaan')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="gaji" :value="__('Gaji / Upah (Rp)')" />
                                <div class="relative mt-1">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-stone-500 font-bold">Rp</span>
                                    </div>
                                    <x-text-input id="gaji" class="block w-full pl-10" type="number" name="gaji" :value="old('gaji')" required placeholder="Contoh: 1500000" />
                                </div>
                                <x-input-error :messages="$errors->get('gaji')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="lokasi" :value="__('Lokasi Penempatan')" />
                                <x-text-input id="lokasi" class="block mt-1 w-full" type="text" name="lokasi" :value="old('lokasi')" required placeholder="Contoh: Dago, Bandung" />
                                <x-input-error :messages="$errors->get('lokasi')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="jam_kerja" :value="__('Jam Kerja')" />
                                <x-text-input id="jam_kerja" class="block mt-1 w-full" type="text" name="jam_kerja" :value="old('jam_kerja')" required placeholder="Contoh: 17.00 - 22.00 WIB" />
                                <x-input-error :messages="$errors->get('jam_kerja')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="jumlah_kebutuhan" :value="__('Jumlah Kebutuhan (Orang)')" />
                                <x-text-input id="jumlah_kebutuhan" class="block mt-1 w-full" type="number" min="1" name="jumlah_kebutuhan" :value="old('jumlah_kebutuhan', 1)" required />
                                <x-input-error :messages="$errors->get('jumlah_kebutuhan')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-6">
                            <x-input-label for="deskripsi" :value="__('Deskripsi Pekerjaan & Syarat')" />
                            <textarea id="deskripsi" name="deskripsi" rows="5" class="block mt-1 w-full border-stone-300 focus:border-orange-500 focus:ring-orange-500 rounded-xl shadow-sm transition-colors text-stone-700" placeholder="Jelaskan tanggung jawab pekerjaan dan kualifikasi yang dibutuhkan..." required>{{ old('deskripsi') }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-stone-100">
                            <a href="{{ route('lowongan.index') }}" class="bg-white py-2.5 px-6 border border-stone-300 rounded-xl shadow-sm text-sm font-bold text-stone-600 hover:bg-stone-50 hover:text-stone-800 transition">
                                Batal
                            </a>
                            
                            <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-orange-600 border border-transparent rounded-xl font-bold text-sm text-white hover:bg-orange-700 focus:bg-orange-700 active:bg-orange-900 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md hover:shadow-lg">
                                Posting Lowongan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>