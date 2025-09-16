<x-app-layout>
    @include('components.text-editor')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <x-bottom-sidebar-mobile></x-bottom-sidebar-mobile>
            {{ $pageTitle ?? __('Edit Tugas & Fungsi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.tugas.update', $tugas->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-6">
                            <label for="konten" class="block mb-2 text-sm font-medium text-gray-900">Konten Tugas & Fungsi</label>
                            <textarea id="myeditorinstance" name="konten" rows="15" class="text-editor block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Tuliskan tugas dan fungsi instansi di sini...">{{ old('konten', $tugas->konten) }}</textarea>
                            
                            @error('konten')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-6 pt-6 border-t">
                             <a href="{{ route('admin.tugas.index') }}" class="w-full sm:w-auto text-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                                Batal
                            </a>
                            <button type="submit" class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
