<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Profil Pelamar') }}
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
                                <x-input-label for="nama_lengkap" :value="__('Nama Lengkap')" />
                                <x-text-input id="nama_lengkap" name="nama_lengkap" type="text" class="mt-1 block w-full" :value="old('nama_lengkap', $profil->nama_lengkap)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('nama_lengkap')" />
                            </div>

                            <div>
                                <x-input-label for="nik" :value="__('NIK (Nomor Induk Kependudukan)')" />
                                <x-text-input id="nik" name="nik" type="text" class="mt-1 block w-full" :value="old('nik', $profil->nik)" />
                            </div>

                            <div>
                                <x-input-label for="tempat_lahir" :value="__('Tempat Lahir')" />
                                <x-text-input id="tempat_lahir" name="tempat_lahir" type="text" class="mt-1 block w-full" :value="old('tempat_lahir', $profil->tempat_lahir)" />
                            </div>

                            <div>
                                <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
                                <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date" class="mt-1 block w-full" :value="old('tanggal_lahir', $profil->tanggal_lahir)" />
                            </div>

                            <div>
                                <x-input-label for="no_hp" :value="__('Nomor HP / WhatsApp')" />
                                <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full" :value="old('no_hp', $profil->no_hp)" required />
                            </div>

                            <div>
                                <x-input-label for="pendidikan_terakhir" :value="__('Pendidikan Terakhir')" />
                                <select id="pendidikan_terakhir" name="pendidikan_terakhir" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="SMA/SMK" {{ $profil->pendidikan_terakhir == 'SMA/SMK' ? 'selected' : '' }}>SMA / SMK</option>
                                    <option value="D3" {{ $profil->pendidikan_terakhir == 'D3' ? 'selected' : '' }}>D3</option>
                                    <option value="S1" {{ $profil->pendidikan_terakhir == 'S1' ? 'selected' : '' }}>S1</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <x-input-label for="alamat" :value="__('Alamat Domisili')" />
                            <textarea id="alamat" name="alamat" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" required>{{ old('alamat', $profil->alamat) }}</textarea>
                        </div>

                        <div>
                            <x-input-label for="pengalaman_kerja" :value="__('Pengalaman Kerja (Singkat)')" />
                            <textarea id="pengalaman_kerja" name="pengalaman_kerja" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4">{{ old('pengalaman_kerja', $profil->pengalaman_kerja) }}</textarea>
                        </div>

                        <div>
                            <x-input-label for="foto" :value="__('Foto Profil (JPG/PNG, Max 2MB)')" />
                            @if($profil->foto)
                                <img src="{{ asset('storage/' . $profil->foto) }}" alt="Foto Profil" class="w-20 h-20 object-cover rounded-full mb-2 border">
                            @endif
                            <input id="foto" name="foto" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            <x-input-error class="mt-2" :messages="$errors->get('foto')" />
                        </div>

                        <div class="p-4 border border-dashed border-gray-300 rounded-lg bg-gray-50">
                            <x-input-label for="cv" :value="__('Upload CV (PDF, Max 2MB)')" />
                            @if($profil->cv)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $profil->cv) }}" target="_blank" class="text-indigo-600 hover:underline text-sm font-bold">
                                        📄 Lihat CV Anda Saat Ini
                                    </a>
                                </div>
                            @endif
                            <input id="cv" name="cv" type="file" accept=".pdf" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                            <x-input-error class="mt-2" :messages="$errors->get('cv')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>