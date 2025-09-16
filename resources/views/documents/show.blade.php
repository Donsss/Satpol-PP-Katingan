<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight truncate">
                {{ $pageTitle }}
            </h2>
            <div class="flex space-x-2 w-full sm:w-auto">
                <a href="{{ route('admin.documents.edit', $document) }}" class="flex-1 sm:flex-none text-center px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700">
                    Edit
                </a>
                <a href="{{ route('admin.documents.index') }}" class="flex-1 sm:flex-none text-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-center mb-6">
                        @php
                            $fileIcons = [
                                'pdf' => 'fa-file-pdf text-red-500', 'doc' => 'fa-file-word text-blue-500',
                                'docx' => 'fa-file-word text-blue-500', 'xls' => 'fa-file-excel text-green-500',
                                'xlsx' => 'fa-file-excel text-green-500', 'ppt' => 'fa-file-powerpoint text-orange-500',
                                'pptx' => 'fa-file-powerpoint text-orange-500', 'txt' => 'fa-file-alt text-gray-500',
                                'zip' => 'fa-file-archive text-purple-500', 'rar' => 'fa-file-archive text-purple-500'
                            ];
                            $iconClass = $fileIcons[$document->file_extension] ?? 'fa-file text-gray-500';
                        @endphp
                        <i class="fas {{ $iconClass }} text-6xl"></i>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 mb-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Informasi Dokumen</h3>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Judul</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $document->judul }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Deskripsi</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $document->deskripsi ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $document->kategori ?? 'Umum' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="mt-1">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $document->is_public ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $document->is_public ? 'Public' : 'Private' }}
                                        </span>
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Detail File</h3>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Nama File</dt>
                                    <dd class="mt-1 text-sm text-gray-900 break-words">{{ $document->file_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Ukuran</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $document->formatted_size }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Total Download</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $document->download_count }} kali</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Diupload Oleh</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $document->user->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Tanggal Upload</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $document->created_at->translatedFormat('d F Y H:i') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-center gap-4 pt-6 border-t border-gray-200">
                        <form action="{{ route('admin.documents.download', $document) }}" method="POST" class="w-full sm:w-auto">
                            @csrf
                            <button type="submit" class="w-full px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 flex items-center justify-center">
                                <i class="fas fa-download mr-2"></i> Download File
                            </button>
                        </form>

                        <form action="{{ route('admin.documents.destroy', $document) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?')" class="w-full sm:w-auto">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-6 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 flex items-center justify-center">
                                <i class="fas fa-trash mr-2"></i> Hapus Dokumen
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>