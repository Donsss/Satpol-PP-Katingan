<div class="node-container mx-4">
    <div class="node bg-white border border-gray-200 rounded-lg p-4 text-center shadow-sm hover:shadow-md transition-shadow min-w-[200px] w-full">
        @if($node->photo)
            <img src="{{ asset('storage/' . $node->photo) }}" alt="{{ $node->name }}" class="w-20 h-20 rounded-full mx-auto mb-3 object-cover border-2 border-gray-300">
        @else
            <div class="w-20 h-20 rounded-full mx-auto mb-3 bg-gray-200 flex items-center justify-center border-2 border-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
        @endif
        
        <h4 class="font-semibold text-gray-800 text-lg">{{ $node->name }}</h4>
        <p class="text-blue-600 font-medium">{{ $node->position }}</p>
        <p class="text-gray-600 text-xs mt-2">{{ Str::limit($node->description, 80) }}</p>
        
        <div class="node-actions flex justify-center space-x-2 mt-3">
            <a href="{{ route('admin.organisasi.edit', $node->id) }}" class="text-blue-500 hover:text-blue-700" title="Edit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </a>
            <form action="{{ route('admin.organisasi.destroy', $node->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus" onclick="return confirm('Yakin ingin menghapus?')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    @if($node->children->count() > 0)
        <div class="vertical-connector"></div>
        <div class="children-container">
            @foreach($node->children as $child)
                @include('struktur-organisasi.partials.node', ['node' => $child])
            @endforeach
        </div>
    @endif
</div>