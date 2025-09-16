<x-user-components.layout>
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <div class="bg-white p-4 rounded shadow-sm text-center">
                        <h1 class="fw-bold mb-3">{{ $album->judul }}</h1>

                        @if($album->deskripsi)
                            <p class="lead text-muted mb-4">{{ $album->deskripsi }}</p>
                        @endif

                        <p class="text-muted mb-3">
                            <i class="far fa-calendar-alt me-1"></i> 
                            Dibuat: {{ $album->created_at->translatedFormat('d F Y') }}
                        </p>
                        <p class="text-muted mb-0">
                            <i class="fas fa-images me-1"></i> 
                            Total Foto: {{ $album->photos->count() }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                @forelse($album->photos as $photo)
                    <div class="col-md-4 col-lg-3">
                        <a href="{{ asset('storage/' . $photo->path) }}" 
                           data-lightbox="album-{{ $album->id }}"
                           @if($photo->deskripsi) data-title="{{ $photo->deskripsi }}" @endif
                           class="text-decoration-none">

                            <div class="card border-0 shadow-sm h-100">
                                <img src="{{ asset('storage/' . $photo->path) }}" 
                                     alt="Foto dari album {{ $album->judul }}"
                                     class="card-img-top"
                                     style="height: 200px; object-fit: cover;">
                                
                                @if($photo->deskripsi)
                                <div class="card-body">
                                    <p class="card-text text-muted small">
                                        {{ $photo->deskripsi }}
                                    </p>
                                </div>
                                @endif
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fas fa-image fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum ada foto dalam album ini</h4>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="row mt-5">
                <div class="col-12">
                    <a href="{{ url('/galeri')}}" class="btn btn-outline-brand">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Galeri
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-user-components.layout>

<style>
    :root {
        --brand-color: #FDB813;
        --brand-color-dark: #e4a60b;
    }
    .btn-outline-brand {
        color: var(--brand-color);
        border-color: var(--brand-color);
        font-weight: 500;
    }
    .btn-outline-brand:hover {
        background-color: var(--brand-color);
        border-color: var(--brand-color);
        color: #212529;
    }
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        overflow: hidden; 
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    }
    .card-img-top {
        transition: opacity 0.2s ease;
    }
    .card-img-top:hover {
        opacity: 0.9;
    }
    .lightbox:hover .lb-nav a.lb-prev,
    .lightbox:hover .lb-nav a.lb-next {
        opacity: 0.7 !important;
    }
</style>