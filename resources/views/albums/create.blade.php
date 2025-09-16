<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $pageTitle }}
            </h2>
            <a href="{{ route('admin.albums.index') }}" class="w-full sm:w-auto text-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.albums.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700">Judul Album <span class="text-red-500">*</span></label>
                            <input type="text" name="judul" id="judul" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('judul') }}" required>
                             @error('judul')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <div x-data="{ fileName: '' }">
                            <label class="block text-sm font-medium text-gray-700">Cover Album (Opsional)</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="cover" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Upload sebuah file</span>
                                            <input id="cover" name="cover" type="file" class="sr-only" @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''" accept="image/*">
                                        </label>
                                        <p class="pl-1">atau tarik dan lepas</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF, WEBP (Maks. 2MB)</p>
                                    <p x-show="fileName" class="text-sm text-gray-900 font-semibold" x-text="fileName"></p>
                                </div>
                            </div>
                            @error('cover')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-6 border-t">
                            <a href="{{ route('admin.albums.index') }}" class="w-full sm:w-auto text-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                                Batal
                            </a>
                            <button type="submit" class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Buat Album
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>