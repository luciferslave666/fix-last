<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Review Pelamar: {{ $lamaran->pelamar->nama_lengkap }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 space-y-6">
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="text-lg font-bold mb-4 border-b pb-2">Biodata Pelamar</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Nama Lengkap</p>
                                <p class="font-semibold">{{ $lamaran->pelamar->nama_lengkap }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Pendidikan Terakhir</p>
                                <p class="font-semibold">{{ $lamaran->pelamar->pendidikan_terakhir }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">No HP / WA</p>
                                <p class="font-semibold">{{ $lamaran->pelamar->no_hp }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Domisili</p>
                                <p class="font-semibold">{{ $lamaran->pelamar->alamat }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm text-gray-500">Pengalaman Kerja</p>
                            <p class="whitespace-pre-line">{{ $lamaran->pelamar->pengalaman_kerja ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="text-lg font-bold mb-4 border-b pb-2">Curriculum Vitae (CV)</h3>
                        @if($lamaran->pelamar->cv)
                            <iframe src="{{ asset('storage/' . $lamaran->pelamar->cv) }}" class="w-full h-96 border rounded"></iframe>
                            <div class="mt-2 text-right">
                                <a href="{{ asset('storage/' . $lamaran->pelamar->cv) }}" target="_blank" class="text-indigo-600 hover:underline text-sm">Buka CV di Tab Baru</a>
                            </div>
                        @else
                            <p class="text-red-500">Pelamar ini belum mengunggah file CV.</p>
                        @endif
                    </div>
                </div>

                <div class="md:col-span-1">
                    <div class="bg-white p-6 rounded-lg shadow-sm sticky top-6">
                        <h3 class="text-lg font-bold mb-4">Keputusan Seleksi</h3>
                        
                        <div class="mb-6">
                            <p class="text-sm text-gray-500">Status Saat Ini:</p>
                            @if($lamaran->status == 'menunggu')
                                <span class="text-yellow-600 font-bold text-xl">Menunggu Review</span>
                            @elseif($lamaran->status == 'diterima')
                                <span class="text-green-600 font-bold text-xl">DITERIMA</span>
                            @else
                                <span class="text-red-600 font-bold text-xl">DITOLAK</span>
                            @endif
                        </div>

                        <p class="text-sm text-gray-600 mb-4">
                            Pilih keputusan Anda untuk pelamar ini. Keputusan ini akan langsung muncul di dashboard pelamar.
                        </p>

                        <div class="space-y-3">
                            <form action="{{ route('seleksi.update', $lamaran->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="diterima">
                                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-md transition" onclick="return confirm('Yakin ingin MENERIMA pelamar ini?')">
                                    ✅ Terima Pelamar
                                </button>
                            </form>

                            <form action="{{ route('seleksi.update', $lamaran->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="ditolak">
                                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow-md transition" onclick="return confirm('Yakin ingin MENOLAK pelamar ini?')">
                                    ❌ Tolak Lamaran
                                </button>
                            </form>
                        </div>
                        
                        <div class="mt-6 pt-4 border-t">
                             <a href="{{ route('seleksi.index', $lamaran->lowongan_id) }}" class="text-gray-600 hover:text-gray-900 text-sm">
                                ← Kembali ke daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>