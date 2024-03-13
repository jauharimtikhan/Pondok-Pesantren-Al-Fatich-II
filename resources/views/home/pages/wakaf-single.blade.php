@extends('home.layouts.app')
@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center" style="background-image: url('');">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2>Detail Wakaf</h2>
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <div class="container">
                <ol>
                    <li><a href="{{ route('/') }}">Beranda</a></li>
                    <li><a href="{{ route('wakaf.landing_page') }}">Wakaf</a></li>
                    <li>Detail Wakaf</li>
                </ol>
            </div>
        </nav>
    </div><!-- End Breadcrumbs -->

    <section class="wakaf">
        <div class="container" data-aos="fade-up">
            <div class="row g-5">
                <div class="col-lg-8">

                    <article class="wakaf-details">

                        <div class="post-img">
                            <img src="{{ asset('/') . $details_wakaf[0]->image }}" alt="" class="img-fluid">
                        </div>

                        <h2 class="title">{{ $details_wakaf[0]->name }}</h2>


                        <div class="content">
                            <p>
                                {{ $details_wakaf[0]->description }}
                            </p>

                            <blockquote>
                                <p>
                                    Iklan Google Ads
                                </p>
                            </blockquote>
                            <h2>Benefit</h2>
                            <p>
                                {{ $details_wakaf[0]->benefit }}
                            </p>


                        </div>

                    </article>

                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-item">
                            <h2 class="text-center mb-3">Informasi Wakaf</h2>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span>Target Wakaf : </span>&nbsp; <span id="targetWakaf"></span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span>Total Donatur : </span>&nbsp; <span id="totalDonatur"> </span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span>Total Terkumpul : </span>&nbsp; <span id="totalTerkumpul"></span>
                            </div>
                            <div class="d-flex aligin-items-center justify-content-center">
                                <a href="{{ route('wakaf.landing_page.form', $details_wakaf[0]->id) }}"
                                    class="btn btn-new-primary btn-lg">Donasi
                                    Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script type="text/javascript">
        $('#targetWakaf').text(formatDonatur({{ $details_wakaf[0]->target }}));
        const totalTerkumpul = '{{ $details_wakaf[0]->last_amount }}';

        if (totalTerkumpul) {
            $('#totalTerkumpul').text(formatDonatur({{ $details_wakaf[0]->last_amount }}));
        } else {
            $('#totalTerkumpul').text('Rp. 0');
        }
        $('#totalDonatur').text(formatDonatur({{ $totalDonaturs }} + " orang"));

        function formatDonatur(number) {
            let result = "";

            if (number >= 1000000000) {
                const billion = Math.floor(number / 1000000000);
                const million = Math.round((number % 1000000000) / 1000000);
                if (million === 0) {
                    result = `${billion}M`;
                } else {
                    result = `${billion}.${million}M`;
                }
            } else if (number >= 1000000) {
                const million = Math.floor(number / 1000000);
                const thousand = Math.round((number % 1000000) / 1000);
                if (thousand === 0) {
                    result = `${million}JT`;
                } else {
                    result = `${million}.${thousand}JT`;
                }
            } else if (number >= 1000) {
                const thousand = Math.floor(number / 1000);
                result = `${thousand}K`;
            } else {
                result = `${number}`;
            }

            return result;
        }
    </script>
@endpush
