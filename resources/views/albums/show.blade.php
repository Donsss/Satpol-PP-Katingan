<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight truncate">
                {{ $album->judul }}
            </h2>
            <div class="flex space-x-2 w-full sm:w-auto">
                <a href="{{ route('photos.create', $album->id) }}" 
                   class="flex-1 sm:flex-none text-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Tambah Foto
                </a>
                <a href="{{ route('admin.albums.index') }}" 
                   class="flex-1 sm:flex-none text-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6 bg-white p-6 rounded-lg shadow-sm">
                @if($album->deskripsi)
                    <p class="text-gray-600">{{ $album->deskripsi }}</p>
                @endif
                <p class="mt-2 text-sm text-gray-500">
                    {{ $album->photos->count() }} foto • Dibuat {{ $album->created_at->diffForHumans() }}
                </p>
            </div>

            @if($photos->isNotEmpty())
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($photos as $photo)
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden flex flex-col">
                            <a href="{{ asset('storage/' . $photo->path) }}" 
                               data-lightbox="album-{{ $album->id }}" 
                               data-title="{{ $photo->judul }}">
                                <img src="{{ asset('storage/' . $photo->path) }}" alt="{{ $photo->judul }}" class="w-full aspect-square object-cover">
                            </a>
                            
                            <div class="p-4 flex flex-col flex-grow">
                                <div class="flex-grow">
                                    @if($photo->deskripsi)
                                        <p class="mt-1 text-sm text-gray-600 truncate">{{ $photo->deskripsi }}</p>
                                    @endif
                                </div>

                                <div class="flex items-center justify-end space-x-3 mt-4 pt-4 border-t">
                                    <a href="{{ route('photos.edit', $photo->id) }}" 
                                       class="text-blue-600 hover:text-blue-800"
                                       title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    </a>
                                    
                                    <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-800"
                                                title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $photos->links() }}
                </div>
            @else
                <div class="bg-white p-8 rounded-lg shadow-sm text-center">
                    <p class="text-gray-500">Belum ada foto di album ini.</p>
                    <a href="{{ route('photos.create', $album->id) }}" 
                       class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Tambah Foto Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>