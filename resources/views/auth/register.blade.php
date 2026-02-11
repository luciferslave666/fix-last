<x-guest-layout>
    <div x-data="{ 
        step: 1, 
        role: null,
        isLoading: false,
        emailError: '',

        async nextStep() { 
            // Validasi Step 1
            if(this.step === 1) {
                const name = document.getElementById('name').value;
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                const confirm = document.getElementById('password_confirmation').value;

                // 1. Cek Kosong
                if(!name || !email || !password) {
                    alert('Mohon lengkapi semua data akun.');
                    return;
                }

                // 2. Cek Password Match
                if(password !== confirm) {
                    alert('Konfirmasi password tidak cocok.');
                    return;
                }

                // 3. CEK EMAIL KE SERVER (AJAX)
                this.isLoading = true;
                this.emailError = '';

                try {
                    const response = await fetch('{{ route('check.email') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content')
                        },
                        body: JSON.stringify({ email: email })
                    });
                    
                    const data = await response.json();

                    if (data.exists) {
                        this.emailError = 'Email ini sudah terdaftar. Gunakan email lain atau Login.';
                        this.isLoading = false;
                        return; // Stop, jangan lanjut step
                    }

                } catch (error) {
                    console.error('Error checking email:', error);
                    alert('Terjadi kesalahan koneksi. Silakan coba lagi.');
                    this.isLoading = false;
                    return;
                }

                this.isLoading = false;
            }
            
            // Jika lolos semua, lanjut step
            this.step++; 
        },
        prevStep() { this.step--; },
        setRole(r) { this.role = r; this.step = 3; }
    }">

        <div class="mb-8">
            <div class="flex items-center justify-between text-xs font-bold text-stone-500 mb-2">
                <span :class="step === 1 ? 'text-orange-600' : 'text-green-600'">Akun</span>
                <span :class="step === 2 ? 'text-orange-600' : (step > 2 ? 'text-green-600' : '')">Peran</span>
                <span :class="step === 3 ? 'text-orange-600' : ''">Detail</span>
            </div>
            <div class="w-full bg-stone-200 rounded-full h-2.5">
                <div class="bg-orange-500 h-2.5 rounded-full transition-all duration-500 shadow-sm" 
                     :style="'width: ' + (step === 1 ? '33%' : step === 2 ? '66%' : '100%')"></div>
            </div>
        </div>

        <div class="text-center mb-8">
            <h2 class="text-2xl font-extrabold text-stone-900" x-text="step === 1 ? 'Buat Akun Baru' : (step === 2 ? 'Daftar Sebagai Apa?' : 'Lengkapi Profil')"></h2>
            <p class="mt-2 text-sm text-stone-600" x-text="step === 1 ? 'Mulai perjalanan karir atau bisnis Anda.' : (step === 2 ? 'Pilih peran yang sesuai tujuan Anda.' : 'Data ini akan ditampilkan di profil Anda.')"></p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="role" :value="role">

            <div x-show="step === 1" class="space-y-4" x-transition>
                <div>
                    <x-input-label for="name" :value="__('Nama Lengkap')" />
                    <x-text-input id="name" class="block mt-1 w-full pl-4" type="text" name="name" :value="old('name')" required autofocus />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full pl-4" type="email" name="email" :value="old('email')" required />
                    <p x-show="emailError" x-text="emailError" class="text-sm text-red-600 mt-2 font-bold"></p>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full pl-4" type="password" name="password" required />
                </div>

                <div>
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full pl-4" type="password" name="password_confirmation" required />
                </div>

                <button type="button" @click="nextStep()" :disabled="isLoading" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-orange-600 hover:bg-orange-700 transition-all mt-6 disabled:opacity-50 disabled:cursor-not-allowed">
                    <span x-show="!isLoading">Lanjut Pilih Peran →</span>
                    <span x-show="isLoading">Memeriksa Email...</span>
                </button>
                
                <div class="text-center mt-4">
                    <p class="text-sm text-stone-600">Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-orange-600 hover:underline">Masuk</a></p>
                </div>
            </div>

            <div x-show="step === 2" class="space-y-4" x-transition style="display: none;">
                <div @click="setRole('pelamar')" 
                    class="cursor-pointer group relative rounded-2xl border-2 border-stone-100 bg-stone-50 p-4 hover:border-blue-500 hover:bg-blue-50 transition-all flex items-center shadow-sm">
                    <div class="bg-white p-3 rounded-full mr-4 group-hover:bg-blue-600 group-hover:text-white transition-colors text-blue-600 shadow-sm">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-stone-900 group-hover:text-blue-700">Pencari Kerja</h3>
                        <p class="text-xs text-stone-500">Saya ingin mencari penghasilan tambahan.</p>
                    </div>
                </div>

                <div @click="setRole('umkm')" 
                    class="cursor-pointer group relative rounded-2xl border-2 border-stone-100 bg-stone-50 p-4 hover:border-orange-500 hover:bg-orange-50 transition-all flex items-center shadow-sm">
                    <div class="bg-white p-3 rounded-full mr-4 group-hover:bg-orange-600 group-hover:text-white transition-colors text-orange-600 shadow-sm">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" /></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-stone-900 group-hover:text-orange-700">Pemilik UMKM</h3>
                        <p class="text-xs text-stone-500">Saya ingin merekrut pekerja.</p>
                    </div>
                </div>

                <button type="button" @click="prevStep()" class="w-full text-center text-sm text-stone-500 hover:text-stone-700 mt-4">Kembali</button>
            </div>

            <div x-show="step === 3" class="space-y-4" x-transition style="display: none;">
                
                <div>
                    <x-input-label for="no_hp" :value="__('No WhatsApp / HP')" />
                    <x-text-input id="no_hp" class="block mt-1 w-full pl-4" type="text" name="no_hp" required placeholder="0812..." />
                </div>
                <div>
                    <x-input-label for="alamat" :value="__('Alamat Lengkap')" />
                    <textarea id="alamat" name="alamat" class="block mt-1 w-full border-stone-300 focus:border-orange-500 focus:ring-orange-500 rounded-xl shadow-sm transition-colors text-stone-700 pl-4" rows="2" required placeholder="Jalan..."></textarea>
                </div>

                <template x-if="role === 'pelamar'">
                    <div class="space-y-4">
                        <div>
                            <x-input-label for="pendidikan_terakhir" :value="__('Pendidikan Terakhir')" />
                            <x-text-input id="pendidikan_terakhir" class="block mt-1 w-full pl-4" type="text" name="pendidikan_terakhir" placeholder="Contoh: SMA / S1" />
                        </div>
                        <div>
                            <x-input-label for="skill" :value="__('Keahlian (Skill)')" />
                            <x-text-input id="skill" class="block mt-1 w-full pl-4" type="text" name="skill" placeholder="Contoh: Barista, Stir Mobil" />
                        </div>
                        <div>
                             <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                             <select name="jenis_kelamin" class="block mt-1 w-full border-stone-300 focus:border-orange-500 focus:ring-orange-500 rounded-xl shadow-sm pl-4">
                               <option value="L">Laki-laki</option>
                               <option value="P">Perempuan</option>
                             </select>
                        </div>
                        <div>
                            <x-input-label for="pengalaman" :value="__('Pengalaman (Opsional)')" />
                            <textarea name="pengalaman" class="block mt-1 w-full border-stone-300 focus:border-orange-500 focus:ring-orange-500 rounded-xl shadow-sm pl-4" rows="2"></textarea>
                        </div>
                    </div>
                </template>

                <template x-if="role === 'umkm'">
                    <div class="space-y-4">
                        <div>
                            <x-input-label for="nama_usaha" :value="__('Nama Usaha / Toko')" />
                            <x-text-input id="nama_usaha" class="block mt-1 w-full pl-4" type="text" name="nama_usaha" placeholder="Contoh: Kopi Kenangan" />
                        </div>
                        <div>
                            <x-input-label for="bidang_usaha" :value="__('Bidang Usaha')" />
                            <x-text-input id="bidang_usaha" class="block mt-1 w-full pl-4" type="text" name="bidang_usaha" placeholder="Contoh: Kuliner" />
                        </div>
                        <div>
                            <x-input-label for="deskripsi" :value="__('Deskripsi Singkat (Opsional)')" />
                            <textarea name="deskripsi" class="block mt-1 w-full border-stone-300 focus:border-orange-500 focus:ring-orange-500 rounded-xl shadow-sm pl-4" rows="2"></textarea>
                        </div>
                    </div>
                </template>

                <div class="pt-4 flex gap-3">
                    <button type="button" @click="step = 2" class="flex-1 py-3 border border-stone-300 rounded-xl text-stone-700 font-bold hover:bg-stone-50">
                        Kembali
                    </button>
                    <button type="submit" class="flex-[2] py-3 bg-orange-600 rounded-xl text-white font-bold hover:bg-orange-700 shadow-md">
                        Selesai & Daftar
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>