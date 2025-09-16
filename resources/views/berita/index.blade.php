<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <x-bottom-sidebar-mobile></x-bottom-sidebar-mobile>
                {{ $pageTitle ?? __('Manajemen Berita') }}
            </h2>
            <a href="{{ route('admin.berita.create') }}" class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-center">
                <span class="hidden sm:inline">Tambah Berita</span>
                <span class="sm:hidden">+ Berita Baru</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($berita as $item)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg relative flex flex-col">
                        <div>
                            <div class="absolute top-2 right-2 z-10">
                                @php
                                    $statusColors = [
                                        'draft' => 'bg-gray-500',
                                        'publish' => 'bg-green-500',
                                        'archive' => 'bg-blue-500'
                                    ];
                                    $color = $statusColors[$item->status] ?? 'bg-gray-500';
                                @endphp
                                <span class="{{ $color }} text-white text-xs font-semibold px-2 py-1 rounded-full">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>
                            
                            @if($item->thumbnail)
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->judul }}" class="w-full h-48 object-cover">
                            @endif
                        </div>

                        <div class="p-6 flex-grow flex flex-col">
                            <h3 class="text-lg font-semibold text-gray-900">
                                <a href="{{ route('admin.berita.show', $item->id) }}" class="hover:underline">
                                    {{ Str::limit($item->judul, 28) }}
                                </a>
                            </h3>
                            <p class="mt-2 text-gray-600 flex-grow">
                                {{ Str::limit(strip_tags($item->berita), 120) }}
                            </p>

                            <div class="mt-4 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                                <span class="text-sm text-gray-500 text-left">
                                    {{ $item->created_at->diffForHumans() }} oleh {{ $item->user->name }}
                                </span>
                                <div class="flex space-x-2 self-end sm:self-auto">
                                    <a href="{{ route('admin.berita.show', $item->id) }}" class="text-green-600 hover:text-green-800" title="Lihat Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </a>
                                    <a href="{{ route('admin.berita.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    </a>
                                    <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $berita->links() }}
            </div>
        </div>
    </div>
</x-app-layout>