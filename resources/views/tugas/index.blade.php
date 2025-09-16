<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <x-bottom-sidebar-mobile></x-bottom-sidebar-mobile>
                {{ $pageTitle ?? __('Tugas & Fungsi') }}
            </h2>

            @if(!$tugas)
                <a href="{{ route('admin.tugas.create') }}" class="w-full sm:w-auto text-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Tambah Tugas & Fungsi
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($tugas)
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold border-b pb-2 mb-4">Tugas & Fungsi</h3>
                            <article class="prose max-w-none">
                                {!! $tugas->konten !!}
                            </article>
                        </div>

                        <div class="mt-8 pt-6 border-t flex flex-col sm:flex-row sm:justify-end gap-3">
                            <a href="{{ route('admin.tugas.edit', $tugas->id) }}" class="w-full sm:w-auto text-center px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                                Edit
                            </a>
                            <form action="{{ route('admin.tugas.destroy', $tugas->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus Tugas & Fungsi ini?')" class="w-full sm:w-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500 text-lg">Tugas & Fungsi belum diatur.</p>
                            <a href="{{ route('admin.tugas.create') }}" class="mt-4 inline-block px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Klik di sini untuk menambahkan
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
