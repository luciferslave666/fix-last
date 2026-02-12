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

                    <div class="flex items-center space-x-6">
                        <div class="shrink-0">
                            <div class="relative group w-24 h-24">
                                @if($profil->foto)
                                    <img id="preview_foto" src="{{ asset('storage/'.$profil->foto) }}" class="w-24 h-24 rounded-full object-cover border-4 border-stone-200 group-hover:border-orange-500 transition-colors shadow-sm">
                                @else
                                    <div id="preview_placeholder" class="w-24 h-24 rounded-full bg-stone-200 border-4 border-stone-100 flex items-center justify-center text-stone-400 group-hover:border-orange-500 transition-colors">
                                        <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    </div>
                                    <img id="preview_foto" class="hidden w-24 h-24 rounded-full object-cover border-4 border-stone-200">
                                @endif
                                
                                <label for="foto_input" class="absolute bottom-0 right-0 bg-white rounded-full p-2 shadow-md border border-stone-200 cursor-pointer hover:bg-orange-50 transition-colors group-hover:scale-110">
                                    <svg class="w-4 h-4 text-stone-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                </label>
                                <input id="foto_input" type="file" name="foto" class="hidden" accept="image/*" onchange="previewImage(this)">
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-stone-800">Foto Profil</h3>
                            <p class="text-sm text-stone-500">Gunakan foto profesional. Format JPG/PNG, maks 5MB.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label value="Nama Lengkap" />
                            <x-text-input name="nama_lengkap" class="w-full mt-1 border-stone-300 focus:border-orange-500 focus:ring-orange-500 rounded-xl" :value="old('nama_lengkap', $profil->nama_lengkap)" />
                        </div>
                        <div>
                            <x-input-label value="No HP / WA" />
                            <x-text-input name="no_hp" class="w-full mt-1 border-stone-300 focus:border-orange-500 focus:ring-orange-500 rounded-xl" :value="old('no_hp', $profil->no_hp)" />
                        </div>
                    </div>

                    <div>
                        <x-input-label value="Jenis Kelamin" />
                        <select name="jenis_kelamin" class="w-full mt-1 border-stone-300 focus:border-orange-500 focus:ring-orange-500 rounded-xl shadow-sm">
                            <option value="L" {{ $profil->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $profil->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <x-input-label value="Alamat Domisili" />
                        <textarea name="alamat" class="w-full mt-1 border-stone-300 focus:border-orange-500 focus:ring-orange-500 rounded-xl shadow-sm" rows="2">{{ old('alamat', $profil->alamat) }}</textarea>
                    </div>

                    <div>
                        <x-input-label value="Pendidikan Terakhir" />
                        <x-text-input name="pendidikan_terakhir" class="w-full mt-1 border-stone-300 focus:border-orange-500 focus:ring-orange-500 rounded-xl" :value="old('pendidikan_terakhir', $profil->pendidikan_terakhir)" />
                    </div>

                    <div>
                        <x-input-label value="Skill / Keahlian" />
                        <x-text-input name="skill" class="w-full mt-1 border-stone-300 focus:border-orange-500 focus:ring-orange-500 rounded-xl" :value="old('skill', $profil->skill)" />
                    </div>

                    <div>
                        <x-input-label value="Pengalaman Kerja" />
                        <textarea name="pengalaman" class="w-full mt-1 border-stone-300 focus:border-orange-500 focus:ring-orange-500 rounded-xl shadow-sm" rows="3">{{ old('pengalaman', $profil->pengalaman) }}</textarea>
                    </div>

                    <div class="bg-stone-50 p-4 rounded-xl border border-stone-200">
                        <x-input-label value="Upload CV (PDF)" class="mb-2"/>
                        <div class="flex items-center space-x-4">
                            <div class="flex-1">
                                <input type="file" name="cv" accept=".pdf" class="block w-full text-sm text-stone-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100"/>
                            </div>
                            @if($profil->cv)
                                <a href="{{ asset('storage/'.$profil->cv) }}" target="_blank" class="flex items-center px-4 py-2 bg-white border border-stone-300 rounded-lg text-sm font-medium text-stone-700 shadow-sm hover:bg-stone-50">
                                    <svg class="w-4 h-4 mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    Lihat CV Saat Ini
                                </a>
                            @endif
                        </div>
                    </div>

                    <script>
                        function previewImage(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    const img = document.getElementById('preview_foto');
                                    const placeholder = document.getElementById('preview_placeholder');
                                    img.src = e.target.result;
                                    img.classList.remove('hidden');
                                    if(placeholder) placeholder.classList.add('hidden');
                                }
                                reader.readAsDataURL(input.files[0]);
                            }
                        }
                    </script>

                    <x-primary-button>Simpan Biodata Pelamar</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>