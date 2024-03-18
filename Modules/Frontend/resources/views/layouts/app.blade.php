<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>Pondok Pesantren Al Fatich 2</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets-landing-page') }}/img/favicon.ico" rel="icon">
    <link href="{{ asset('assets-landing-page') }}/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets-landing-page') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets-landing-page') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('assets-landing-page') }}/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('assets-landing-page') }}/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('assets-landing-page') }}/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets-landing-page') }}/css/main.css" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    @include('frontend::layouts/navbar')
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    @stack('hero_section')
    <!-- End Hero Section -->

    <main id="main">
        @yield('content')
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('frontend::layouts/footer')
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    {{-- <div id="preloader"></div> --}}

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets-landing-page') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets-landing-page') }}/vendor/aos/aos.js"></script>
    <script src="{{ asset('assets-landing-page') }}/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('assets-landing-page') }}/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="{{ asset('assets-landing-page') }}/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets-landing-page') }}/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="{{ asset('assets-landing-page') }}/js/main.js"></script>
    <script type="text/javascript">
        function Toast(duration) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: duration,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            return Toast
        }

        function cleanNumber(number) {
            const cleaned = number.replace(/[^/d,-]/g, '');
            const integerNumber = parseInt(cleaned, 10);
            return integerNumber
        }
    </script>
    @stack('js')

</body>

</html>
