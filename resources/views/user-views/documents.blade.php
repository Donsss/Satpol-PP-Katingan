<x-user-components.layout :pageTitle="$pageTitle">
    <section class="pb-5" style="background-color: #f8f9fa;">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Unduhan</li>
                </ol>
            </nav>

            <div class="row mb-4 align-items-end">
                <div class="col-md-6">
                    <h1 class="fw-bold text-dark">Dokumen Publik</h1>
                    <div class="divider bg-dark"></div>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('dokumen.user.indexUser') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari dokumen..." value="{{ request('search') }}">
                            <select name="kategori" class="form-select" style="max-width: 180px;">
                                <option value="">Semua Kategori</option>
                                @foreach($kategories as $kategori)
                                    @if($kategori)
                                    <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>
                                        {{ $kategori }}
                                    </option>
                                    @endif
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-brand">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle bg-white shadow-sm responsive-table" style="border-radius: 10px; overflow: hidden;">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="py-3 px-4" style="width: 45%;">Judul Dokumen</th>
                                    <th scope="col" class="py-3 px-4 col-mobile-hide">Kategori</th>
                                    <th scope="col" class="py-3 px-4 col-mobile-hide">Ukuran</th>
                                    <th scope="col" class="py-3 px-4 col-mobile-hide">Diunduh</th>
                                    <th scope="col" class="py-3 px-4 text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($documents as $document)
                                <tr>
                                    <td data-label="Judul Dokumen" class="px-4">
                                        <a href="{{ route('dokumen.user.showUser', $document) }}" class="text-decoration-none fw-medium document-title">
                                            {{ $document->judul }}
                                        </a>
                                    </td>
                                    <td data-label="Kategori" class="px-4 col-mobile-hide"><span class="badge bg-light text-dark">{{ $document->kategori ?? 'Umum' }}</span></td>
                                    <td data-label="Ukuran" class="px-4 col-mobile-hide">{{ $document->formatted_size }}</td>
                                    <td data-label="Diunduh" class="px-4 col-mobile-hide">{{ $document->download_count }}x</td>
                                    <td class="px-4">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('dokumen.user.showUser', $document) }}" class="btn btn-sm btn-outline-secondary btn-mobile-hide">Lihat</a>
                                            <form action="{{ route('dokumen.user.downloadUser', $document) }}" method="POST" class="m-0">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-brand">
                                                    <i class="fas fa-download me-1"></i>
                                                    <span class="btn-mobile-hide">Unduh</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="text-center py-5">
                                            <i class="fas fa-file-excel fa-3x text-muted mb-3"></i>
                                            <h4 class="text-muted">Tidak Ada Dokumen Ditemukan</h4>
                                            @if(request('search') || request('kategori'))
                                                <p class="text-muted mb-0">Coba dengan kata kunci atau kategori yang berbeda.</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if($documents->hasPages())
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $documents->appends(request()->query())->links() }}
                </div>
            </div>
            @endif
        </div>
    </section>

    @push('styles')
    <style>
        :root {
            --brand-color: #FDB813;
            --brand-color-dark: #e4a60b;
        }
        
        /* ===== GAYA BREADCRUMB DIKEMBALIKAN ===== */
        .breadcrumb { background-color: transparent; padding: 0.75rem 0; font-size: 0.9rem; }
        .breadcrumb-item + .breadcrumb-item::before { content: ">"; padding: 0 0.5rem; }
        .breadcrumb-item a { color: #6c757d; text-decoration: none; }
        .breadcrumb-item.active { color: var(--brand-color); }
        /* ========================================= */

        .divider { width: 80px; height: 3px; margin: 15px 0; }
        .input-group .form-control:focus,
        .input-group .form-select:focus {
            border-color: var(--brand-color);
            box-shadow: 0 0 0 0.25rem rgba(253, 184, 19, 0.25);
        }
        .btn-brand {
            background-color: var(--brand-color); border-color: var(--brand-color); color: #212529; font-weight: 500;
        }
        .btn-brand:hover {
            background-color: var(--brand-color-dark); border-color: var(--brand-color-dark); color: #212529;
        }
        .btn-outline-brand {
            color: var(--brand-color); border-color: var(--brand-color); font-weight: 500;
        }
        .btn-outline-brand:hover {
            background-color: var(--brand-color); border-color: var(--brand-color); color: #212529;
        }
        .pagination .page-item.active .page-link { background-color: var(--brand-color); color: #fff; border-color: var(--brand-color); }
        .table-light { --bs-table-bg: #fdfdfe; }
        .table > thead { border-bottom: 2px solid #e9ecef; }
        .document-title:hover { color: var(--brand-color); }

        @media (max-width: 767px) {
            .col-mobile-hide {
                display: none;
            }
            .btn-mobile-hide {
                display: none;
            }
            .responsive-table thead {
                display: none;
            }
            .responsive-table tr {
                display: block;
                border-bottom: 1px solid #e9ecef;
                padding: 1rem 0.5rem;
            }
            .responsive-table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.5rem 0.5rem;
                text-align: right;
                border: none;
            }
            .responsive-table td:before {
                content: attr(data-label);
                font-weight: 600;
                text-align: left;
                padding-right: 1rem;
            }
            .responsive-table td[data-label="Judul Dokumen"] {
                display: block;
                text-align: left;
                font-size: 1.1rem;
                margin-bottom: 1rem;
            }
            .responsive-table td[data-label="Judul Dokumen"]:before {
                display: none;
            }
            .responsive-table td:last-child {
                justify-content: flex-end;
            }
        }
    </style>
    @endpush
</x-user-components.layout>