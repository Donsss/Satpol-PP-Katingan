@props(['pimpinanGrouped'])

@push('styles')
<style>
    :root {
        --brand-color: #FDB813;
    }

    /* Divider (Tidak ada perubahan) */
    .divider {
        width: 80px;
        height: 3px;
        margin: 15px 0 30px 0;
    }
    .bg-brand {
        background-color: var(--brand-color);
    }

    /* --- MULAI: CSS DIADOPSI DARI HALAMAN UTAMA --- */
    .organization-chart {
        display: flex;
        flex-direction: column;
        gap: 50px; /* Jarak antar baris/level */
        padding: 20px;
        align-items: center;
    }

    .organization-level {
        display: flex;
        justify-content: center;
        align-items: stretch;
        flex-wrap: wrap;
        gap: 25px; /* Jarak antar kartu */
        position: relative;
        width: 100%;
    }

    .member-card {
        width: 240px; /* Lebar kartu */
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
    /* --- SELESAI: CSS DIADOPSI DARI HALAMAN UTAMA --- */

</style>
@endpush

<section class="py-5" style="background-color: #f0f2f5;">
    <div class="container">
        {{-- Section Header --}}
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold text-dark">Struktur Organisasi</h2>
                <div class="divider bg-brand mx-auto"></div>
            </div>
        </div>

        @if($pimpinanGrouped->count() > 0)
            {{-- Organization Chart Layout (Struktur HTML diubah) --}}
            <div class="organization-chart">
                @foreach($pimpinanGrouped as $members)
                    <div class="organization-level">
                        @foreach($members as $member)
                            {{-- Menggunakan class "member-card" dari halaman utama --}}
                            <div class="member-card" data-aos="fade-up">
                                <div class="member-card-image">
                                    @if($member->photo)
                                        <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="member-photo">
                                    @else
                                        <svg class="text-secondary" style="height: 150px; width: 150px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    @endif
                                </div>
                                
                                <div class="member-card-content">
                                    <h6 class="card-title fw-bold text-dark mb-0 text-uppercase">{{ $member->name }}</h6>
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

            {{-- Tombol ke halaman detail (Tidak ada perubahan) --}}
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <a href="{{ url('/struktur-organisasi') }}" class="btn btn-primary fw-bold px-4 py-2" style="background-color: var(--brand-color-dark); border-color: var(--brand-color-dark);">
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