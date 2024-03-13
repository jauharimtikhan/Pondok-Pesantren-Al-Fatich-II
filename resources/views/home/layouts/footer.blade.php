<footer id="footer" class="footer">

    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-5 col-md-12 footer-info">
                <a href="{{ route('/') }}" class="logo d-flex align-items-center">
                    <span>Pon Pes Al Fatich 2</span>
                </a>
                <p>Yayasan Pendidikan Islam Al Fatich 2 adalah lembaga pendidikan yang berkomitmen untuk memberikan
                    pendidikan berkualitas dengan nilai-nilai Islam yang kuat. Terletak di Sentul Timur, Sentul,
                    Kecamatan Tembelang, Kabupaten Jombang, Jawa Timur 61452</p>
                <div class="social-links d-flex mt-4">
                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-6 footer-links">
                <h4>Tautan Cepat</h4>
                <ul>
                    <li><a href="{{ route('/') }}">Beranda</a></li>
                    <li><a href="#tentangkami">Tentang Kami</a></li>
                    <li><a href="#wakaf">Wakaf</a></li>
                    <li><a href="#blog">Artikel</a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-6 footer-links">
                <h4>Ketentuan Website</h4>
                <ul>
                    <li><a href="#">Kebijakan Privasi</a></li>
                    <li><a href="#">Site Map</a></li>
                    <li><a href="#">Term & Conditions</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                <h4>Hubungi Kami</h4>
                <p>
                    Sentul Timur, Sentul,<br>
                    Kec. Tembelang,<br>
                    Kabupaten Jombang,<br> Jawa Timur 61452<br>
                    <strong>Whatsapp:</strong> +6281-5517-2595<br>
                    <strong>Email:</strong> admin@alfatich.my.id<br>
                </p>

            </div>

        </div>
    </div>

    <div class="container mt-4">
        <div class="copyright">
            &copy; Copyright {{ date('Y') }} <strong><span> Pondok Pesantren Al Fatich 2</span></strong>. All Rights
            Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade.</a> Coded by Tim PKM Unwaha
        </div>
    </div>

</footer>
