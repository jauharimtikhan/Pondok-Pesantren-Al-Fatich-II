<section id="topbar" class="topbar d-flex align-items-center d-lg-block d-none">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-geo-alt-fill d-flex align-items-center"><a href="#">Sentul Timur, Sentul, Kec.
                    Tembelang,
                    Kabupaten Jombang, Jawa Timur 61452</a></i>
            <i class="bi bi-whatsapp d-flex align-items-center ms-4"><span>+6281-5517-2595</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        </div>
    </div>
</section>

<header id="header" class="header d-flex align-items-center">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="{{ route('/') }}" class="logo d-flex align-items-center">
            <h1>Pon Pes Alfatich 2</h1>
        </a>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="{{ route('/') }}">Beranda</a></li>
                <li><a href="{{ route('/') }}#tentangkami">Tentang Kami</a></li>
                <li><a href="{{ route('wakaf.landing_page') }}">Wakaf</a></li>
                <li><a href="{{ route('artikel.landing_page') }}">Artikel</a></li>
                <li><a href="{{ route('/') }}#contact">Kontak</a></li>
            </ul>
        </nav>

        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
</header>
