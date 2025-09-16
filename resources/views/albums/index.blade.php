<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <x-bottom-sidebar-mobile></x-bottom-sidebar-mobile>
                {{ $pageTitle }}
            </h2>
            <a href="{{ route('admin.albums.create') }}" class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-center">
                Buat Album Baru
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
                @foreach($albums as $album)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                        @if($album->cover)
                            <img src="{{ asset('storage/' . $album->cover) }}" alt="{{ $album->judul }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">Tidak ada cover</span>
                            </div>
                        @endif
                        
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-lg font-semibold text-gray-900">
                                <a href="{{ route('admin.albums.show', $album->id) }}" class="hover:underline">
                                    {{ $album->judul }}
                                </a>
                            </h3>
                            <p class="mt-2 text-sm text-gray-600 flex-grow">
                                {{ $album->photos_count }} foto
                            </p>

                            <div class="mt-4 flex flex-col sm:flex-row sm:justify-between items-start sm:items-center gap-3">
                                <span class="text-xs text-gray-500">
                                    Dibuat {{ $album->created_at->diffForHumans() }}
                                </span>
                                <div class="flex space-x-2 self-end sm:self-auto">
                                    <a href="{{ route('admin.albums.edit', $album->id) }}" class="text-blue-600 hover:text-blue-800" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    </a>
                                    
                                    <form action="{{ route('admin.albums.destroy', $album->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus album ini?')">
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
                {{ $albums->links() }}
            </div>
        </div>
    </div>
</x-app-layout>