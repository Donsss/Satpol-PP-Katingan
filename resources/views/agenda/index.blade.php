<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                <x-bottom-sidebar-mobile></x-bottom-sidebar-mobile>
                {{ __('Manajemen Agenda') }}
            </h2>
            <a href="{{ route('admin.agenda.create') }}" class="btn btn-primary d-flex align-items-center">
                <i class="fas fa-plus me-2"></i> Tambah Agenda Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 md:p-6">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="agenda-list-container">
                        @forelse ($agendas as $agenda)
                            <div class="mb-3 shadow-sm card agenda-card">
                                <div class="card-body">
                                    <div class="d-flex flex-column flex-md-row align-items-center gap-3">

                                        {{-- Blok Tanggal (Kiri) --}}
                                        <div class="flex-shrink-0">
                                            <div class="mx-auto agenda-date-box">
                                                <span class="day">{{ $agenda->tanggal->format('d') }}</span>
                                                <span class="month">{{ $agenda->tanggal->translatedFormat('M') }}</span>
                                                <span class="year">{{ $agenda->tanggal->format('Y') }}</span>
                                            </div>
                                        </div>

                                        {{-- Blok Detail (Tengah, mengisi sisa ruang) --}}
                                        <div class="flex-grow-1 text-center text-md-start">
                                            <h5 class="mb-1 card-title agenda-title">{{ $agenda->judul }}</h5>
                                            <p class="mb-0 card-text text-muted">
                                                <span class="me-3"><i class="far fa-clock me-2"></i>{{ \Carbon\Carbon::parse($agenda->waktu)->format('H:i') }} WIB</span>
                                                <span><i class="fas fa-map-marker-alt me-2"></i>{{ $agenda->lokasi ?? 'Tidak ada lokasi' }}</span>
                                            </p>
                                        </div>

                                        {{-- Blok Aksi (Kanan) --}}
                                        <div class="flex-shrink-0">
                                            <div class="d-flex justify-content-center justify-content-md-end gap-2">
                                                <a href="{{ route('admin.agenda.edit', $agenda) }}" class="btn btn-sm btn-warning d-flex align-items-center" title="Edit">
                                                    <i class="fas fa-edit"></i><span class="d-none d-lg-inline ms-1">Edit</span>
                                                </a>
                                                <form action="{{ route('admin.agenda.destroy', $agenda) }}" method="POST" class="d-inline" onsubmit="confirmDelete(event)">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center" title="Hapus">
                                                        <i class="fas fa-trash"></i><span class="d-none d-lg-inline ms-1">Hapus</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-5 text-center border rounded">
                                <i class="mb-3 far fa-calendar-times fa-4x text-gray-300"></i>
                                <h4 class="text-muted">Belum Ada Agenda</h4>
                                <p class="text-muted">Silakan tambahkan agenda baru untuk menampilkannya di sini.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Link Paginasi --}}
                    @if ($agendas->hasPages())
                        <div class="mt-4">
                            {{ $agendas->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    {{-- CSS Kustom untuk Desain Baru --}}
    @push('styles')
    <style>
        .agenda-card {
            transition: all 0.2s ease-in-out;
            border: 1px solid #e9ecef;
        }
        .agenda-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.08) !important;
            border-left: 4px solid var(--bs-primary);
        }
        .agenda-date-box {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 0.5rem;
            width: 70px;
            color: #6c757d;
            display: flex; /* Tambahan untuk layouting internal */
            flex-direction: column; /* Tambahan */
            align-items: center; /* Tambahan */
            justify-content: center; /* Tambahan */
        }
        .agenda-date-box .day {
            font-size: 1.75rem;
            font-weight: 700;
            color: #212529;
            line-height: 1;
        }
        .agenda-date-box .month {
            font-size: 0.8rem;
            text-transform: uppercase;
            font-weight: 600;
        }
        .agenda-date-box .year {
            font-size: 0.75rem;
        }
        .agenda-title {
            font-weight: 600;
            color: #343a40;
        }
    </style>
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(event) {
            event.preventDefault(); 
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Agenda ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit(); 
                }
            });
        }
    </script>
    @endpush
</x-app-layout>