@extends('frontend::layouts/app')
@push('hero_section')
    @include('frontend::components/home/banner')
@endpush

@section('content')
    <!-- ======= About Us Section ======= -->
    <section id="tentangkami" class="about">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Tentang Kami</h2>
                <p>Yayasan Pendidikan Islam Al Fatich 2 adalah lembaga pendidikan yang berkomitmen untuk memberikan
                    pendidikan berkualitas dengan nilai-nilai Islam yang kuat.</p>
            </div>

            <div class="row gy-4">
                <div class="col-lg-6">
                    <img src="{{ asset('assets-landing-page') }}/img/gallery (2).webp" class="img-fluid rounded-4 mb-4"
                        alt="">
                    <p>Kegiatan rutin setelah shalat ashar </p>
                    <p>pengajian al-qur'an dengan di dampingi para ustadz dan ustadzah yang berpengalaman dalam bidangnya.
                        Sehingga metode pembelajaran yang diterapkan untuk mengajarkan ilmu ini bisa menjadi lebih efektif.
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="content ps-0 ps-lg-5">
                        <p>
                            Yayasan Pendidikan Islam Al Fatich 2 adalah lembaga pendidikan yang berkomitmen untuk memberikan
                            pendidikan berkualitas dengan nilai-nilai Islam yang kuat. Terletak di Sentul Timur, Sentul,
                            Kecamatan Tembelang, Kabupaten Jombang, Jawa Timur 61452
                        </p>
                        <p>
                            Adapun beberapa kegiatan yang rutin di lakukan setiap 2 minggu sekali yaitu istighosah bersama
                            dan pembacaan maulid diba'.
                            Kegiatan ini bertujuan agar para santri memiliki jiwa religi yang kuat.
                        </p>


                        <div class="position-relative mt-4">
                            <img src="{{ asset('assets-landing-page') }}/img/about-2.webp" class="img-fluid rounded-4"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End About Us Section -->

    <!-- ======= Stats Counter Section ======= -->
    <section id="stats-counter" class="stats-counter">
        <div class="container" data-aos="fade-up">

            <div class="row gy-4 align-items-center">

                <div class="col-lg-6 d-flex justify-content-center">
                    <img src="{{ asset('assets-landing-page') }}/img/donation.svg" alt="" class="img-fluid"
                        style="width: 300px; height: 300px;">
                </div>

                <div class="col-lg-6">

                    <div class="stats-item d-flex align-items-center">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $donatur[0]->total_donatur }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p><strong>Total Donatur</strong></p>
                    </div><!-- End Stats Item -->

                    <div class="stats-item d-flex align-items-center">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $target_dana[0]->total }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p><strong>Total Dana Terkumpul</strong></p>
                    </div><!-- End Stats Item -->

                    <div class="stats-item d-flex align-items-center">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $target_dana[0]->target_dana }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p><strong>Target Dana</strong></p>
                    </div><!-- End Stats Item -->

                </div>

            </div>

        </div>
    </section><!-- End Stats Counter Section -->

    <!-- ======= Call To Action Section ======= -->
    <section id="wakaf" class="call-to-action">
        <div class="container text-center" data-aos="zoom-out">
            <h3>Bantu Kami Dengan Wakaf</h3>
            <p class="text-break">Bantuan anda sangat berharga bagi kami yang membutuhkan-nya, <br> "Ketika Allah memberimu
                nikmat secara finansial,
                jangan tingkatkan standar hidupmu, akan tetapi tingkatkan standarmu dalam bersedekah."</p>
            <a class="cta-btn" href="#">Wakaf Sekarang</a>
        </div>
    </section><!-- End Call To Action Section -->


    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Testimoni</h2>
            </div>

            <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">

                    @include('frontend::components/home/testimoni')
                    @include('frontend::components/home/testimoni')
                    @include('frontend::components/home/testimoni')
                    @include('frontend::components/home/testimoni')
                    @include('frontend::components/home/testimoni')
                    @include('frontend::components/home/testimoni')
                    @include('frontend::components/home/testimoni')

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section>
    <!-- End Testimonials Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio sections-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Kegiatan Pondok Pesantren</h2>
            </div>

            <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry"
                data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4 portfolio-container">
                    @foreach ($kegiatans as $kegiatan)
                        @include('frontend::components/home/kegiatan', ['kegiatan' => $kegiatan])
                    @endforeach


                </div><!-- End Portfolio Container -->

            </div>

        </div>
    </section>
    <!-- End Portfolio Section -->


    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing sections-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Wakaf Sekarang</h2>
                <p>Bantuan anda sangat berarti bagi kami yang membutuhkan nya</p>
            </div>

            <div class="row g-4 py-lg-5" data-aos="zoom-out" data-aos-delay="100">

                <div class="col-lg-4">
                    <div class="pricing-item">
                        <h3>Paket Wakaf 1</h3>
                        <div class="icon">
                            <i class="bi bi-box"></i>
                        </div>
                        <h4><sup>Rp. </sup>300,000.00<span></span></h4>
                        <ul>
                            <li><i class="bi bi-check"></i> Mendapatkan Sertifikat Penghargaan</li>
                            <li><i class="bi bi-check"></i> Amal Jariyah</li>
                            <li><i class="bi bi-check"></i> Mendapatkan Do'a dari para santri</li>
                        </ul>
                        <div class="text-center"><button type="button" onclick="pricing(300000)" class="buy-btn">Wakaf
                                Sekarang</button></div>
                    </div>
                </div><!-- End Pricing Item -->

                <div class="col-lg-4">
                    <div class="pricing-item">
                        <h3>Paket Wakaf 2</h3>
                        <div class="icon">
                            <i class="bi bi-airplane"></i>
                        </div>

                        <h4><sup>Rp. </sup>600,000.00<span></span></h4>
                        <ul>
                            <li><i class="bi bi-check"></i> Mendapatkan Sertifikat Penghargaan</li>
                            <li><i class="bi bi-check"></i> Amal Jariyah</li>
                            <li><i class="bi bi-check"></i> Mendapatkan Do'a dari para santri</li>
                        </ul>
                        <div class="text-center"><button type="button" onclick="pricing(900000)" class="buy-btn">Wakaf
                                Sekarang</button></div>
                    </div>
                </div><!-- End Pricing Item -->

                <div class="col-lg-4">
                    <div class="pricing-item featured">
                        <h3>Paket Wakaf 3</h3>
                        <div class="icon">
                            <i class="bi bi-send"></i>
                        </div>
                        <h4><sup>Rp. </sup>900,000.00<span></span></h4>
                        <ul>
                            <li><i class="bi bi-check"></i> Mendapatkan Sertifikat Penghargaan</li>
                            <li><i class="bi bi-check"></i> Amal Jariyah</li>
                            <li><i class="bi bi-check"></i> Mendapatkan Do'a dari para santri</li>
                        </ul>
                        <div class="text-center"><button type="button" onclick="pricing(900000)" class="buy-btn">Wakaf
                                Sekarang</button></div>
                    </div>
                </div><!-- End Pricing Item -->

            </div>

        </div>
    </section><!-- End Pricing Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Kontak Kami</h2>
                <p>Anda bisa menghubungi kami di bawah</p>
            </div>

            <div class="row gx-lg-0 gy-4">

                <div class="col-lg-4">

                    <div class="info-container d-flex flex-column align-items-center justify-content-center">
                        <div class="info-item d-flex">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h4>Location:</h4>
                                <p>Sentul Timur, Sentul, Kec. Tembelang, Kabupaten Jombang, Jawa Timur 61452</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h4>Email:</h4>
                                <p>admin@alfatich.my.id</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="info-item d-flex">
                            <i class="bi bi-whatsapp flex-shrink-0"></i>
                            <div>
                                <h4>Whatsapp:</h4>
                                <p>+6281-5517-2595</p>
                            </div>
                        </div><!-- End Info Item -->

                    </div>

                </div>

                <div class="col-lg-8">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Masukan Nama Anda" required style="border-radius: 0.327rem">
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control custom-form-control" name="email"
                                    id="email" placeholder="Masukan Email Anda" required
                                    style="border-radius: 0.327rem">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject"
                                placeholder="Masukan Subjek" required style="border-radius: 0.327rem">
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="7" placeholder="Masukan Pesan Anda" required
                                style="border-radius: 0.327rem"></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Kirim Pesan</button></div>
                    </form>
                </div><!-- End Contact Form -->

            </div>

        </div>
    </section><!-- End Contact Section -->


    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="modalpricing" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Wakaf Sekarang
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="form-checkout">
                        @csrf
                        <input type="hidden" name="total" id="totalpricing">
                        <div class="form-group mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" placeholder="Masukan Nama Lengkap Anda" id="nama"
                                class="form-control" required autocomplete="on">
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone" class="form-label">No.Whatsapp</label>
                            <input type="tel" name="phone" placeholder="Masukan Nomor Whatsapp Anda"
                                id="phone" class="form-control" required autocomplete="on">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Kembali
                    </button>
                    <button type="submit" class="btn btn-new-primary">Lanjut</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript" src="{{ getenv('MIDTRANS_URL') }}/snap/snap.js"
        data-client-key="{{ getenv('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        let keys = localStorage.getItem("token")

        function pricing(price) {
            $('#modalpricing').modal('show')
            $('#totalpricing').val(price)
        }
        $('.form-checkout').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ getenv('API_URL') }}payment/direct',
                method: 'post',
                headers: {
                    Authorization: `Bearer ${keys}`
                },
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('button[type="submit"]').prop('disabled', true);
                    $('button[type="submit"]').text('Loading...');
                },
                success: function(res) {
                    if (res.statusCode == 200) {
                        $('#modalpricing').modal('hide')
                        snap.pay(res.snap_token, {
                            onSuccess: function(result) {
                                Toast(2000).fire({
                                    icon: 'success',
                                    title: 'Pembayaran Berhasil'
                                }).then((success) => {
                                    window.location.replace = result.finish_redirect
                                })
                                // console.log(result);
                            },
                            onPending: function(result) {
                                Toast(2000).fire({
                                    icon: 'error',
                                    title: 'Pembayaran Tertunda'
                                }).then((success) => {
                                    window.location.replace = result.finish_redirect
                                })
                                console.log(result);
                            },
                            onError: function(result) {
                                Toast(2000).fire({
                                    icon: 'success',
                                    title: 'Transaksi Error'
                                }).then((success) => {
                                    window.location.href = result.finish_redirect
                                })
                                // console.log(result);
                            },
                            onClose: function() {

                                Toast(2000).fire({
                                    icon: 'error',
                                    title: 'Anda Mengakhiri Transaksi'
                                });
                                deleteTransaction($('#no_hp').val())
                            }
                        })
                    }
                },
                complete: function() {
                    $('button[type="submit"]').prop('disabled', false);
                    $('button[type="submit"]').text('Lanjut');
                },
                error: function(err) {
                    if (err.status == 400) {
                        Toast(2000).fire({
                            icon: 'error',
                            title: err.responseJSON.message
                        }).then((success) => {
                            window.location.href = err.responseJSON.url
                        })
                    }
                }
            })
        })
    </script>
@endpush
