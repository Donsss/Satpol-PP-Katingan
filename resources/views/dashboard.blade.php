<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <x-bottom-sidebar-mobile></x-bottom-sidebar-mobile>
            
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>

            <div class="relative">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                
                <!-- Card 1: Total Berita -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Total Berita
                        </h3>
                        <p class="mt-2 text-3xl font-bold text-gray-800 dark:text-gray-200">
                            {{ $jumlahBerita }}
                        </p>
                        <a href="{{ route('admin.berita.index') }}" class="mt-4 inline-block text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                            Lihat Detail &rarr;
                        </a>
                    </div>
                </div>

                <!-- Card 2: Total Album -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Total Album
                        </h3>
                        <p class="mt-2 text-3xl font-bold text-gray-800 dark:text-gray-200">
                            {{ $jumlahAlbum }}
                        </p>
                        <a href="{{ route('admin.albums.index') }}" class="mt-4 inline-block text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                            Lihat Detail &rarr;
                        </a>
                    </div>
                </div>

                <!-- Card 3: Total Dokumen -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Total Dokumen
                        </h3>
                        <p class="mt-2 text-3xl font-bold text-gray-800 dark:text-gray-200">
                            {{ $jumlahDokumen }}
                        </p>
                        <a href="{{ route('admin.documents.index') }}" class="mt-4 inline-block text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                            Lihat Detail &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bagian Log Aktivitas -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        Aktivitas Terbaru
                    </h3>
                    <div class="space-y-4">
                        @forelse ($activityLogs as $log)
                            <div class="flex items-start text-sm">
                                <div class="flex-shrink-0 mr-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-gray-800 dark:text-gray-200">{{ $log->description }}</p>
                                    <p class="text-gray-500 dark:text-gray-400 text-xs mt-1">
                                        {{ $log->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400">Belum ada aktivitas.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>