<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $pageTitle }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('photos.update', $photo->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            {{-- Menampilkan foto saat ini --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Foto Saat Ini</label>
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $photo->path) }}" 
                                         alt="{{ $photo->judul }}"
                                         class="w-full max-w-lg h-auto object-contain rounded-md border bg-gray-50">
                                </div>
                            </div>

                            {{-- Input untuk Judul (tidak lagi required) --}}
                            <div>
                                <label for="judul" class="block text-sm font-medium text-gray-700">Judul Foto</label>
                                <input type="text" name="judul" id="judul" 
                                       value="{{ old('judul', $photo->judul) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('judul')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Textarea untuk Deskripsi --}}
                            <div>
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                                <textarea name="deskripsi" id="deskripsi" rows="3"
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('deskripsi', $photo->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-6 mt-6 border-t">
                            <a href="{{ route('admin.albums.show', $photo->album_id) }}" 
                               class="w-full sm:w-auto text-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>