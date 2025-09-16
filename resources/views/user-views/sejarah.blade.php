<x-user-components.layout>
    <section style="background-color: #f8f9fa;">
        <div class="container">

            {{-- Breadcrumb Navigation --}}
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item">Profil</li>
                    <li class="breadcrumb-item active" aria-current="page">Sejarah</li>
                </ol>
            </nav>

            {{-- Page Header --}}
            <div class="row mb-5">
                <div class="col-12">
                    <h1 class="fw-bold text-dark">Sejarah Satuan Polisi Pamong Praja (Satpol PP)</h1>
                    <div class="divider bg-brand"></div>
                </div>
            </div>

            {{-- Konten Sejarah --}}
            <div class="row">
                <div class="col-12">
                    @if($sejarah && !empty($sejarah->konten))
                        {{-- Card untuk Konten Sejarah --}}
                        <div class="content-card">
                            <div class="content-icon">
                                <i class="fas fa-history"></i>
                            </div>
                            <div class="content-body">
                                <div class="content-text">
                                    {!! $sejarah->konten !!}
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Pesan jika konten belum tersedia --}}
                        <div class="text-center py-5 bg-white rounded shadow-sm">
                            <i class="fas fa-file-alt fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted mb-2">Konten Belum Tersedia</h4>
                            <p class="text-muted">Informasi mengenai Sejarah akan segera kami perbarui.</p>
                        </div>
                    @endif
                </div>
            </div>
            
        </div>
    </section>

    @push('styles')
<style>
    :root {
        --brand-color: #FDB813;
        --brand-color-dark: #e4a60b;
    }

    /* Breadcrumb & Divider (Sama seperti Visi Misi) */
    .breadcrumb { background-color: transparent; padding: 0.75rem 0; font-size: 0.9rem; }
    .breadcrumb-item + .breadcrumb-item::before { content: ">"; padding: 0 0.5rem; }
    .breadcrumb-item a { color: #6c757d; text-decoration: none; }
    .breadcrumb-item.active { color: var(--brand-color); }
    .divider { width: 80px; height: 3px; margin: 15px 0; }
    .bg-brand { background-color: var(--brand-color); }

    /* Card Styling untuk Konten Sejarah (adaptasi dari .vm-card) */
    .content-card {
        display: flex;
        align-items: flex-start;
        background-color: #ffffff;
        padding: 2.5rem;
        border-radius: 15px; /* Ini memberikan sudut yang membulat */
        box-shadow: 0 8px 25px rgba(0,0,0,0.07);
        margin-bottom: 2rem;
        border-left: 5px solid var(--brand-color);
    }

    .content-icon {
        font-size: 2.5rem;
        color: var(--brand-color);
        margin-right: 2rem;
        min-width: 40px;
        text-align: center;
    }

    .content-body {
        flex: 1;
    }

    .content-title {
        font-weight: 700;
        color: #212529;
        margin-bottom: 1rem;
        font-size: 1.75rem;
    }

    .content-text {
        color: #555;
        line-height: 1.8;
        font-size: 1rem;
    }
    
    /* Styling untuk konten dari editor (misal: list, p, dll) */
    .content-text ul { padding-left: 20px; margin-top: 1rem; }
    .content-text li { margin-bottom: 0.75rem; }
    .content-text p:last-child { margin-bottom: 0; }

    /* Responsive */
    @media (max-width: 767px) {
        .content-card {
            padding: 1.5rem;
        }
        .content-icon {
            display: none; /* Sembunyikan ikon di layar kecil agar tidak sempit */
        }
        .content-title {
            font-size: 1.5rem;
        }
    }
</style>
@endpush
</x-user-components.layout>
