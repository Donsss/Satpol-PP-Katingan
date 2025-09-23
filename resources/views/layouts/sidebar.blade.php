<nav x-data="{ open: false }" 
     x-on:toggle-sidebar.window="open = !open"
     class="fixed left-0 top-0 h-full w-64 bg-white shadow-md z-40 transform transition-transform duration-300 ease-in-out md:translate-x-0"
     :class="open ? 'translate-x-0' : '-translate-x-full'">

    <div class="flex flex-col h-full">
        <div class="flex items-center justify-between h-16 border-b border-gray-200 px-4">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <img src="{{ asset('images/satpol-logo.png') }}" alt="Logo" class="block h-9 w-auto">
                <span class="ml-2 text-xl font-semibold">Satpol PP</span>
            </a>
            <button x-on:click="$dispatch('toggle-sidebar')" class="md:hidden text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto">
            <div class="px-4 py-4 space-y-2">
                <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-sidebar-link>

                <x-sidebar-link :href="route('admin.berita.index')" :active="request()->routeIs('admin.berita.*')">
                    {{ __('Berita') }}
                </x-sidebar-link>

                <x-sidebar-link :href="route('admin.albums.index')" :active="request()->routeIs('admin.albums.*')">
                    {{ __('Album Foto') }}
                </x-sidebar-link>
                
                <x-sidebar-link :href="route('admin.documents.index')" :active="request()->routeIs('admin.documents.*')">
                    {{ __('Dokumen') }}
                </x-sidebar-link>

                <x-sidebar-link :href="route('admin.sliders.index')" :active="request()->routeIs('admin.sliders.*')">
                    {{ __('Sliders') }}
                </x-sidebar-link>

                <x-sidebar-link :href="route('admin.agenda.index')" :active="request()->routeIs('admin.agenda.*')">
                    {{ __('Agenda') }}
                </x-sidebar-link>

                <x-sidebar-link :href="route('admin.kontak.index')" :active="request()->routeIs('admin.kontak.*')">
                    <div class="w-full flex items-center justify-between">
                        <span>{{ __('Pesan Masuk') }}</span>

                        {{-- Badge ini hanya akan muncul jika ada pesan yang belum dibaca --}}
                        @if(isset($unread_messages_count) && $unread_messages_count > 0)
                            <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">
                                {{ $unread_messages_count }}
                            </span>
                        @endif
                    </div>
                </x-sidebar-link>
                
                {{-- Dropdown Profil --}}
                <div x-data="{ open: {{ (request()->routeIs('admin.visi-misi.*') || request()->routeIs('admin.sejarah.*') || request()->routeIs('admin.tugas.*') || request()->routeIs('admin.organisasi.*')) ? 'true' : 'false' }} }" class="space-y-1">
                    
                    {{-- Tombol dropdown trigger yang sudah diperbaiki alignment dan active state-nya --}}
                    <a href="#" @click.prevent="open = !open" 
                       class="w-full flex items-center justify-between text-left px-3 py-2 text-sm font-medium rounded-md
                              {{ (request()->routeIs('admin.visi-misi.*') || request()->routeIs('admin.sejarah.*') || request()->routeIs('admin.tugas.*') || request()->routeIs('admin.organisasi.*')) 
                                  ? 'bg-gray-100 text-gray-900' 
                                  : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        
                        <span>Profil</span>
                        
                        <svg class="h-5 w-5 transform transition-transform duration-200" :class="{'rotate-180': open}" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>

                    {{-- Konten dropdown --}}
                    <div x-show="open" x-transition class="pl-4 space-y-2 pt-1">
                        <x-sidebar-link :href="route('admin.visi-misi.index')" :active="request()->routeIs('admin.visi-misi.*')">
                            {{ __('Visi & Misi') }}
                        </x-sidebar-link>
                        <x-sidebar-link :href="route('admin.sejarah.index')" :active="request()->routeIs('admin.sejarah.*')">
                            {{ __('Sejarah') }}
                        </x-sidebar-link>
                        <x-sidebar-link :href="route('admin.tugas.index')" :active="request()->routeIs('admin.tugas.*')">
                            {{ __('Tugas & Fungsi') }}
                        </x-sidebar-link>
                         <x-sidebar-link :href="route('admin.organisasi.index')" :active="request()->routeIs('admin.organisasi.*')">
                            {{ __('Struktur Organisasi') }}
                        </x-sidebar-link>
                    </div>
                </div>

                @hasrole('super-admin')
                <x-sidebar-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                    {{ __('Manajemen User') }}
                </x-sidebar-link>
                @endhasrole
            </div>
        </div>

        <!-- User Section -->
        <div class="p-4 border-t border-gray-200">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-10 w-10 rounded-full bg-gray-200 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <div class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>
        </div>
    </div>
</nav>

<div x-data="{ sidebarOpen: false }" 
     x-on:toggle-sidebar.window="sidebarOpen = !sidebarOpen"
     x-show="sidebarOpen"
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-30 bg-black bg-opacity-50 md:hidden"
     x-on:click="$dispatch('toggle-sidebar')">
</div>

