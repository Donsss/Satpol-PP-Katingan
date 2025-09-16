<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <x-bottom-sidebar-mobile></x-bottom-sidebar-mobile>
                {{ $pageTitle ?? __('Manajemen Dokumen') }}
            </h2>
            <a href="{{ route('admin.documents.create') }}" class="w-full sm:w-auto text-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Tambah Dokumen
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6 bg-white p-4 rounded-lg shadow-sm">
                <h3 class="text-lg font-semibold mb-3">Filter Dokumen</h3>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.documents.index') }}" 
                       class="px-3 py-1 rounded-full text-sm {{ request('kategori') ? 'bg-gray-200 text-gray-700' : 'bg-blue-600 text-white' }}">
                        Semua
                    </a>
                    @foreach($kategories as $kategori)
                        @if($kategori)
                        <a href="{{ route('admin.documents.index', ['kategori' => $kategori]) }}" 
                           class="px-3 py-1 rounded-full text-sm {{ request('kategori') == $kategori ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                            {{ $kategori }}
                        </a>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($documents as $document)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                        <div class="p-6 pb-0">
                             <div class="flex justify-between items-start">
                                <div class="flex-shrink-0">
                                     @php
                                        $fileIcons = [
                                            'pdf' => 'fa-file-pdf text-red-500', 'doc' => 'fa-file-word text-blue-500',
                                            'docx' => 'fa-file-word text-blue-500', 'xls' => 'fa-file-excel text-green-500',
                                            'xlsx' => 'fa-file-excel text-green-500', 'ppt' => 'fa-file-powerpoint text-orange-500',
                                            'pptx' => 'fa-file-powerpoint text-orange-500', 'txt' => 'fa-file-alt text-gray-500',
                                            'zip' => 'fa-file-archive text-yellow-500', 'rar' => 'fa-file-archive text-yellow-500'
                                        ];
                                        $icon = $fileIcons[$document->file_extension] ?? 'fa-file text-gray-400';
                                    @endphp
                                    <i class="fas {{ $icon }} text-4xl"></i>
                                </div>
                                <div class="text-right">
                                    @php
                                        $isPublic = $document->is_public;
                                        $color = $isPublic ? 'bg-green-500' : 'bg-gray-500';
                                        $statusText = $isPublic ? 'Public' : 'Private';
                                    @endphp
                                    <span class="{{ $color }} text-white text-xs font-semibold px-2 py-1 rounded-full">
                                        {{ $statusText }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-lg font-semibold text-gray-900">
                                <a href="{{ route('admin.documents.show', $document->id) }}" class="hover:underline">
                                    {{ Str::limit($document->judul, 28) }}
                                </a>
                            </h3>
                            
                            @if($document->deskripsi)
                            <p class="mt-2 text-gray-600 text-sm flex-grow">
                                {{ Str::limit($document->deskripsi, 56) }}
                            </p>
                            @else
                            <div class="flex-grow"></div>
                            @endif

                             <div class="mt-4 pt-4 border-t grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-gray-500">
                                <div class="flex items-center"><i class="fas fa-file w-4 text-center mr-1"></i> {{ strtoupper($document->file_extension) }}</div>
                                <div class="flex items-center"><i class="fas fa-weight-hanging w-4 text-center mr-1"></i> {{ $document->formatted_size }}</div>
                                <div class="flex items-center"><i class="fas fa-download w-4 text-center mr-1"></i> {{ $document->download_count }}x</div>
                                <div class="flex items-center"><i class="fas fa-tag w-4 text-center mr-1"></i> {{ $document->kategori ?? 'Umum' }}</div>
                            </div>

                             <div class="mt-4 pt-4 border-t flex flex-col sm:flex-row sm:justify-between items-start sm:items-center gap-3">
                                <span class="text-xs text-gray-500">
                                    {{ $document->created_at->diffForHumans() }}
                                </span>
                                <div class="flex space-x-2 self-end sm:self-auto">
                                    <a href="{{ route('admin.documents.download', $document->id) }}" title="Download" onclick="event.preventDefault(); document.getElementById('download-form-{{ $document->id }}').submit();" class="text-blue-600 hover:text-blue-800"><i class="fas fa-download"></i></a>
                                    <form id="download-form-{{ $document->id }}" action="{{ route('admin.documents.download', $document->id) }}" method="POST" style="display: none;">@csrf</form>
                                    <a href="{{ route('admin.documents.show', $document->id) }}" title="Lihat Detail" class="text-green-600 hover:text-green-800"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.documents.edit', $document->id) }}" title="Edit" class="text-yellow-600 hover:text-yellow-800"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.documents.destroy', $document->id) }}" method="POST" onsubmit="return confirm('Hapus dokumen ini?')">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:text-red-800" title="Hapus"><i class="fas fa-trash"></i></button></form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $documents->links() }}
            </div>
        </div>
    </div>
</x-app-layout>