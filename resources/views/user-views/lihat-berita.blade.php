<x-user-components.layout>
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8">
                    <article class="bg-white p-4 rounded shadow-sm">
                        <h1 class="fw-bold mb-4">{{ $berita->judul }}</h1>

                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                            <div class="text-muted mb-2">
                                <i class="far fa-calendar-alt me-1"></i>
                                {{ $berita->created_at->translatedFormat('l, d F Y') }}
                            </div>
                            <div class="text-muted mb-2">
                                <i class="far fa-eye me-1"></i> {{ $berita->views }}x dilihat
                                @if($berita->user)
                                <span class="ms-3">
                                    <i class="fas fa-user me-1"></i> {{ $berita->user->name }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-4">
                            <strong class="me-3">Bagikan:</strong>
                            <div class="d-flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank"
                                    class="btn btn-social btn-facebook" title="Bagikan ke Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($berita->judul) }}"
                                    target="_blank" class="btn btn-social btn-twitter" title="Bagikan ke Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' ' . url()->current()) }}"
                                    target="_blank" class="btn btn-social btn-whatsapp" title="Bagikan ke WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                                <a href="javascript:void(0);" id="copy-link-btn" data-url="{{ url()->current() }}"
                                    class="btn btn-social btn-copy" title="Salin Tautan">
                                    <i class="fas fa-link"></i>
                                </a>
                            </div>
                        </div>
                        @if($berita->thumbnail)
                        <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="{{ $berita->judul }}"
                            class="img-fluid rounded-3 mb-4 w-100" style="max-height: 500px; object-fit: cover;">
                        @endif

                        <div class="content mb-5 prose no-select no-copy" style="text-align: justify">
                            {!! $berita->berita !!}
                        </div>

                        <a href="{{ url('/berita')}}" class="btn btn-outline-brand">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                    </article>
                </div>
                
                <div class="col-lg-4">
                    <div class="bg-white p-4 rounded shadow-sm">
                        <h5 class="fw-bold border-bottom pb-3 mb-4">
                            <i class="fas fa-newspaper me-2 text-brand"></i> Berita Lainnya
                        </h5>
                        
                        @foreach($rekomendasiBerita as $item)
                        <div class="mb-4 pb-3 border-bottom">
                            <a href="{{ route('berita.user.show', [$item->id, $item->slug]) }}" class="text-decoration-none d-block">
                                @if($item->thumbnail)
                                <img src="{{ asset('storage/' . $item->thumbnail) }}" 
                                     alt="{{ $item->judul }}"
                                     class="img-fluid rounded-3 mb-2 w-100"
                                     style="height: 180px; object-fit: cover;">
                                @endif
                                
                                <h6 class="fw-bold text-dark mb-1">{{ Str::limit($item->judul, 60) }}</h6>
                                <small class="text-muted">
                                    <i class="far fa-calendar-alt me-1"></i> 
                                    {{ $item->created_at->translatedFormat('d F Y') }}
                                </small>
                            </a>
                        </div>
                        @endforeach
                        
                        <a href="{{ route('berita.user.index') }}" class="btn btn-outline-brand w-100 mt-2">
                            Lihat Semua Berita <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-user-components.layout>

<style>
    .content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #333;
    }
    
    .content p {
        margin-bottom: 1.5rem;
    }
    
    .content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 1.5rem auto;
    }
    
    .content iframe {
        max-width: 100%;
        margin: 1.5rem auto;
        display: block;
    }
    
    .content h2 {
        margin-top: 2.5rem;
        margin-bottom: 1.2rem;
        color: #2c3e50;
        font-weight: 600;
        font-size: 1.5rem;
    }
    
    .content h3 {
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #2c3e50;
        font-weight: 600;
        font-size: 1.3rem;
    }

    .no-select {
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }
    
    .no-copy::selection {
        background: transparent;
    }
    
    .no-copy {
        cursor: default;
    }
    
    .col-lg-4 a:hover h6 {
        color: #FDB813 !important;
        transition: color 0.2s;
    }
    
    .text-brand {
        color: #FDB813 !important;
    }

    .btn-outline-brand {
        border-color: #FDB813;
        color: #FDB813;
    }

    .btn-outline-brand:hover {
        background-color: #FDB813;
        border-color: #FDB813;
        color: #212529;
    }

    .btn-social {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        border: none;
        text-decoration: none;
        transition: transform 0.2s;
    }


    .btn-facebook { background-color: #3b5998; }
    .btn-twitter { background-color: #1da1f2; }
    .btn-whatsapp { background-color: #25d366; }
    .btn-copy { background-color: #6c757d; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const copyBtn = document.getElementById('copy-link-btn');
        if (copyBtn) {
            copyBtn.addEventListener('click', function () {
                const urlToCopy = this.getAttribute('data-url');
 
                navigator.clipboard.writeText(urlToCopy).then(() => {
                    const originalIcon = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-check"></i>';
                    this.style.backgroundColor = '#198754'; // Warna hijau sukses

                    setTimeout(() => {
                        this.innerHTML = originalIcon;
                        this.style.backgroundColor = '#6c757d';
                    }, 2000);
                }).catch(err => {
                    console.error('Gagal menyalin tautan: ', err);
                    alert('Gagal menyalin tautan.');
                });
            });
        }
    });
</script>