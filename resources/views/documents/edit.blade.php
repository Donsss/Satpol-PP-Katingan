<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $pageTitle }}
            </h2>
            <a href="{{ route('admin.documents.index') }}" class="w-full sm:w-auto text-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.documents.update', $document) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Judul -->
                            <div class="md:col-span-2">
                                <label for="judul" class="block text-sm font-medium text-gray-700">Judul Dokumen <span class="text-red-500">*</span></label>
                                <input type="text" name="judul" id="judul" required
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                       value="{{ old('judul', $document->judul) }}">
                                @error('judul')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="md:col-span-2">
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="3"
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('deskripsi', $document->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kategori -->
                            <div>
                                <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                                <select name="kategori" id="kategori"
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategories as $kategori)
                                        <option value="{{ $kategori }}" {{ old('kategori', $document->kategori) == $kategori ? 'selected' : '' }}>
                                            {{ $kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="is_public" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="is_public" id="is_public" required
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="1" {{ old('is_public', $document->is_public) == 1 ? 'selected' : '' }}>Public</option>
                                    <option value="0" {{ old('is_public', $document->is_public) == 0 ? 'selected' : '' }}>Private</option>
                                </select>
                                @error('is_public')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- File Info -->
                            <div class="md:col-span-2 p-4 bg-gray-50 rounded-md">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">File Saat Ini</h4>
                                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2">
                                    <div>
                                        <p class="text-sm text-gray-600 break-all">{{ $document->file_name }}</p>
                                        <p class="text-xs text-gray-500">{{ $document->formatted_size }} • {{ strtoupper($document->file_extension) }}</p>
                                    </div>
                                    <a href="{{ route('admin.documents.download', $document) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                                        Download
                                    </a>
                                </div>
                            </div>

                            <div class="md:col-span-2" x-data="{ fileName: '' }">
                                <label class="block text-sm font-medium text-gray-700">Ganti File (Opsional)</label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="document" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                <span>Upload file baru</span>
                                                <input id="document" name="document" type="file" class="sr-only" @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip,.rar">
                                            </label>
                                            <p class="pl-1">atau tarik dan lepas</p>
                                        </div>
                                        <p x-show="fileName" class="text-sm text-gray-900 font-semibold" x-text="fileName"></p>
                                        <p x-show="!fileName" class="text-xs text-gray-500">Kosongkan jika tidak ingin mengganti file</p>
                                    </div>
                                </div>
                                @error('document')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex justify-center sm:justify-end">
                            <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Update Dokumen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>