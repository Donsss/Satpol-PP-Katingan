<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $pageTitle }}
            </h2>
             <a href="{{ route('admin.berita.index') }}" class="w-full sm:w-auto text-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.berita.update', $berita->id) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700">Judul Berita</label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul', $berita->judul) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            @error('judul') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        
                        <div>
                            <label for="berita" class="block text-sm font-medium text-gray-700">Isi Berita</label>
                             <textarea name="berita" id="myeditorinstance" class="text-editor">{{ old('berita', $berita->berita) }}</textarea>
                            @error('berita') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div x-data="{ fileName: '' }">
                                <label class="block text-sm font-medium text-gray-700">Thumbnail (Opsional)</label>
                                @if($berita->thumbnail)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="Current thumbnail" class="w-full aspect-video object-cover rounded-md">
                                </div>
                                @endif
                                <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="thumbnail" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                <span>Ganti file</span>
                                                <input id="thumbnail" name="thumbnail" type="file" class="sr-only" @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''" accept="image/jpeg,image/png,image/jpg,image/gif">
                                            </label>
                                            <p class="pl-1">atau tarik dan lepas</p>
                                        </div>
                                        <p x-show="fileName" class="text-sm text-gray-900 font-semibold" x-text="fileName"></p>
                                        <p x-show="!fileName" class="text-xs text-gray-500">Kosongkan jika tidak ingin mengganti</p>
                                    </div>
                                </div>
                                @error('thumbnail') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    @foreach(App\Models\Berita::getStatuses() as $value => $label)
                                        <option value="{{ $value }}" {{ old('status', $berita->status) == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        
                        <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-6 border-t">
                            <button type="button" onclick="confirmCancel()" class="w-full sm:w-auto text-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                                Batal
                            </button>
                            <button type="submit" class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Update Berita
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmCancel() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Perubahan yang belum disimpan akan hilang!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, batalkan!',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('admin.berita.index') }}";
                }
            });
        }
    </script>

    @include('components.text-editor')
</x-app-layout>