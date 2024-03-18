<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Al Fatih Admin Panel</title>
    <link rel="shortcut icon" href="{{ asset('assets-landing-page/img/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets-landing-page/img/favicon.ico') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets') }}/compiled/css/app.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/compiled/css/app-dark.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/compiled/css/auth.css">
    <script src="{{ asset('assets') }}/static/js/initTheme.js"></script>
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-12 col-12 d-flex justify-content-center align-items-center">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="#" class="h2">Al Fatih</a>
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">Silahkan login menggunakan data yang anda daftarkan.</p>

                    <form action="{{ route('login') }}" method="POST" autofill="off">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="email" class="form-control form-control-xl"
                                placeholder="email" value="{{ old('email') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>

                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl"
                                placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password')
                                <span class="text-danger password">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="showpass">
                            <label class="form-check-label text-gray-600" for="showpass">
                                Tampilkan Password
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-md">
                        <p class="text-gray-600">Belum Punya Akun? <a href="{{ route('register') }}"
                                class="font-bold">Registrasi</a>.
                        </p>
                        <p><a class="font-bold" href="auth-forgot-password.html">Lupa Password?</a>.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#showpass').on('change', function() {
                if ($(this).is(':checked')) {
                    $('input[name="password"]').attr('type', 'text');
                } else {
                    $('input[name="password"]').attr('type', 'password');
                }
            })

        })
    </script>
    @error('error')
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: 'error',
                title: '{{ $message }}'
            });
        </script>
    @enderror

    @if (session('msg_success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: 'success',
                title: '{{ session('msg_success') }}'
            });
        </script>
    @endif
</body>

</html>
