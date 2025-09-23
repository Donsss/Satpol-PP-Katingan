<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row mb-4">
                    <div class="col-12 text-center text-lg-start">
                        <h2 class="fw-bold">Berita Terkini</h2>
                        <div class="divider bg-dark mx-auto mx-lg-0"></div>
                    </div>
                </div>

                <div class="row g-4">
                    @forelse($beritaTerkini as $berita)
                        <div class="col-md-6">
                            <div class="news-card">
                                <div class="news-thumbnail">
                                    <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="{{ $berita->judul }}" class="img-fluid">
                                </div>
                                <div class="news-content">
                                    <div class="news-meta">
                                        <span class="date"><i class="far fa-calendar-alt me-1"></i> {{ $berita->created_at->format('d F Y') }}</span>
                                        <span class="views ms-3"><i class="far fa-eye me-1"></i> {{ $berita->views }}x</span>
                                    </div>
                                    <h3 class="news-title">
                                       <a href="{{ route('berita.user.show', [$berita->id, $berita->slug]) }}" class="text-decoration-none news-title-link">
                                            {{ Str::limit($berita->judul, 85) }}
                                       </a>
                                    </h3>
                                    <p class="news-excerpt">{{ Str::limit(strip_tags($berita->berita), 80) }}...</p>
                                    <a href="{{ route('berita.user.show', [$berita->id, $berita->slug]) }}" class="read-more">Baca Selengkapnya <i class="fas fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center p-5 bg-white rounded-3 border">
                                <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                                <p class="mb-0 text-muted fw-bold">Belum Ada Berita</p>
                                <p class="mb-0 text-muted small">Silakan kembali lagi nanti untuk melihat berita terkini.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                @if($beritaTerkini->isNotEmpty())
                <div class="text-center mt-4 d-block d-lg-none">
                    <a href="{{ url('/berita')}}" class="btn btn-primary px-4 py-2">Lihat Semua Berita</a>
                </div>
                @endif
            </div>

            <div class="col-lg-4 mt-5 mt-lg-0">
                 <div class="document-list-card">
                    <h4 class="fw-bold mb-3">Dokumen Publik</h4>
                    <ul class="document-list">
                       @forelse($dokumenTerbaru as $dokumen)
                        <li>
                            <a href="{{ route('documents.user.download', $dokumen) }}">
                                <i class="fas fa-file-alt me-2"></i>
                                <span>{{ $dokumen->judul }}</span>
                            </a>
                        </li>
                       @empty
                        <li class="text-center text-muted p-4">
                            <i class="fas fa-file-excel fa-2x d-block mb-2"></i>
                            <span>Belum ada dokumen yang tersedia.</span>
                        </li>
                       @endforelse
                    </ul>

                    @if($dokumenTerbaru->isNotEmpty())
                    <div class="text-center mt-4">
                         <a href="{{ url('/dokumen')}}" class="btn btn-outline-primary w-100">Lihat Semua Dokumen</a>
                    </div>
                    @endif
                 </div>
            </div>

        </div>
    </div>
</section>

<style>
    .btn-primary, .btn-outline-primary:hover {
        background-color: #FDB813;
        border-color: #FDB813;
        color: #212529;
        font-weight: 500;
    }

    .btn-primary:hover {
        background-color: #e4a60b;
        border-color: #d89e0a;
        color: #212529;
    }
    
    .btn-outline-primary {
        color: #FDB813;
        border-color: #FDB813;
    }
    
    .divider {
        width: 80px; height: 3px; margin: 15px 0;
    }
    .news-card {
        background: #fff; border-radius: 10px; overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: all 0.3s ease;
        height: 100%; display: flex; flex-direction: column;
    }
    .news-card:hover {
        transform: translateY(-10px); box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    .news-thumbnail {
        position: relative; overflow: hidden; height: 200px;
    }
    .news-thumbnail img {
        width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;
    }
    .news-card:hover .news-thumbnail img {
        transform: scale(1.05);
    }
    .news-content {
        padding: 20px; flex-grow: 1; display: flex; flex-direction: column;
    }
    .news-meta {
        color: #6c757d; font-size: 14px; margin-bottom: 10px;
    }
    .news-title {
        font-size: 18px; font-weight: 600; margin-bottom: 10px; min-height: 25px;
    }
    .news-title-link {
        color: #212529; transition: color 0.2s ease-in-out;
    }
    .news-title-link:hover {
        color: #FDB813;
    }
    .news-excerpt {
        color: #6c757d; margin-bottom: 15px; flex-grow: 1;
    }
    .read-more {
        color: #FDB813; font-weight: 500; text-decoration: none;
        display: inline-flex; align-items: center; transition: all 0.3s ease; margin-top: auto;
    }
    .read-more:hover {
        color: #e4a60b;
    }
    .read-more i {
        transition: transform 0.3s ease;
    }
    .read-more:hover i {
        transform: translateX(5px);
    }

    .document-list-card {
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .document-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .document-list li {
        padding: 12px 0;
        border-bottom: 1px solid #eee;
    }
    .document-list li:last-child {
        border-bottom: none;
    }
    .document-list a {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #343a40;
        font-weight: 500;
        transition: color 0.2s ease-in-out;
    }
    .document-list a:hover {
        color: #FDB813;
    }
    .document-list a i {
        color: #FDB813;
    }
</style>