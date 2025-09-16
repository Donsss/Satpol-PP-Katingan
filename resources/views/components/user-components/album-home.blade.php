<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="fw-bold">Galeri Kegiatan</h2>
                <div class="divider mx-auto bg-dark"></div>
            </div>
        </div>

        <div class="row g-4">
            @forelse($albums as $album)
                <div class="col-lg-3 col-md-6">
                    <div class="album-card position-relative">
                        @if($album->cover)
                            <img src="{{ asset('storage/' . $album->cover) }}" alt="{{ $album->judul }}" class="img-fluid rounded">
                        @else
                            <div class="card-img-top d-flex align-items-center justify-content-center bg-secondary"
                                style="height: 220px;">
                                <i class="fas fa-images fa-3x text-white"></i>
                            </div>
                        @endif
                        
                        <div class="album-overlay d-flex align-items-center justify-content-center">
                            <div class="text-center text-white">
                                <h5 class="mb-2">{{ $album->judul }}</h5>
                                <span class="badge bg-white text-brand mb-3">{{ $album->photos_count }} Foto</span> 
                                <a href="{{ route('galeri.user.lihat', $album->id) }}" class="view-album text-white">VIEW ALBUM</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center p-5 bg-white rounded-3 border">
                        <i class="fas fa-camera-retro fa-3x text-muted mb-3"></i>
                        <p class="mb-0 text-muted fw-bold">Belum Ada Album Foto</p>
                        <p class="mb-0 text-muted small">Kegiatan yang didokumentasikan akan tampil di sini.</p>
                    </div>
                </div>
            @endforelse
        </div>

        @if($albums->isNotEmpty())
            <div class="text-center mt-5">
                <a href="{{ url('/galeri')}}" class="btn btn-primary px-4 py-2">Lihat Semua Album</a>
            </div>
        @endif
    </div>
</section>

<style>
    :root {
        --brand-color: #FDB813;
        --brand-color-dark: #e4a60b;
    }
    .btn-primary {
        background-color: var(--brand-color);
        border-color: var(--brand-color);
        color: #212529;
        font-weight: 500;
    }
    .btn-primary:hover {
        background-color: var(--brand-color-dark);
        border-color: var(--brand-color-dark);
        color: #212529;
    }
    .text-brand {
        color: var(--brand-color) !important;
    }
    .album-card {
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .album-card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .album-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(253, 184, 19, 0.8);
        opacity: 0;
        transition: all 0.3s ease;
        border-radius: 10px;
    }
    .album-card:hover .album-overlay {
        opacity: 1;
    }
    .album-card:hover img {
        transform: scale(1.05);
    }
    .view-album {
        font-weight: 600;
        letter-spacing: 1px;
        padding: 8px 20px;
        border: 2px solid white;
        border-radius: 50px;
        display: inline-block;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .album-card:hover .view-album {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.2);
    }
    .divider {
        width: 80px;
        height: 3px;
        margin: 15px auto;
    }
    @media (max-width: 768px) {
        .album-card img {
            height: 200px;
        }
    }
</style>