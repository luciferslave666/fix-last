<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-stone-800 leading-tight">Biodata Pelamar</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-stone-200 p-8">
                @if ($errors->any())
    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
        <strong class="font-bold">Gagal Menyimpan!</strong>
        <ul class="mt-2 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <form method="post" action="{{ route('biodata.update') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('patch')

                    <div>
                        <x-input-label value="Foto Profil" />
                        @if($profil->foto)
                            <img src="{{ asset('storage/'.$profil->foto) }}" class="w-20 h-20 rounded-full object-cover mb-2 border">
                        @endif
                        <input type="file" name="foto" class="block w-full text-sm border rounded p-2"/>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label value="Nama Lengkap" />
                            <x-text-input name="nama_lengkap" class="w-full mt-1" :value="old('nama_lengkap', $profil->nama_lengkap)" />
                        </div>
                        <div>
                            <x-input-label value="No HP / WA" />
                            <x-text-input name="no_hp" class="w-full mt-1" :value="old('no_hp', $profil->no_hp)" />
                        </div>
                    </div>

                    <div>
                        <x-input-label value="Jenis Kelamin" />
                        <select name="jenis_kelamin" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                            <option value="L" {{ $profil->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $profil->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <x-input-label value="Alamat Domisili" />
                        <textarea name="alamat" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">{{ old('alamat', $profil->alamat) }}</textarea>
                    </div>

                    <div>
                        <x-input-label value="Pendidikan Terakhir" />
                        <x-text-input name="pendidikan_terakhir" class="w-full mt-1" :value="old('pendidikan_terakhir', $profil->pendidikan_terakhir)" />
                    </div>

                    <div>
                        <x-input-label value="Skill / Keahlian" />
                        <x-text-input name="skill" class="w-full mt-1" :value="old('skill', $profil->skill)" />
                    </div>

                    <div>
                        <x-input-label value="Pengalaman Kerja" />
                        <textarea name="pengalaman" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">{{ old('pengalaman', $profil->pengalaman) }}</textarea>
                    </div>

                    <div>
                        <x-input-label value="Upload CV (PDF)" />
                        @if($profil->cv)
                            <p class="text-sm text-green-600 mb-1">CV Terupload. <a href="{{ asset('storage/'.$profil->cv) }}" target="_blank" class="font-bold underline">Lihat</a></p>
                        @endif
                        <input type="file" name="cv" accept=".pdf" class="block w-full text-sm border rounded p-2"/>
                    </div>

                    <x-primary-button>Simpan Biodata Pelamar</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>