@push('styles')
<style>
    .form-control:focus, .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .input-group-text {
        background-color: #e9ecef;
        width: 42px;
        justify-content: center;
    }
    .btn-primary {
        transition: all 0.2s ease-in-out;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
</style>
@endpush

<div class="mb-4">
    <label for="judul" class="form-label fw-bold">Judul Agenda <span class="text-danger">*</span></label>
    <div class="input-group">
        <span class="input-group-text"><i class="fas fa-heading"></i></span>
        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $agenda->judul ?? '') }}" placeholder="Contoh: Rapat Koordinasi Bulanan" required>
        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row mb-2">
    <div class="col-md-6 mb-3">
        <label for="tanggal" class="form-label fw-bold">Tanggal <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', isset($agenda) ? $agenda->tanggal->format('Y-m-d') : '') }}" required>
            @error('tanggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <label for="waktu" class="form-label fw-bold">Waktu <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text"><i class="far fa-clock"></i></span>
            <input type="time" class="form-control @error('waktu') is-invalid @enderror" id="waktu" name="waktu" value="{{ old('waktu', $agenda->waktu ?? '') }}" required>
            @error('waktu') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
</div>

<div class="mb-4">
    <label for="lokasi" class="form-label fw-bold">Lokasi</label>
    <div class="input-group">
        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
        <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" value="{{ old('lokasi', $agenda->lokasi ?? '') }}" placeholder="Contoh: Ruang Rapat Utama">
        @error('lokasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

{{-- Deskripsi --}}
<div class="mb-4">
    <label for="deskripsi" class="form-label fw-bold">Deskripsi <small class="text-muted">(Opsional)</small></label>
    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4" placeholder="Jelaskan detail agenda di sini...">{{ old('deskripsi', $agenda->deskripsi ?? '') }}</textarea>
    @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="d-flex justify-content-end pt-3 border-top">
    <a href="{{ route('admin.agenda.index') }}" class="btn btn-secondary me-2">
        <i class="fas fa-times me-2"></i>Batal
    </a>
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-2"></i>Simpan Agenda
    </button>
</div>