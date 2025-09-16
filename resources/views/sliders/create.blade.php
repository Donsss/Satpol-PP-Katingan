<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Slider Baru') }}
            </h2>
            <a href="{{ route('admin.sliders.index') }}" class="w-full sm:w-auto text-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label for="title" class="block font-medium text-sm text-gray-700">Judul</label>
                            <input id="title" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="title" value="{{ old('title') }}" autofocus />
                            <small class="text-gray-500 mt-1">Kosongkan jika tidak ingin menggunakan judul</small>
                        </div>

                        <div x-data="{ fileName: '' }">
                            <label class="block text-sm font-medium text-gray-700">Gambar Slider <span class="text-red-500">*</span></label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Upload sebuah file</span>
                                            <input id="image" name="image" type="file" class="sr-only" required @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
                                        </label>
                                        <p class="pl-1">atau tarik dan lepas</p>
                                    </div>
                                    <p class="text-xs text-gray-500">JPG, PNG, GIF, WEBP (Maks: 2MB)</p>
                                    <p x-show="fileName" class="text-sm text-gray-900 font-semibold" x-text="fileName"></p>
                                </div>
                            </div>
                            <small class="text-gray-500 mt-1">Rekomendasi ukuran: 1200x500 pixel.</small>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="order" class="block font-medium text-sm text-gray-700">Nomor Urut</label>
                            <input id="order" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="number" name="order" value="{{ old('order', 0) }}" required />
                            <small class="text-gray-500 mt-1">Angka lebih kecil akan tampil lebih dulu.</small>
                        </div>
                        
                        <div>
                            <label for="is_active" class="inline-flex items-center">
                                <input id="is_active" type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" checked>
                                <span class="ms-2 text-sm text-gray-600">Aktifkan slider ini</span>
                            </label>
                        </div>

                        <div class="flex justify-center sm:justify-end pt-6 border-t">
                            <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Simpan Slider
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>