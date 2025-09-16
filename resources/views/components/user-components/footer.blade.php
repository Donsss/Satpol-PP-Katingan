<footer class="footer-redesigned text-white">
    <div class="main-footer-content pt-5 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4">
                    <h5 class="text-uppercase fw-bold mb-4">Lokasi Kami</h5>
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d6933.1552387941365!2d113.40179957718584!3d-1.880114348952308!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMcKwNTInNDkuNyJTIDExM8KwMjQnMDUuNyJF!5e1!3m2!1sid!2sid!4v1757384319683!5m2!1sid!2sid" 
                            width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 mb-4">
                    <h5 class="text-uppercase fw-bold mb-4">Kontak Kami</h5>
                    <div class="contact-item d-flex mb-3">
                        <i class="fas fa-map-marker-alt fa-fw mt-1 me-3"></i>
                        <div>
                            <p class="mb-0"> Jl. Garuda II, Komplek Perkantoran Kereng Humbang</p>
                        </div>
                    </div>
                    <div class="contact-item d-flex mb-3">
                        <i class="fas fa-envelope fa-fw mt-1 me-3"></i>
                        <div>
                            <p class="mb-0">polpp@katingankab.go.id</p>
                            <p class="mb-0">satpoldam@gmail.com</p>
                        </div>
                    </div>
                    <div class="contact-item d-flex mb-4">
                        <i class="fas fa-phone-alt fa-fw mt-1 me-3"></i>
                        <div>
                            <p class="mb-0">-</p>
                        </div>
                    </div>

                    <div class="social-media">
                        <a href="https://www.facebook.com/humaspolppkatingan01" class="text-white me-2" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/humaspolppdandamkarkatingan" class="text-white me-2" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://x.com/PolPp95292" class="text-white me-2" title="X (Twitter)"><i class="fab fa-x-twitter"></i></a>
                        <a href="https://www.tiktok.com/@satpolppkatingan" class="text-white me-2" title="TikTok"><i class="fab fa-tiktok"></i></a>
                        <a href="https://www.youtube.com/@satpolppkab.katingan2341" class="text-white me-2" title="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0 small">
                        © 2025 DIREKTORAT POLISI PAMONG PRAJA DAN PERLINDUNGAN MASYARAKAT. All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<a href="#" class="btn back-to-top position-fixed" style="bottom: 20px; right: 20px; display: none;">
    <i class="fas fa-arrow-up"></i>
</a>

<style>
    .footer-redesigned {
        background-color: #01122E;
        color: #f8f9fa;
    }
    .footer-redesigned h5 {
        position: relative;
        padding-bottom: 10px;
    }
    .footer-redesigned h5::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 3px;
        background-color: #FDB813;
    }
    .footer-redesigned .map-container iframe {
        border-radius: 8px;
        filter: grayscale(20%);
    }
    .footer-redesigned .contact-item {
        line-height: 1.6;
    }
    .footer-redesigned .contact-item i {
        font-size: 1.2rem;
        color: #FDB813;
    }
    .footer-redesigned .social-media a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background-color: #FDB813;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-size: 1.2rem;
        color: #01122E;
    }
    .footer-redesigned .social-media a:hover {
        background-color: #e4a60b;
        transform: translateY(-3px);
    }
    .footer-copyright {
        background-color: #061429;
        padding: 15px 0;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }
    .footer-copyright p {
        color: rgba(255, 255, 255, 0.7);
    }

    .back-to-top {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        background-color: #FDB813;
        border: none;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }
    .back-to-top i {
        color: #01122E;
        font-size: 1.2rem;
    }
    .back-to-top:hover {
        background-color: #e4a60b;
        transform: translateY(-4px);
    }
</style>

<script>
    window.addEventListener('scroll', function() {
        var backToTop = document.querySelector('.back-to-top');
        if (window.pageYOffset > 300) {
            backToTop.style.display = 'flex';
        } else {
            backToTop.style.display = 'none';
        }
    });

    document.querySelector('.back-to-top').addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({top: 0, behavior: 'smooth'});
    });
</script>