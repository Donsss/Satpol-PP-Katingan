@if($sliders->isNotEmpty())
    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach($sliders as $slider)
                <button type="button" data-bs-target="#mainCarousel" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></button>
            @endforeach
        </div>
        
        <div class="carousel-inner">
            @foreach($sliders as $slider)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $slider->image_path) }}" class="d-block w-100" alt="{{ $slider->title }}">
                    <div class="carousel-caption">
                        <h3 class="text-white text-shadow">{{ $slider->title }}</h3>
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@else
    <div class="d-flex justify-content-center align-items-center" style="height: 550px; background-color: #f8f9fa; border-radius: 8px;">
        <p class="text-muted">Belum ada gambar untuk ditampilkan saat ini. 🖼️</p>
    </div>
@endif

<style>
    .carousel-item img {
        object-fit: cover;
        width: 100%;
        height: 100dvh;
    }
    .carousel-caption {
        bottom: 8%;
        left: 10%;
        right: 10%;
    }
    .text-shadow {
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }
    .carousel-indicators button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin: 0 5px;
    }
    @media (max-width: 768px) {
        .carousel-item img {
            height: 300px;
        }
        .carousel-caption h3 {
            font-size: 1.2rem;
        }
        /* Sesuaikan tinggi placeholder untuk tampilan mobile */
        .d-flex.justify-content-center.align-items-center {
            height: 300px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myCarousel = document.getElementById('mainCarousel');
        // Pastikan script hanya berjalan jika elemen carousel ada di halaman
        if(myCarousel) {
            var carousel = new bootstrap.Carousel(myCarousel, {
                interval: 5000, // Ganti slide setiap 5 detik
                pause: 'hover', // Jeda saat mouse di atas carousel
                wrap: true      // Kembali ke awal setelah slide terakhir
            });
        }
    });
</script>