<x-user-components.layout :pageTitle="$pageTitle">
    <section class="pb-5" style="background-color: #f8f9fa;">
        <div class="container">
            <nav aria-label="breadcrumb" >
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Berita</li>
                </ol>
            </nav>

            <div class="row mb-4 align-items-end">
                <div class="col-md-6">
                    <h1 class="fw-bold text-dark">Berita</h1>
                    <div class="divider bg-dark"></div>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('berita.user.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control border-primary" 
                                   name="search" placeholder="Cari berita..." 
                                   value="{{ $searchQuery }}">
                            <button class="btn btn-brand" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    @forelse($berita as $item)
                    <div class="card mb-4 shadow-sm border-0 news-item-card">
                        <div class="row g-0">
                            <div class="col-md-4 p-3">
                                <img src="{{ file_exists(public_path('storage/' . $item->thumbnail)) ? asset('storage/' . $item->thumbnail) : 'https://via.placeholder.com/600x400?text=Thumbnail' }}" 
                                     alt="{{ $item->judul }}" 
                                     class="img-fluid rounded overflow-hidden">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body d-flex flex-column h-100">
                                    <h5 class="card-title fw-bold">
                                        <a href="{{ route('berita.user.show', [$item->id, $item->slug]) }}" class="text-decoration-none news-title-link">
                                            {{ $item->judul }}
                                        </a>
                                    </h5>
                                    <p class="text-muted small mb-3">
                                        Penulis: {{ $item->user->name ?? 'Admin' }} | Tanggal: {{ $item->created_at->translatedFormat('d-m-Y') }}
                                    </p>
                                    <p class="card-text text-secondary mb-4">
                                        {{ Str::limit(strip_tags($item->berita), 352) }}
                                    </p>
                                    <div class="mt-auto">
                                        <a href="{{ route('berita.user.show', [$item->id, $item->slug]) }}" class="btn btn-brand">Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted mb-3">
                                @if($searchQuery)
                                    Tidak ditemukan berita dengan kata kunci "{{ $searchQuery }}"
                                @else
                                    Belum ada berita tersedia saat ini.
                                @endif
                            </h4>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

            @if($berita->hasPages())
            <div class="row mt-4">
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            {{ $berita->appends(['search' => $searchQuery])->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
            @endif
        </div>
    </section>

    @push('styles')
    <style>
        .breadcrumb {
            background-color: transparent;
            padding: 0.75rem 0;
            font-size: 0.9rem;
        }
        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
            padding: 0 0.5rem;
        }
        .breadcrumb-item a {
            color: #6c757d;
            text-decoration: none;
        }
        .breadcrumb-item.active {
            color: #FDB813;
        }
        .divider {
            width: 80px;
            height: 3px;
            margin: 15px 0;
        }
        .input-group {
            max-width: 400px;
            margin-left: auto;
        }
        .form-control.border-primary {
            border-color: #FDB813 !important;
        }
        .form-control.border-primary:focus {
            border-color: #FDB813 !important;
            box-shadow: 0 0 0 0.25rem rgba(253, 184, 19, 0.25) !important;
        }
        .news-item-card {
            transition: box-shadow 0.3s ease-in-out;
            border-radius: 8px;
            overflow: hidden;
        }
        .news-item-card:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        .news-item-card img {
            height: 250px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .news-item-card:hover img {
            transform: scale(1.05);
        }
        .pagination .page-link {
            border-radius: 8px;
            margin: 0 3px;
            border: none;
            color: #FDB813;
        }
        .pagination .page-item.active .page-link {
            background-color: #FDB813;
            border-color: #FDB813;
            color: #fff;
        }
        .pagination .page-item.disabled .page-link {
            color: #6c757d;
        }
        .news-title-link {
            color: #212529;
            transition: color 0.2s ease-in-out;
        }
        .news-title-link:hover {
            color: #FDB813;
        }

        .btn.btn-brand {
            background-color: #FDB813 !important;
            border-color: #FDB813 !important;
            color: #212529 !important;
            font-weight: 500;
        }

        .btn.btn-brand:hover, .btn-brand:focus {
            background-color: #e4a60b !important;
            border-color: #d89e0a !important;
            color: #212529 !important;
        }
    </style>
    @endpush
</x-user-components.layout>