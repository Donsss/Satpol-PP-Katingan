<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/katingan-logo.png') }}" alt="Logo Dinas" class="img-fluid">
            <img src="{{ asset('images/satpol-logo.png') }}" alt="Logo Dinas" class="img-fluid">
            <img src="{{ asset('images/damkar.png') }}" alt="Logo Dinas" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->is('visi*', 'struktur*', 'tugas*') ? 'active' : '' }}" href="#" id="profilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="profilDropdown">
                        <li><a class="dropdown-item {{ request()->is('sejarah*') ? 'active' : '' }}" href="{{ url('/sejarah') }}">Sejarah</a></li>
                        <li><a class="dropdown-item {{ request()->is('visi*') ? 'active' : '' }}" href="{{ url('/visi-misi') }}">Visi & Misi</a></li>
                        <li><a class="dropdown-item {{ request()->is('tugas*') ? 'active' : '' }}" href="{{ url('/tugas-fungsi') }}">Tugas & Fungsi</a></li>
                        <li><a class="dropdown-item {{ request()->is('struktur*') ? 'active' : '' }}" href="{{ url('/struktur-organisasi') }}">Struktur Organisasi</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('berita*') ? 'active' : '' }}" href="{{ url('/berita')}}">Berita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('galeri*') ? 'active' : '' }}" href="{{ url('/galeri')}}">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dokumen*') ? 'active' : '' }}" href="{{ url('/dokumen')}}">Unduhan</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar-brand img {
        height: 50px;
        transition: all 0.3s ease;
    }
    .navbar {
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 10px 0;
    }
    .navbar.scrolled {
        padding: 5px 0;
    }
    .navbar.scrolled .navbar-brand img {
        height: 40px;
    }
    .nav-link {
        color: #333;
        font-weight: 500;
        margin: 0 8px;
        position: relative;
    }
    .nav-link:hover:after,
    .nav-link.active:after {
        width: 100%;
    }
    .dropdown-menu {
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    .top-bar {
        background-color: #ffd700;
        color: white;
        padding: 5px 0;
        font-size: 14px;
    }
    .contact-info i {
        margin-right: 5px;
    }
    .btn-custom {
        background-color: #ffd700;
        color: white;
        border-radius: 50px;
        padding: 8px 20px;
        font-weight: 500;
        transition: all 0.3s;
    }
    .btn-custom:hover {
        background-color: #f1c40f;
        transform: translateY(-2px);
    }
    .nav-link:not(.dropdown-toggle):after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        background: #ffd700;
        bottom: 0;
        left: 0;
        transition: width 0.3s;
    }
    .nav-link:not(.dropdown-toggle):hover:after,
    .nav-link:not(.dropdown-toggle).active:after {
        width: 100%;
    }
    .nav-link.dropdown-toggle::after {
        width: auto !important;
        height: auto !important;
        background: none !important;
        position: static !important;
        transition: none !important;
    }
    .dropdown-caret {
        transition: transform 0.3s;
        display: inline-block;
    }

    footer a.text-muted:hover {
        color: #fff !important;
        text-decoration: underline !important;
        transition: all 0.3s ease;
    }

    .back-to-top {
        transition: all 0.3s ease;
        opacity: 0.8;
    }

    .back-to-top:hover {
        opacity: 1;
        transform: translateY(-3px);
    }
    
    #userDropdown {
        display: flex;
        align-items: center;
    }
    
    .dropdown-menu-end {
        right: 0;
        left: auto;
    }

    .dropdown-item.active, 
    .dropdown-item:focus {
        background-color: #ffd700;
        color: #333;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>