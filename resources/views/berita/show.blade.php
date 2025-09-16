<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detail Berita
            </h2>
            <a href="{{ route('admin.berita.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-4 flex flex-col sm:flex-row sm:justify-between items-start gap-2">
                        @php
                            $statusColors = [
                                'draft' => 'bg-gray-500',
                                'publish' => 'bg-green-500',
                                'archive' => 'bg-blue-500'
                            ];
                            $color = $statusColors[$berita->status] ?? 'bg-gray-500';
                        @endphp
                        <span class="{{ $color }} text-white text-xs font-semibold px-2 py-1 rounded-full">
                            {{ ucfirst($berita->status) }}
                        </span>
                        
                        <div class="flex items-center text-gray-500 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <span>{{ $berita->views ?? 0 }}x dilihat</span>
                        </div>
                    </div>
                    
                    <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4">{{ $berita->judul }}</h1>

                    {{-- Thumbnail dipindahkan ke sini dengan gaya baru --}}
                    @if($berita->thumbnail)
                        <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="{{ $berita->judul }}" 
                             class="w-full rounded-lg mb-4 object-cover" 
                             style="max-height: 500px;">
                    @endif
                    
                    <article class="prose max-w-none">
                        {!! $berita->berita !!}
                    </article>
                    
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-500">
                            Ditulis {{ $berita->created_at->diffForHumans() }} oleh {{ $berita->user->name }}
                        </p>
                        <p class="text-sm text-gray-500">
                            Terakhir diperbarui {{ $berita->updated_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && (e.keyCode === 67 || e.keyCode === 86 || e.keyCode === 85 || e.keyCode === 117)) {
            e.preventDefault();
        }
    });
</script>