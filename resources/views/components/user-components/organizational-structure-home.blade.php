@props(['pimpinanGrouped'])

@push('styles')
<style>
    .pimpinan-card {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        background-color: white;
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
        text-align: center;
        overflow: hidden;
        border-bottom: 5px solid #FDB813; /* Warna brand */
        height: 100%;
    }
    .pimpinan-card:hover {
        transform: translateY(-5px);
    }
    .pimpinan-card-image {
        height: 240px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        margin-top: 1rem;
    }
    .pimpinan-card-image .pimpinan-photo {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }
    .pimpinan-card-content {
        padding: 1rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .pimpinan-card-content .card-title {
        font-size: 0.9rem;
        line-height: 1.4;
    }
</style>
@endpush

<section class="py-5" style="background-color: #f0f2f5;">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold text-dark">Struktur Organisasi</h2>
                <div class="divider bg-brand mx-auto"></div>
            </div>
        </div>

        @if($pimpinanGrouped->count() > 0)
            @foreach($pimpinanGrouped as $sectionMembers)
                <div class="row justify-content-center g-4 mb-5">
                    @foreach($sectionMembers as $member)
                        <div class="col-lg-3 col-md-4 col-sm-6 d-flex align-items-stretch" data-aos="fade-up">
                            <div class="pimpinan-card">
                                <div class="pimpinan-card-image">
                                    @if($member->photo)
                                        <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="pimpinan-photo">
                                    @else
                                        <svg class="text-secondary" style="height: 150px; width: 150px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    @endif
                                </div>
                                <div class="pimpinan-card-content">
                                    <h6 class="card-title fw-bold text-dark mb-1 text-uppercase">{{ $member->name }}</h6>
                                    <p class="card-text text-gray-500 mb-2 fw-semibold text-uppercase" style="font-size: 0.85rem;">{{ $member->position }}</p>
                                    @if($member->nip)
                                        <p class="text-muted small mb-0">NIP. {{ $member->nip }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

            {{-- Tombol ke halaman detail --}}
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <a href="{{ url('/struktur-organisasi') }}" class="btn btn-primary fw-bold px-4 py-2">
                        Struktur Organisasi Lengkap <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>

        @else
            <div class="col-12 text-center">
                <p class="text-muted">Data pimpinan belum tersedia.</p>
            </div>
        @endif

    </div>
</section>