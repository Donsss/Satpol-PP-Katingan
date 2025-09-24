<x-user-components.layout>

    @push('styles')
    <style>
    :root {
        --brand-color: #FDB813;
        --brand-color-dark: #e4a60b;
    }

    .breadcrumb { background-color: transparent; padding: 0.75rem 0; font-size: 0.9rem; }
    .breadcrumb-item + .breadcrumb-item::before { content: ">"; padding: 0 0.5rem; }
    .breadcrumb-item a { color: #6c757d; text-decoration: none; }
    .breadcrumb-item.active { color: var(--brand-color); }
    .divider { width: 80px; height: 3px; margin: 15px 0 30px 0; }
    .bg-brand { background-color: var(--brand-color); }

    .organization-chart {
        display: flex;
        flex-direction: column;
        gap: 50px;
        padding: 20px;
        align-items: center;
    }

    .organization-level {
        display: flex;
        justify-content: center;
        align-items: stretch;
        flex-wrap: wrap;
        gap: 25px;
        position: relative;
        width: 100%;
    }

    .member-card {
        width: 240px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        background-color: white;
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
        text-align: center;
        overflow: hidden;
        position: relative;
        border-bottom: 5px solid var(--brand-color);
    }
    .member-card:hover {
        transform: translateY(-5px);
    }

    .member-card-image {
        height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        margin-top: 1rem;
    }
    .member-card-image .member-photo {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }

    .member-card-content {
        padding: 1rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 0.5rem;
    }

    .member-card-content .card-title {
        font-size: 0.9rem;
        line-height: 1.4;
    }
</style>
    @endpush

    <section class="pb-5" style="background-color: #f8f9fa;">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="#">Profil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Struktur Organisasi</li>
                </ol>
            </nav>

            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h1 class="fw-bold text-dark">Struktur Organisasi</h1>
                    <div class="divider bg-brand mx-auto"></div>
                </div>
            </div>

            {{-- Organization Chart --}}
            <div class="row">
                <div class="col-12">
                    @if($groupedStructures->count() > 0)
                        <div class="organization-chart">
                            @foreach($groupedStructures as $members)
                                <div class="organization-level">
                                    @foreach($members as $member)
                                        <div class="member-card" data-aos="fade-up">
                                            <div class="member-card-image">
                                                @if($member->photo)
                                                    <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="member-photo">
                                                @else
                                                    <svg class="h-24 w-24 text-secondary" style="height: 150px; width: 150px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                                @endif
                                            </div>
                                            
                                            <div class="member-card-content">
                                                <h6 class="card-title fw-bold text-dark mb-0 text-uppercase">{{ $member->name }}</h5>
                                                <p class="card-text text-gray-500 mb-1 fw-semibold text-uppercase">{{ $member->position }}</p>
                                                @if($member->nip)
                                                    <p class="text-muted small">NIP. {{ $member->nip }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5 bg-white rounded shadow-sm">
                            <i class="fas fa-sitemap fa-4x text-muted mb-4"></i>
                            <h4 class="text-muted mb-2">Struktur Organisasi Belum Tersedia</h4>
                            <p class="text-muted">Informasi akan segera diperbarui.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

</x-user-components.layout>