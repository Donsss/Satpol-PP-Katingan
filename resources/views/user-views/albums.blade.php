<x-user-components.layout>
    <section class="pb-5" style="background-color: #f8f9fa;">
        <div class="container">

            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Galeri</li>
                </ol>
            </nav>

            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="fw-bold text-dark">Galeri Foto</h1>
                    <div class="divider bg-brand"></div>
                </div>
            </div>

            <div class="row g-4">
                @forelse($albums as $album)
                <div class="col-md-6 col-lg-4">
                    <div class="card album-card border-0 shadow-sm h-100">
                        <a href="{{ route('galeri.user.lihat', $album) }}" class="text-decoration-none">
                            <div class="cover-container position-relative">
                                @if($album->cover)
                                <img src="{{ asset('storage/' . $album->cover) }}" 
                                     alt="{{ $album->judul }}"
                                     class="card-img-top"
                                     style="height: 220px; object-fit: cover;">
                                @else
                                <div class="card-img-top d-flex align-items-center justify-content-center bg-secondary"
                                     style="height: 220px;">
                                    <i class="fas fa-images fa-3x text-white"></i>
                                </div>
                                @endif
                                
                                {{-- Badge Jumlah Foto --}}
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge album-badge px-2 py-1">
                                        <i class="fas fa-image me-1"></i>
                                        {{ $album->photos_count }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-dark mb-2">{{ $album->judul }}</h5>
                                
                                @if($album->deskripsi)
                                <p class="card-text text-muted small mb-3">
                                    {{ Str::limit($album->deskripsi, 80) }}
                                </p>
                                @endif
                                
                                <div class="mt-auto">
                                    <small class="text-muted">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        {{ $album->created_at->translatedFormat('d M Y') }}
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5 bg-white rounded shadow-sm">
                        <i class="fas fa-folder-open fa-4x text-muted mb-4"></i>
                        <h4 class="text-muted mb-2">Belum Ada Album Foto</h4>
                        <p class="text-muted">Nantikan koleksi foto-foto kegiatan kami di sini.</p>
                    </div>
                </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($albums->hasPages())
            <div class="row mt-5">
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            {{ $albums->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
            @endif
        </div>
    </section>

    {{-- Gunakan @push untuk menambahkan style ke layout utama --}}
    @push('styles')
    <style>
        :root {
            --brand-color: #FDB813;
            --brand-color-dark: #e4a60b;
        }

        /* Breadcrumb & Divider */
        .breadcrumb { background-color: transparent; padding: 0.75rem 0; font-size: 0.9rem; }
        .breadcrumb-item + .breadcrumb-item::before { content: ">"; padding: 0 0.5rem; }
        .breadcrumb-item a { color: #6c757d; text-decoration: none; }
        .breadcrumb-item.active { color: var(--brand-color); }
        .divider { width: 80px; height: 3px; margin: 15px 0; }
        .bg-brand { background-color: var(--brand-color); }

        /* Album Card Styling */
        .album-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            border-radius: 15px !important;
        }
        
        .album-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.12) !important;
        }
        
        .album-card .cover-container {
            overflow: hidden;
        }
        
        .album-card img {
            transition: transform 0.5s ease;
        }
        
        .album-card:hover img {
            transform: scale(1.08);
        }

        .album-card .card-title {
            color: #212529 !important;
            transition: color 0.2s ease;
        }

        .album-card:hover .card-title {
            color: var(--brand-color) !important;
        }
        
        .album-badge {
            font-size: 0.8rem;
            font-weight: 500;
            background-color: var(--brand-color);
            color: #212529;
            border-radius: 50px;
        }
        
        /* Pagination */
        .pagination .page-link { 
            border-radius: 8px; 
            margin: 0 3px; 
            border: none; 
            color: var(--brand-color); 
            font-weight: 500;
        }
        .pagination .page-item.active .page-link { 
            background-color: var(--brand-color); 
            border-color: var(--brand-color); 
            color: #212529; 
        }
        .pagination .page-item.disabled .page-link { 
            color: #6c757d; 
        }
        .pagination .page-link:hover {
            background-color: #fef3d7;
        }
        .pagination .page-item.active .page-link:hover {
            background-color: var(--brand-color-dark);
        }

    </style>
    @endpush
</x-user-components.layout>