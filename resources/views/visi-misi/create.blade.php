<x-app-layout>
    @include('components.text-editor') 

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $pageTitle ?? __('Tambah Visi & Misi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.visi-misi.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-6">
                            <label for="visi" class="block mb-2 text-sm font-medium text-gray-900">Visi</label>
                            <textarea id="myeditorinstance" name="visi" rows="8" class="text-editor block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Tuliskan visi di sini...">{{ old('visi') }}</textarea>
                            @error('visi')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="misi" class="block mb-2 text-sm font-medium text-gray-900">Misi</label>
                            <textarea id="myeditorinstance"  name="misi" rows="8" class="text-editor block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Tuliskan misi di sini...">{{ old('misi') }}</textarea>
                            @error('misi')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-6 pt-6 border-t">
                            <a href="{{ route('admin.visi-misi.index') }}" class="w-full sm:w-auto text-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                                Batal
                            </a>
                            <button type="submit" class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>