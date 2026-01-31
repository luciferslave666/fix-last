<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cari Lowongan Kerja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
                <form method="GET" action="{{ route('cari.kerja') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    
                    <div class="md:col-span-2">
                        <x-text-input name="search" class="w-full" placeholder="Cari posisi atau lokasi..." value="{{ request('search') }}" />
                    </div>

                    <div>
                        <select name="tipe" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Semua Tipe</option>
                            <option value="Part-time" {{ request('tipe') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Harian" {{ request('tipe') == 'Harian' ? 'selected' : '' }}>Harian</option>
                            <option value="Full-time" {{ request('tipe') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                        </select>
                    </div>

                    <div>
                        <x-primary-button class="w-full justify-center h-full">
                            {{ __('Cari') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            @if($lowongans->isEmpty())
                <div class="text-center py-10 text-gray-500">
                    <p>Belum ada lowongan yang sesuai dengan pencarian Anda.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($lowongans as $job)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition duration-200 border border-gray-100">
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <span class="inline-block px-2 py-1 text-xs font-semibold text-indigo-700 bg-indigo-100 rounded-full mb-2">
                                            {{ $job->jenis_pekerjaan }}
                                        </span>
                                        <h3 class="text-lg font-bold text-gray-900">{{ $job->judul_pekerjaan }}</h3>
                                        <p class="text-sm text-gray-600">{{ $job->umkm->nama_usaha }}</p>
                                    </div>
                                    @if($job->umkm->logo)
                                        <img src="{{ asset('storage/' . $job->umkm->logo) }}" alt="Logo" class="w-12 h-12 object-contain rounded-full border">
                                    @endif
                                </div>

                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $job->lokasi }}
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $job->jam_kerja }}
                                    </div>
                                    <div class="flex items-center text-sm font-semibold text-green-600">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Rp {{ number_format($job->gaji, 0, ',', '.') }}
                                    </div>
                                </div>

                                <a href="{{ route('lowongan.show', $job->id) }}" class="block w-full text-center bg-gray-900 text-white py-2 rounded-md hover:bg-gray-700 transition">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>