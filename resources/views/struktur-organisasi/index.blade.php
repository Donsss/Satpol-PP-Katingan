<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight truncate">
                <x-bottom-sidebar-mobile></x-bottom-sidebar-mobile>
                Struktur Organisasi
            </h2>
            <a href="{{ route('admin.organisasi.create') }}" class="flex-shrink-0 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 text-center">
                Tambah Anggota
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 text-gray-900">
                    @if($groupedStructures->count() > 0)
                        <div class="organization-chart">
                            @foreach($groupedStructures as $section => $members)
                                <div class="organization-level" style="--section-number: 'Level {{ $loop->iteration }}';">
                                    @foreach($members as $member)
                                        <div class="member-card">
                                            <div class="member-card-image">
                                                @if($member->photo)
                                                    <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="member-photo">
                                                @else
                                                    <svg class="h-24 w-24 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                                @endif
                                            </div>
                                            
                                            <div class="member-card-content">
                                                <h4 class="font-bold text-gray-800 text-base uppercase">{{ $member->name }}</h4>
                                                <p class="text-gray-600 font-medium uppercase text-sm">{{ $member->position }}</p>
                                                @if($member->nip)
                                                    <p class="text-gray-500 text-sm mt-2">NIP. {{ $member->nip }}</p>
                                                @endif
                                            </div>
                                            
                                            <div class="member-card-actions">
                                                <a href="{{ route('admin.organisasi.edit', $member->id) }}" class="text-blue-500 hover:text-blue-700" title="Edit">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                                </a>
                                                <form action="{{ route('admin.organisasi.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700" title="Hapus">
                                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada struktur organisasi</h3>
                            <p class="mt-1 text-gray-500">Mulai dengan menambahkan anggota.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .organization-chart {
        display: flex;
        flex-direction: column;
        gap: 25px;
        padding: 20px;
    }

    .organization-level {
        display: flex;
        justify-content: center;
        align-items: stretch;
        flex-wrap: wrap;
        gap: 25px;
        position: relative;
        padding-bottom: 50px;
        margin-bottom: 20px;
        border-bottom: 2px solid #3B82F6;
    }

    .organization-level:last-child {
        border-bottom: none; 
        padding-bottom: 20px;
        margin-bottom: 0;
    }

    .organization-level::before {
        content: var(--section-number);
        position: absolute;
        left: 0;
        bottom: -15px; 
        font-weight: 700;
        color: #3B82F6;
        background-color: #ffffff;
        padding: 0 10px;
        z-index: 0;
    }

    .member-card {
        width: 240px; 
        border: 1px solid #e2e8f0;
        border-top: none;
        border-radius: 8px;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        background-color: white;
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
        text-align: center;
        overflow: hidden;
        position: relative;
        padding-top: 20px;
        z-index: 1; 
    }

    .member-card::before {
        content: '';
        position: absolute;
        top: 8px;
        left: 15px;
        right: 15px;
        height: 4px;
        background-image: linear-gradient(to right, #3B82F6 75%, transparent 25%);
        background-size: 12px 4px;
        background-repeat: repeat-x;
    }

    .member-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
    }

    .member-card-image {
        width: 100%;
        height: 250px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
    }

    .member-card-image .member-photo {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }

    .member-card-content {
        padding: 1rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 0.25rem;
    }

    .member-card-actions {
        display: flex;
        justify-content: center;
        gap: 1rem;
        padding: 0.75rem;
        border-top: 1px solid #e2e8f0;
        background-color: #f9fafb;
    }
</style>