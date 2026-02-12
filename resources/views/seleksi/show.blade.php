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
                            @if($lamaran->status == 'diterima')
                                <div class="p-4 bg-green-50 border border-green-200 rounded-lg text-center">
                                    <p class="text-green-800 font-bold mb-2">Pelamar ini sudah diterima.</p>
                                    <p class="text-sm text-green-600 mb-4">Silakan hubungi pelamar untuk proses selanjutnya.</p>
                                    
                                    @php
                                        $no_hp = $lamaran->pelamar->no_hp;
                                        // Format nomor HP ke format internasional (62) jika depannya 0
                                        if(substr($no_hp, 0, 1) == '0') {
                                            $no_hp = '62' . substr($no_hp, 1);
                                        }
                                        $pesan = "Halo " . $lamaran->pelamar->nama_lengkap . ", selamat! Lamaran Anda untuk posisi " . $lamaran->lowongan->judul_pekerjaan . " di " . $lamaran->lowongan->profilUmkm->nama_usaha . " telah kami TERIMA. Kapan bisa interview?";
                                        $wa_link = "https://wa.me/" . $no_hp . "?text=" . urlencode($pesan);
                                    @endphp

                                    <a href="{{ $wa_link }}" target="_blank" class="block w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-xl shadow-md transition flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                        Hubungi via WhatsApp
                                    </a>
                                </div>
                            @endif

                            @if($lamaran->status != 'diterima')
                                <form action="{{ route('seleksi.update', $lamaran->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="diterima">
                                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-md transition" onclick="return confirm('Yakin ingin MENERIMA pelamar ini?')">
                                        ✅ Terima Pelamar
                                    </button>
                                </form>
                            @endif

                            @if($lamaran->status == 'menunggu')
                                <form action="{{ route('seleksi.update', $lamaran->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow-md transition" onclick="return confirm('Yakin ingin MENOLAK pelamar ini?')">
                                        ❌ Tolak Lamaran
                                    </button>
                                </form>
                            @endif
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