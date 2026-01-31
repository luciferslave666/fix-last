<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pekerjaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <div class="flex items-center gap-6 mb-8 border-b pb-6">
                        @if($lowongan->umkm->logo)
                            <img src="{{ asset('storage/' . $lowongan->umkm->logo) }}" alt="Logo" class="w-24 h-24 object-contain rounded-lg border">
                        @else
                            <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 font-bold">No Logo</div>
                        @endif
                        
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $lowongan->judul_pekerjaan }}</h1>
                            <p class="text-lg text-indigo-600 font-medium">{{ $lowongan->umkm->nama_usaha }}</p>
                            <div class="flex gap-3 mt-2">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">{{ $lowongan->jenis_pekerjaan }}</span>
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">Rp {{ number_format($lowongan->gaji, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <h4 class="text-sm font-bold text-gray-500 uppercase">Lokasi</h4>
                            <p class="text-gray-900">{{ $lowongan->lokasi }}</p>
                            <p class="text-sm text-gray-600 mt-1">{{ $lowongan->umkm->alamat }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-500 uppercase">Jam Kerja</h4>
                            <p class="text-gray-900">{{ $lowongan->jam_kerja }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-500 uppercase">Kebutuhan</h4>
                            <p class="text-gray-900">{{ $lowongan->jumlah_kebutuhan }} Orang</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-500 uppercase">Kontak UMKM</h4>
                            <p class="text-gray-900">{{ $lowongan->umkm->no_hp }}</p>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Deskripsi & Persyaratan</h3>
                        <div class="prose max-w-none text-gray-700 whitespace-pre-line">
                            {{ $lowongan->deskripsi }}
                        </div>
                    </div>

                    <div class="border-t pt-6 flex justify-end gap-4">
                        <a href="{{ route('cari.kerja') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition">
                            Kembali
                        </a>

                        @if($sudahMelamar)
                            <button disabled class="px-6 py-2 bg-gray-400 text-white rounded-md cursor-not-allowed">
                                ✓ Sudah Dilamar
                            </button>
                        @else
                            <form action="{{ route('lowongan.lamar', $lowongan->id) }}" method="POST" onsubmit="return confirm('Apakah CV Anda sudah update? Klik OK untuk mengirim lamaran.');">
                                @csrf
                                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition font-bold shadow-lg">
                                    Lamar Pekerjaan Ini
                                </button>
                            </form>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>