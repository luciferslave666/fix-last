<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Kerjaku') }} - Solusi UMKM & Pencari Kerja</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
    </style>
</head>
<body class="bg-stone-50 text-stone-800 antialiased">

    <nav class="max-w-7xl mx-auto px-6 lg:px-8 py-6 flex justify-between items-center sticky top-0 z-50 bg-stone-50/90 backdrop-blur-md">
        <div class="flex items-center gap-2">
            <div class="bg-orange-600 p-2 rounded-xl shadow-lg shadow-orange-200">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" /></svg>
            </div>
            <span class="text-xl font-extrabold tracking-tight text-stone-900">Kerja<span class="text-orange-600">Ku</span></span>
        </div>

        <div class="flex gap-4 items-center">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-stone-600 hover:text-orange-600 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-stone-600 hover:text-orange-600 px-3 py-2 transition">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-stone-900 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-orange-600 transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            Daftar Sekarang
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 lg:px-8 pt-10 pb-24 text-center lg:text-left lg:flex lg:items-center lg:gap-16">
        <div class="lg:w-1/2 relative z-10">
            <div class="inline-flex items-center rounded-full px-4 py-1.5 text-sm font-bold text-orange-700 ring-1 ring-inset ring-orange-600/20 bg-orange-50 mb-8 shadow-sm">
                🚀 #1 Platform Kerja Part-time Indonesia
            </div>
            <h1 class="text-5xl lg:text-6xl font-extrabold tracking-tight text-stone-900 mb-6 leading-tight">
                Cari Cuan Tambahan, <br>
                <span class="text-orange-600 relative">
                    Bantu UMKM Lokal.
                    <svg class="absolute w-full h-3 -bottom-1 left-0 text-orange-200 -z-10" viewBox="0 0 100 10" preserveAspectRatio="none"><path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="8" fill="none" /></svg>
                </span>
            </h1>
            <p class="text-lg text-stone-500 mb-10 leading-relaxed max-w-lg mx-auto lg:mx-0">
                Hubungkan semangat kerjamu dengan ribuan UMKM yang membutuhkan tenaga handal. Simpel, cepat, dan terpercaya.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                <a href="{{ route('register') }}" class="bg-orange-600 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-orange-700 transition shadow-xl shadow-orange-200 hover:shadow-2xl flex items-center justify-center group">
                    Cari Lowongan
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
                <a href="{{ route('login') }}" class="bg-white text-stone-800 border border-stone-200 px-8 py-4 rounded-2xl font-bold text-lg hover:border-orange-500 hover:text-orange-600 transition flex items-center justify-center">
                    Saya Pemilik Usaha
                </a>
            </div>
            
            <div class="mt-12 flex items-center gap-10 justify-center lg:justify-start border-t border-stone-200 pt-8">
                <div class="text-center lg:text-left">
                    <div class="text-3xl font-extrabold text-stone-900">{{ $totalLowongan }}+</div>
                    <div class="text-xs font-bold text-stone-400 uppercase tracking-wider">Lowongan Aktif</div>
                </div>
                <div class="text-center lg:text-left">
                    <div class="text-3xl font-extrabold text-stone-900">{{ $totalMitra }}+</div>
                    <div class="text-xs font-bold text-stone-400 uppercase tracking-wider">Mitra UMKM</div>
                </div>
                <div class="text-center lg:text-left">
                    <div class="text-3xl font-extrabold text-stone-900">{{ $totalTersalurkan }}+</div>
                    <div class="text-xs font-bold text-stone-400 uppercase tracking-wider">Tersalurkan</div>
                </div>
            </div>
        </div>

        <div class="hidden lg:block lg:w-1/2 relative mt-12 lg:mt-0">
            <div class="absolute -top-10 -right-10 w-72 h-72 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-blob"></div>
            <div class="absolute -bottom-10 -left-10 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-blob animation-delay-2000"></div>
            <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white transform rotate-2 hover:rotate-0 transition duration-500 ease-out">
                <img src="https://images.unsplash.com/photo-1603201667141-5a2d4c6733ef?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80" alt="UMKM Team" class="object-cover w-full h-[550px]">
            </div>
        </div>
    </main>

    <div class="py-20 bg-white">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-bold tracking-tight text-stone-900 sm:text-4xl">
                        Lowongan Terbaru Hari Ini
                    </h2>
                    <p class="mt-2 text-stone-600">
                        Yuk, langsung lamar sebelum diambil orang!
                    </p>
                </div>
                <a href="{{ route('login') }}" class="hidden sm:flex text-orange-600 font-bold hover:text-orange-700 items-center bg-orange-50 px-4 py-2 rounded-lg transition-colors border border-orange-100 hover:border-orange-300">
                    Lihat Semua <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @if($lowonganTerbaru->count() > 0)
                    @foreach($lowonganTerbaru as $job)
                        <div class="bg-white rounded-2xl p-6 shadow-sm border border-stone-200 hover:shadow-xl hover:border-orange-200 transition-all group flex flex-col justify-between h-full">
                            <div>
                                <div class="flex justify-between items-start mb-4">
                                    <div class="bg-orange-100 p-2.5 rounded-xl group-hover:bg-orange-500 transition-colors">
                                        <svg class="w-6 h-6 text-orange-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <span class="inline-flex items-center rounded-lg bg-stone-100 px-2.5 py-1 text-xs font-bold text-stone-600 border border-stone-200">
                                        {{ $job->jenis_pekerjaan }}
                                    </span>
                                </div>
                                <h3 class="text-lg font-bold text-stone-900 mb-1 group-hover:text-orange-600 transition-colors line-clamp-1">{{ $job->judul_pekerjaan }}</h3>
                                <p class="text-sm font-medium text-stone-500 mb-4">{{ $job->umkm->nama_usaha ?? 'UMKM Terverifikasi' }}</p>
                                
                                <div class="space-y-2 mb-6 bg-stone-50 p-3 rounded-lg">
                                    <div class="flex items-center text-sm text-stone-600">
                                        <svg class="w-4 h-4 mr-2 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ Str::limit($job->lokasi, 20) }}
                                    </div>
                                    <div class="flex items-center text-sm font-bold text-stone-900">
                                        <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Rp {{ number_format($job->gaji, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('login') }}" class="block w-full text-center rounded-xl bg-stone-900 px-4 py-3 text-sm font-bold text-white shadow hover:bg-orange-600 hover:shadow-lg transition-all">
                                Lamar Sekarang
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-full text-center py-12 bg-stone-50 rounded-2xl border border-dashed border-stone-300">
                        <p class="text-stone-500 font-medium">Belum ada lowongan baru saat ini.</p>
                        <p class="text-sm text-stone-400">Jadilah yang pertama memposting!</p>
                    </div>
                @endif
            </div>

            <div class="mt-8 text-center sm:hidden">
                <a href="{{ route('login') }}" class="text-orange-600 font-bold hover:text-orange-700 inline-flex items-center">
                    Lihat Semua <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </div>
    
    <footer class="bg-stone-900 text-stone-300 py-12 border-t-4 border-orange-600">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-8">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="bg-orange-600 p-1.5 rounded-lg mr-2">
                             <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" /></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">KerjaKu</h3>
                    </div>
                    <p class="text-sm leading-relaxed text-stone-400">
                        Platform gotong royong digital. Membantu mahasiswa cari uang jajan tambahan, dan membantu warung/UMKM dapat tenaga kerja andalan.
                    </p>
                </div>
                <div>
                    <h4 class="font-bold text-white mb-4 uppercase text-sm tracking-wider">Hubungi Kami</h4>
                    <div class="space-y-3 text-sm">
                        <p class="flex items-center"><span class="text-orange-500 mr-2">Email:</span> halo@kerjaku.id</p>
                        <p class="flex items-center"><span class="text-orange-500 mr-2">Lokasi:</span> Bandung, Jawa Barat</p>
                    </div>
                </div>
            </div>
            <div class="border-t border-stone-800 pt-8 text-center text-xs text-stone-500">
                &copy; {{ date('Y') }} KerjaKu. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>