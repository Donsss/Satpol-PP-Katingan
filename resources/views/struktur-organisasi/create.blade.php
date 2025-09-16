<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tambah Anggota Struktur Organisasi
            </h2>
            <a href="{{ route('admin.organisasi.index') }}" class="w-full sm:w-auto text-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.organisasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                                       required placeholder="Masukkan nama lengkap">
                            </div>
                            
                            <div>
                                <label for="position" class="block text-sm font-medium text-gray-700 mb-1">Posisi/Jabatan <span class="text-red-500">*</span></label>
                                <input type="text" name="position" id="position" value="{{ old('position') }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                                       required placeholder="Masukkan jabatan">
                            </div>
                        </div>

                        <div>
                            <label for="nip" class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                            <input type="text" name="nip" id="nip" value="{{ old('nip') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                                   placeholder="Masukkan NIP jika ada">
                        </div>

                        <div x-data="{ fileName: '' }">
                            <label class="block text-sm font-medium text-gray-700">Foto</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="photo" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Upload sebuah file</span>
                                            <input id="photo" name="photo" type="file" class="sr-only" @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''" accept="image/*">
                                        </label>
                                        <p class="pl-1">atau tarik dan lepas</p>
                                    </div>
                                    <p class="text-xs text-gray-500">JPG, PNG, GIF (Maks. 2MB)</p>
                                    <p x-show="fileName" class="text-sm text-gray-900 font-semibold" x-text="fileName"></p>
                                </div>
                            </div>
                            @error('photo')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t">
                            <div>
                                <label for="section" class="block text-sm font-medium text-gray-700 mb-1">Nomor Baris / Level <span class="text-red-500">*</span></label>
                                <input type="number" name="section" id="section" value="{{ old('section') }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                                       required min="1" placeholder="Contoh: 1">
                                <p class="mt-1 text-sm text-gray-500">Baris ke berapa anggota ini ditampilkan.</p>
                            </div>

                            <div>
                                <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Urutan di Dalam Baris <span class="text-red-500">*</span></label>
                                <input type="number" name="order" id="order" value="{{ old('order') }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" 
                                       required min="1" placeholder="Contoh: 1">
                                <p class="mt-1 text-sm text-gray-500">Urutan dari kiri ke kanan.</p>
                            </div>
                        </div>

                        <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-6 border-t">
                            <a href="{{ route('admin.organisasi.index') }}" class="w-full sm:w-auto text-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                                Batal
                            </a>
                            <button type="submit" class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>