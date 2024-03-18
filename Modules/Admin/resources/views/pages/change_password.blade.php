@extends('admin::layouts\app', ['activePage' => 'Setting'])

@section('content')
    @include('admin::layouts\header')
    <div id="main-content">

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Ubah Password</h3>
                    </div>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ubah Password</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post" class="form-update">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="password_sekarang" class="form-label">Password Sekarang</label>
                            <input type="password" name="password_sekarang" id="password_sekarang" class="form-control">
                            <span class="text-danger password_sekarang"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_baru" class="form-label">Password Baru</label>
                            <input type="password" name="password_baru" id="password_baru" class="form-control">
                            <span class="text-danger password_baru"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="konfirmasi_password_baru" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="konfirmasi_password_baru" id="konfirmasi_password_baru"
                                class="form-control">
                            <span class="text-danger konfirmasi_password_baru"></span>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="showpass">
                            <label class="form-check-label" for="showpass">
                                Tampilkan Password
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary float-end">Ubah Password</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $('#showpass').on('change', function() {
            if ($(this).is(':checked')) {
                $('input[type="password"]').attr('type', 'text');
            } else {
                $('input[type="text"]').attr('type', 'password');

            }
        })

        $('.form-update').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('settings.change_password.store') }}',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('button[type="submit"]').attr('disabled', 'disabled')
                },
                success: function(res) {
                    if (res.statusCode == 200) Toast(res.message, 'success').then((success) => {
                        window.location.href = res.redirect
                    })
                },
                complete: function() {
                    $('button[type="submit"]').removeAttr('disabled')
                },
                error: function(err) {
                    if (err.status == 422) {
                        $('span.text-danger').text('');
                        $.each(err.responseJSON.errors, function(prefix, val) {
                            $('.' + prefix).text(val[0]);
                        })
                    } else {
                        Toast(err.responseJSON.message, 'error');
                    }
                }
            })
        })
    </script>
@endpush
