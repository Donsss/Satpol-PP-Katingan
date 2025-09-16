<x-user-components.layout>
    <section style="background-color: #f8f9fa;">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item">Profil</li>
                    <li class="breadcrumb-item active" aria-current="page">Tugas & Fungsi</li>
                </ol>
            </nav>

            <div class="row mb-5">
                <div class="col-12">
                    <h1 class="fw-bold text-dark">Tugas dan Fungsi Satuan Polisi Pamong Praja (Satpol PP)</h1>
                    <div class="divider bg-brand"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    @if($tugas && !empty($tugas->konten))
                        <div class="content-card">
                            <div class="content-icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                            <div class="content-body">
                                <h2 class="content-title">Tugas dan Fungsi Instansi</h2>
                                <div class="content-text">
                                    {!! $tugas->konten !!}
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- JIKA TIDAK ADA DATA, TAMPILKAN INI --}}
                        <div class="text-center py-5 bg-white rounded shadow-sm">
                            <i class="fas fa-file-alt fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted mb-2">Konten Belum Tersedia</h4>
                            <p class="text-muted">Informasi mengenai Tugas & Fungsi akan segera kami perbarui.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- Bagian 4: Styling (CSS) --}}
    @push('styles')
    <style>
        /* CSS di sini sama persis dengan halaman sejarah untuk menjaga konsistensi */
        :root {--brand-color: #FDB813;}
        .breadcrumb { background-color: transparent; padding: 0.75rem 0; font-size: 0.9rem; }
        .breadcrumb-item + .breadcrumb-item::before { content: ">"; padding: 0 0.5rem; }
        .breadcrumb-item a { color: #6c757d; text-decoration: none; }
        .breadcrumb-item.active { color: var(--brand-color); }
        .divider { width: 80px; height: 3px; margin: 15px 0; background-color: var(--brand-color); }
        .content-card { display: flex; align-items: flex-start; background-color: #ffffff; padding: 2.5rem; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.07); margin-bottom: 2rem; border-left: 5px solid var(--brand-color); }
        .content-icon { font-size: 2.5rem; color: var(--brand-color); margin-right: 2rem; min-width: 40px; text-align: center; }
        .content-body { flex: 1; }
        .content-title { font-weight: 700; color: #212529; margin-bottom: 1rem; font-size: 1.75rem; }
        .content-text { color: #555; line-height: 1.8; font-size: 1rem; }
        @media (max-width: 767px) {
            .content-card { padding: 1.5rem; }
            .content-icon { display: none; }
            .content-title { font-size: 1.5rem; }
        }
    </style>
    @endpush
</x-user-components.layout>
