<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-stone-900 leading-tight">
            {{ __('Dashboard Ringkasan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-gradient-to-r from-stone-900 to-stone-800 rounded-2xl p-8 mb-8 text-white shadow-lg relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-16 -mt-16"></div>
                <div class="relative z-10">
                    <h3 class="text-2xl font-bold mb-2">Halo, {{ Auth::user()->role == 'pelamar' ? Auth::user()->profilPelamar->nama_lengkap : Auth::user()->profilUmkm->pemilik }}! 👋</h3>
                    <p class="text-stone-300">
                        {{ Auth::user()->role == 'pelamar' ? 'Siap mencari peluang baru hari ini?' : 'Pantau perkembangan bisnis dan rekrutmen Anda.' }}
                    </p>
                </div>
            </div>

            @if(Auth::user()->role == 'pelamar')
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-4">
                            <div class="bg-blue-50 p-3 rounded-xl text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <span class="text-3xl font-bold text-stone-800">{{ $totalLamaran }}</span>
                        </div>
                        <p class="text-sm font-medium text-stone-500">Total Lamaran</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-4">
                            <div class="bg-orange-50 p-3 rounded-xl text-orange-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-3xl font-bold text-stone-800">{{ $menunggu }}</span>
                        </div>
                        <p class="text-sm font-medium text-stone-500">Menunggu Review</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 hover:shadow-md transition">
                        <div class="flex items-center justify-between mb-4">
                            <div class="bg-green-50 p-3 rounded-xl text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-3xl font-bold text-stone-800">{{ $diterima }}</span>
                        </div>
                        <p class="text-sm font-medium text-stone-500">Diterima Kerja</p>
                    </div>

                    <a href="{{ route('cari.kerja') }}" class="bg-orange-600 p-6 rounded-2xl shadow-md hover:bg-orange-700 transition flex flex-col items-center justify-center text-white group cursor-pointer">
                        <svg class="w-8 h-8 mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <span class="font-bold">Cari Lowongan</span>
                        <span class="text-xs text-orange-200 mt-1">Lamar sekarang</span>
                    </a>
                </div>
            @endif

            @if(Auth::user()->role == 'umkm')
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-stone-100 rounded-xl text-stone-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm text-stone-500 font-medium">Lowongan Aktif</p>
                                <p class="text-2xl font-bold text-stone-900">{{ $lowonganAktif }} <span class="text-xs text-stone-400 font-normal">/ {{ $totalLowongan }} Total</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-orange-100 rounded-xl text-orange-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm text-stone-500 font-medium">Total Pelamar</p>
                                <p class="text-2xl font-bold text-stone-900">{{ $totalPelamar }} <span class="text-xs text-stone-400 font-normal">Kandidat</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-orange-50 p-6 rounded-2xl border border-orange-100 flex items-center justify-between">
                        <div>
                            <p class="font-bold text-orange-900">Butuh Pegawai?</p>
                            <p class="text-sm text-orange-700">Posting lowongan baru sekarang.</p>
                        </div>
                        <a href="{{ route('lowongan.create') }}" class="bg-orange-600 text-white p-3 rounded-xl hover:bg-orange-700 shadow-md transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-stone-100 flex justify-between items-center">
                        <h3 class="font-bold text-stone-800">Pelamar Terbaru Masuk</h3>
                        <a href="{{ route('lowongan.index') }}" class="text-xs font-bold text-orange-600 hover:text-orange-700">Lihat Semua</a>
                    </div>
                    @if($pelamarTerbaru->isEmpty())
                        <div class="p-8 text-center text-stone-500">
                            Belum ada pelamar baru.
                        </div>
                    @else
                        <ul class="divide-y divide-stone-100">
                            @foreach($pelamarTerbaru as $lamaran)
                            <li class="px-6 py-4 hover:bg-stone-50 transition flex justify-between items-center">
                                <div class="flex items-center gap-4">
                                    <div class="h-10 w-10 bg-stone-200 rounded-full flex items-center justify-center font-bold text-stone-500">
                                        {{ substr($lamaran->pelamar->nama_lengkap, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-stone-900 text-sm">{{ $lamaran->pelamar->nama_lengkap }}</p>
                                        <p class="text-xs text-stone-500">Melamar: {{ $lamaran->lowongan->judul_pekerjaan }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('seleksi.show', $lamaran->id) }}" class="px-3 py-1.5 bg-white border border-stone-300 rounded-lg text-xs font-bold text-stone-600 hover:border-orange-500 hover:text-orange-600 transition">
                                    Review
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endif

        </div>
    </div>
</x-app-layout>