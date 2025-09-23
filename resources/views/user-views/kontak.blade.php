<x-user-components.layout :pageTitle="$pageTitle">
    <section class="pb-5" style="background-color: #f8f9fa;">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kontak</li>
                </ol>
            </nav>

            <div class="text-center mb-5">
                <h1 class="fw-bold text-dark">Hubungi Kami</h1>
                <div class="divider bg-dark mx-auto"></div>
                <p class="text-muted mt-3 col-lg-7 mx-auto">
                    Kami siap mendengarkan Anda. Punya pertanyaan, saran, atau kritik? Jangan ragu untuk mengisi formulir di bawah atau menghubungi kami melalui informasi yang tersedia.
                </p>
            </div>

            <div class="card shadow-lg border-0" style="border-radius: 15px; overflow: hidden;">
                <div class="row g-0">
                    <!-- Kolom Kiri: Formulir Kontak -->
                    <div class="col-lg-7 p-4 p-md-5">
                        <h3 class="fw-bold mb-4">Kirim Pesan</h3>
                        
                        @if(session('success'))
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                <div>{{ session('success') }}</div>
                            </div>
                        @endif

                        <form action="{{ route('kontak.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                                    @error('nama_lengkap')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Alamat Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="telepon" class="form-label">Nomor Telepon <small class="text-muted">(Opsional)</small></label>
                                    <input type="tel" class="form-control" id="telepon" name="telepon" value="{{ old('telepon') }}">
                                    @error('telepon')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tipe_pesan" class="form-label">Tipe Pesan <span class="text-danger">*</span></label>
                                    <select class="form-select" id="tipe_pesan" name="tipe_pesan" required>
                                        <option value="" disabled selected>-- Pilih Tipe Pesan --</option>
                                        <option value="Pertanyaan" {{ old('tipe_pesan') == 'Pertanyaan' ? 'selected' : '' }}>Pertanyaan</option>
                                        <option value="Saran" {{ old('tipe_pesan') == 'Saran' ? 'selected' : '' }}>Saran</option>
                                        <option value="Kritik" {{ old('tipe_pesan') == 'Kritik' ? 'selected' : '' }}>Kritik</option>
                                        <option value="Lainnya" {{ old('tipe_pesan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('tipe_pesan')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="isi_pesan" class="form-label">Isi Pesan <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="isi_pesan" name="isi_pesan" rows="5" required>{{ old('isi_pesan') }}</textarea>
                                @error('isi_pesan')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="row align-items-center">
                                <div class="col-md-7 mb-3 mb-md-0">
                                    <label for="captcha" class="form-label">Verifikasi <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">{{ $captchaQuestion }} = ?</span>
                                        <input type="number" class="form-control" id="captcha" name="captcha" placeholder="Jawaban" required>
                                    </div>
                                    @error('captcha')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-5 text-md-end">
                                     <button type="submit" class="btn btn-brand w-100 px-4 py-2">
                                        <i class="fas fa-paper-plane me-2"></i> Kirim Pesan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Kolom Kanan: Informasi Kontak & Jam Kerja -->
                    <div class="col-lg-5 bg-dark text-white d-flex flex-column justify-content-center">
                        <div class="p-4 p-md-5">
                            <h3 class="fw-bold mb-4 text-brand">Info & Jam Kerja</h3>
                            <ul class="list-unstyled">
                                <!-- Alamat -->
                                <li class="d-flex align-items-start mb-4">
                                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                                    <div class="ms-3">
                                        <h6 class="fw-bold mb-1">Alamat</h6>
                                        <p class="mb-0 text-white-50">Jl. Garuda II, Komplek Perkantoran Kereng Humbang</p>
                                    </div>
                                </li>
                                <!-- Email Utama -->
                                <li class="d-flex align-items-start mb-4">
                                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                                    <div class="ms-3">
                                        <h6 class="fw-bold mb-1">Email</h6>
                                        <p class="mb-0 text-white-50">polpp@katingankab.go.id</p>
                                        <p class="mb-0 text-white-50">satpoldam.katingan@gmail.com</p>
                                    </div>
                                </li>
                                <!-- Jam Kerja -->
                                <li class="d-flex align-items-start">
                                    <div class="contact-icon"><i class="fas fa-clock"></i></div>
                                    <div class="ms-3">
                                        <h6 class="fw-bold mb-1">Jam Kerja</h6>
                                        <p class="mb-1 text-white-50">Senin - Kamis: <span class="fw-medium text-white">08:00 - 16:00</span></p>
                                        <p class="mb-0 text-white-50">Jum'at: <span class="fw-medium text-white">08:00 - 15:00</span></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

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
        
        .breadcrumb { background-color: transparent; padding: 0.75rem 0; font-size: 0.9rem; }
        .breadcrumb-item + .breadcrumb-item::before { content: ">"; padding: 0 0.5rem; }
        .breadcrumb-item a { color: #6c757d; text-decoration: none; }
        .breadcrumb-item.active { color: var(--brand-color); }

        .divider { width: 80px; height: 3px; margin: 15px 0; }

        .form-control, .form-select {
            border-radius: 0.5rem;
            padding: 0.85rem 1rem;
        }
        .form-control:focus,
        .form-select:focus {
            border-color: var(--brand-color);
            box-shadow: 0 0 0 0.25rem rgba(253, 184, 19, 0.25);
        }
        .btn-brand {
            background-color: var(--brand-color);
            border-color: var(--brand-color);
            color: #212529;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        .btn-brand:hover {
            background-color: var(--brand-color-dark);
            border-color: var(--brand-color-dark);
            color: #212529;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .text-brand { color: var(--brand-color) !important; }

        .contact-icon {
            flex-shrink: 0;
            width: 50px;
            height: 50px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--brand-color);
        }
    </style>
    @endpush
</x-user-components.layout>

