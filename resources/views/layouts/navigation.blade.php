<script src="https://cdn.tailwindcss.com"></script>

<nav x-data="{ open: false }" class="bg-white border-b border-stone-200 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center group">
                        <div class="bg-orange-500 p-2 rounded-xl mr-2 group-hover:bg-orange-600 transition-colors shadow-sm">
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
                            </svg>
                        </div>
                        <span class="font-bold text-xl text-stone-800 tracking-tight">Kerja<span class="text-orange-600">Ku</span></span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-stone-600 hover:text-orange-600">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if(Auth::user()->role === 'pelamar')
                        <x-nav-link :href="route('cari.kerja')" :active="request()->routeIs('cari.kerja')" class="text-stone-600 hover:text-orange-600">
                            {{ __('Cari Kerja') }}
                        </x-nav-link>
                        <x-nav-link :href="route('lamaran.history')" :active="request()->routeIs('lamaran.history')" class="text-stone-600 hover:text-orange-600">
                            {{ __('Riwayat') }}
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->role === 'umkm')
                        <x-nav-link :href="route('lowongan.index')" :active="request()->routeIs('lowongan.*')" class="text-stone-600 hover:text-orange-600">
                            {{ __('Kelola Lowongan') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <span class="px-3 py-1 rounded-full text-xs font-bold border mr-3 {{ Auth::user()->role === 'umkm' ? 'bg-orange-50 text-orange-700 border-orange-200' : 'bg-blue-50 text-blue-700 border-blue-200' }}">
                    {{ Auth::user()->role === 'umkm' ? 'PEMILIK UMKM' : 'PENCARI KERJA' }}
                </span>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-stone-600 bg-white hover:text-orange-600 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center">
                                <div class="bg-stone-100 p-1.5 rounded-full mr-2">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                </div>
                                {{ Auth::user()->name }}
                            </div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profil Saya') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('biodata.index')" :active="request()->routeIs('biodata.index')" class="text-stone-600 hover:text-orange-600">
                            {{ __('Biodata Saya') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600 hover:bg-red-50">
                                {{ __('Keluar') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-stone-400 hover:text-stone-500 hover:bg-stone-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24"><path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /><path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-stone-50 border-t border-stone-200">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            </div>

        <div class="pt-4 pb-1 border-t border-stone-200">
            <div class="px-4">
                <div class="font-medium text-base text-stone-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-stone-500">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">{{ __('Profil') }}</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600">
                        {{ __('Keluar') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>