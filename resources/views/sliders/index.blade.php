<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <x-bottom-sidebar-mobile></x-bottom-sidebar-mobile>
                {{ __('Manajemen Slider') }}
            </h2>
            <a href="{{ route('admin.sliders.create') }}" class="w-full sm:w-auto text-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Tambah Slider
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($sliders as $slider)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg relative flex flex-col">
                        <div class="absolute top-2 right-2 z-10">
                            @if($slider->is_active)
                                <span class="bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded-full">Aktif</span>
                            @else
                                <span class="bg-gray-500 text-white text-xs font-semibold px-2 py-1 rounded-full">Tidak Aktif</span>
                            @endif
                        </div>

                        <img src="{{ asset('storage/' . $slider->image_path) }}" alt="{{ $slider->title }}" class="w-full aspect-video object-cover">
                        
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-lg font-semibold text-gray-900 flex-grow">
                                {{ Str::limit($slider->title, 35) }}
                            </h3>

                            <div class="mt-4 pt-4 border-t flex flex-col sm:flex-row sm:justify-between items-start sm:items-center gap-3">
                                <span class="text-sm text-gray-500">
                                    Urutan: <span class="font-bold">{{ $slider->order }}</span>
                                </span>
                                
                                <div class="flex space-x-2 self-end sm:self-auto">
                                    <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="text-blue-600 hover:text-blue-800" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    </a>
                                    <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus slider ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12">
                        <p class="text-gray-500">Belum ada slider yang ditambahkan.</p>
                        <a href="{{ route('admin.sliders.create') }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Tambah Slider Pertama
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>