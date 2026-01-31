<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-xl text-stone-900 leading-tight">
                    {{ __('Kelola Lowongan') }}
                </h2>
                <p class="text-stone-500 text-sm mt-1">Atur lowongan pekerjaan dan seleksi pelamar Anda.</p>
            </div>
            <a href="{{ route('lowongan.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 flex items-center shadow-sm transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Buat Lowongan Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-xl flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if($lowongans->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-dashed border-stone-300 p-12 text-center">
                    <div class="mx-auto w-16 h-16 bg-stone-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-medium text-stone-900">Belum ada lowongan aktif</h3>
                    <p class="text-stone-500 mt-1 mb-6">Mulai rekrut talenta terbaik dengan membuat lowongan pertama Anda.</p>
                    <a href="{{ route('lowongan.create') }}" class="inline-flex items-center px-4 py-2 bg-stone-900 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-stone-700">
                        Buat Lowongan Sekarang
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($lowongans as $job)
                        <div class="bg-white p-6 rounded-xl shadow-sm border flex flex-col justify-between hover:shadow-md transition-shadow duration-200 {{ $job->status === 'tutup' ? 'border-red-100 bg-red-50' : 'border-stone-200' }}">
                            <div>
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="font-bold text-lg text-stone-900 leading-snug">{{ $job->judul_pekerjaan }}</h3>
                                    <span class="px-2 py-1 text-xs rounded-full font-bold uppercase {{ $job->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $job->status }}
                                    </span>
                                </div>
                                
                                <p class="text-sm text-stone-500 mb-4 line-clamp-2 min-h-[40px]">{{ $job->deskripsi }}</p>
                                
                                <div class="space-y-2 mb-4 bg-stone-50/50 p-3 rounded-lg border border-stone-100">
                                    <div class="flex items-center text-xs text-stone-500">
                                        <svg class="w-3.5 h-3.5 mr-2 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $job->lokasi }}
                                    </div>
                                    <div class="flex items-center text-xs text-stone-500">
                                        <svg class="w-3.5 h-3.5 mr-2 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $job->jam_kerja }}
                                    </div>
                                    <div class="flex items-center text-xs font-bold text-stone-700">
                                        <svg class="w-3.5 h-3.5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Rp {{ number_format($job->gaji, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-3 pt-4 border-t border-stone-100">
                                <div class="flex justify-between items-center text-xs text-stone-400">
                                    <span>{{ $job->created_at->diffForHumans() }}</span>
                                    <a href="{{ route('seleksi.index', $job->id) }}" class="font-bold text-blue-600 hover:text-blue-800 hover:underline">
                                        {{ $job->lamarans->count() }} Pelamar Masuk
                                    </a>
                                </div>

                                <div class="flex gap-2">
                                    <a href="{{ route('lowongan.edit', $job->id) }}" class="flex-1 text-center bg-stone-100 text-stone-600 text-xs font-bold py-2 rounded-lg hover:bg-stone-200 transition">
                                        Edit
                                    </a>
                                    
                                    <form action="{{ route('lowongan.destroy', $job->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus lowongan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full text-center border border-red-200 text-red-600 text-xs font-bold py-2 rounded-lg hover:bg-red-50 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>