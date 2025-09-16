<x-user-components.layout>
    <section style="background-color: #f8f9fa;">
        <div class="container">

            {{-- Breadcrumb Navigation --}}
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item">Profil</li>
                    <li class="breadcrumb-item active" aria-current="page">Visi & Misi</li>
                </ol>
            </nav>

            {{-- Page Header --}}
            <div class="row mb-5">
                <div class="col-12">
                    <h1 class="fw-bold text-dark">Visi & Misi</h1>
                    <div class="divider bg-brand"></div>
                </div>
            </div>

            {{-- Konten Visi & Misi --}}
            <div class="row">
                <div class="col-12">
                    @if($visiMisi && $visiMisi->visi && $visiMisi->misi)
                        {{-- Visi Section --}}
                        <div class="vm-card">
                            <div class="vm-icon">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <div class="vm-content">
                                <h2 class="vm-title">Visi</h2>
                                <div class="vm-text">
                                    {!! $visiMisi->visi !!}
                                </div>
                            </div>
                        </div>

                        {{-- Misi Section --}}
                        <div class="vm-card">
                            <div class="vm-icon">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <div class="vm-content">
                                <h2 class="vm-title">Misi</h2>
                                <div class="vm-text">
                                    {!! $visiMisi->misi !!}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5 bg-white rounded shadow-sm">
                            <i class="fas fa-file-alt fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted mb-2">Konten Belum Tersedia</h4>
                            <p class="text-muted">Informasi mengenai Visi & Misi akan segera kami perbarui.</p>
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

    /* Breadcrumb & Divider */
    .breadcrumb { background-color: transparent; padding: 0.75rem 0; font-size: 0.9rem; }
    .breadcrumb-item + .breadcrumb-item::before { content: ">"; padding: 0 0.5rem; }
    .breadcrumb-item a { color: #6c757d; text-decoration: none; }
    .breadcrumb-item.active { color: var(--brand-color); }
    .divider { width: 80px; height: 3px; margin: 15px 0; }
    .bg-brand { background-color: var(--brand-color); }

    /* Visi & Misi Card Styling */
    .vm-card {
        display: flex;
        align-items: flex-start;
        background-color: #ffffff;
        padding: 2.5rem;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.07);
        margin-bottom: 2rem;
        border-left: 5px solid var(--brand-color);
    }

    .vm-icon {
        font-size: 2.5rem; /* 40px */
        color: var(--brand-color);
        margin-right: 2rem;
        min-width: 40px; /* Agar ikon tidak menyusut */
        text-align: center;
    }

    .vm-content {
        flex: 1;
    }

    .vm-title {
        font-weight: 700;
        color: #212529;
        margin-bottom: 1rem;
        font-size: 1.75rem;
    }

    .vm-text {
        color: #555;
        line-height: 1.8;
        font-size: 1rem;
    }

    /* Styling untuk konten dari editor (misal: list) */
    .vm-text ul {
        padding-left: 20px;
        margin-top: 1rem;
    }
    .vm-text li {
        margin-bottom: 0.75rem;
    }
    .vm-text p:last-child {
        margin-bottom: 0;
    }

    /* Responsive */
    @media (max-width: 767px) {
        .vm-card {
            padding: 1.5rem;
        }
        .vm-icon {
            display: none;
        }
        .vm-title {
            font-size: 1.5rem;
        }
    }
</style>
@endpush
</x-user-components.layout>