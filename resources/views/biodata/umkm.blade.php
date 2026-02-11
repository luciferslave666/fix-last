<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-stone-800 leading-tight">Biodata Usaha (UMKM)</h2>
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
                        <x-input-label value="Logo Usaha" />
                        @if($profil->logo)
                            <img src="{{ asset('storage/'.$profil->logo) }}" class="w-20 h-20 rounded-xl object-cover mb-2 border">
                        @endif
                        <input type="file" name="logo" class="block w-full text-sm border rounded p-2"/>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label value="Nama Usaha" />
                            <x-text-input name="nama_usaha" class="w-full mt-1" :value="old('nama_usaha', $profil->nama_usaha)" />
                        </div>
                        <div>
                            <x-input-label value="Nama Pemilik" />
                            <x-text-input name="pemilik" class="w-full mt-1" :value="old('pemilik', $profil->pemilik)" />
                        </div>
                    </div>

                    <div>
                        <x-input-label value="Bidang Usaha (Cth: Kuliner)" />
                        <x-text-input name="bidang_usaha" class="w-full mt-1" :value="old('bidang_usaha', $profil->bidang_usaha)" />
                    </div>

                    <div>
                        <x-input-label value="No Kontak HP" />
                        <x-text-input name="no_hp" class="w-full mt-1" :value="old('no_hp', $profil->no_hp)" />
                    </div>

                    <div>
                        <x-input-label value="Alamat Lengkap" />
                        <textarea name="alamat" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">{{ old('alamat', $profil->alamat) }}</textarea>
                    </div>

                    <div>
                        <x-input-label value="Deskripsi Singkat" />
                        <textarea name="deskripsi" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">{{ old('deskripsi', $profil->deskripsi) }}</textarea>
                    </div>

                    <x-primary-button>Simpan Biodata UMKM</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>