@extends('frontend::layouts/app')
@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center" style="background-image: url('');">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2>Wakaf Sekarang</h2>

                    </div>
                </div>
            </div>
        </div>
        <nav>
            <div class="container">
                <ol>
                    <li><a href="{{ route('/') }}">Beranda</a></li>
                    <li>Wakaf Sekarang</li>
                </ol>
            </div>
        </nav>
    </div>

    <section class="form-wakaf">
        <div class="container" data-aos="fade-up">
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="card-form-wakaf">
                        <div class="card-header-form-wakaf">
                            <h2 id="total">{{ convertRp($total_prices[0]->total) }}</h2>
                        </div>
                        <div class="d-flex align-items-center justify-content-end my-2">
                            <div class="form-wakaf-counter">
                                <button type="button" class="btn btn-new-primary" id="btnMin"><i
                                        class="bi bi-dash"></i></button>
                                <input type="number" class="form-wakaf-counter-stats" id="totalCounter">
                                <button type="button" class="btn btn-new-primary" id="btnAdd"><i
                                        class="bi bi-plus"></i></button>
                            </div>
                        </div>
                        <div class="card-body-form-wakaf row mt-3">
                            @foreach ($paket_wakafs as $paket)
                                <div class="col-12 my-1" style="cursor: pointer" onclick="changeTotal({{ $paket->price }})">
                                    <div class="form-wakaf-paket-list">
                                        <h3>{{ $paket->name }}</h3>
                                        <h3>{{ convertRp($paket->price) }}</h3>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer-form-wakaf mt-4">
                            <button type="button" class="btn btn-new-primary btn-lg" style="width: 80%"
                                id="btnNext">Lanjut</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card-form-wakaf">
                        <div class="sidebar">
                            <div class="sidebar-item">
                                <h2 class="text-center mb-3">Informasi Wakaf</h2>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span>Target Wakaf :</span> <span id="targetWakaf"></span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span>Total Donatur :</span> <span id="totalDonatur"></span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span>Total Terkumpul :</span> <span id="totalTerkumpul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modalSubmit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="form-checkout-wakaf">
                        @csrf
                        <input type="hidden" name="total" id="totalWakaf">
                        <input type="hidden" name="wakaf_id" value="{{ $targets[0]->id }}" id="wakaf_id">
                        <div class="form-group mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" id="nama" class="form-control" required>
                            <span class="text-danger nama"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="no_hp" class="form-label">No. Whatsapp</label>
                            <input type="number" name="phone" id="no_hp" class="form-control" required>
                            <span class="text-danger no_hp"></span>
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
        const btnAdd = $('#btnAdd');
        const btnMin = $('#btnMin');
        const totalCounter = $('#totalCounter');
        const total = $('#total');
        let snap_token = ""


        const totalNumber = cleanNumber(total.text());
        totalCounter.val(totalNumber / totalNumber);
        $('#totalWakaf').val(cleanNumber(total.text()));
        const formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        });
        $('#targetWakaf').text(formatDonatur({{ $targets[0]->target }}));
        $('#totalDonatur').text(formatDonatur({{ $totalDonaturs }} + " orang"));

        const lastAmount = '{{ $targets[0]->last_amount }}';
        if (lastAmount) {
            $('#totalTerkumpul').text(formatDonatur({{ $targets[0]->last_amount }}));
        } else {
            $('#totalTerkumpul').text('Rp. 0');
        }


        btnAdd.on('click', () => {
            totalCounter.val(parseInt(totalCounter.val()) + 1);
            const jumlahakhir = parseInt(totalCounter.val()) * 300000
            total.text(formatter.format(jumlahakhir));
            $('#totalWakaf').val(jumlahakhir);
        })

        btnMin.on('click', () => {
            const total = parseInt(totalCounter.val())
            if (total > 1) {
                totalCounter.val(parseInt(totalCounter.val()) - 1);
                const jumlahakhir = parseInt(totalCounter.val()) * 300000;
                $('#total').text(formatter.format(jumlahakhir));
                $('#totalWakaf').val(jumlahakhir);
            }
        })


        function changeTotal(totals) {
            total.text(formatter.format(totals))
            totalCounter.val(totals / 300000)
            $('#totalWakaf').val(totals);
        }

        totalCounter.on('keyup', () => {
            if (totalCounter.val() > 1) {
                changeTotal(totalNumber * totalCounter.val())
            } else {
                changeTotal(totalNumber)
            }
        })



        $('#btnNext').click(() => {
            $('#modalSubmit').modal('show')
        })

        $('.form-checkout-wakaf').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ getenv('API_URL') }}payment',
                method: 'post',
                async: true,
                headers: {
                    'Authorization': 'Bearer {{ getenv('API_KEY') }}'
                },
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('button[type="submit"]').prop('disabled', true);
                    $('button[type="submit"]').text('Loading...');

                },
                success: function(data) {
                    if (data.statusCode == 200) {
                        $('#modalSubmit').modal('hide');
                    }
                    snap.pay(data.snap_token, {
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
                            // console.log(result);
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
                },
                complete: function() {
                    $('button[type="submit"]').prop('disabled', false);
                    $('button[type="submit"]').text('Lanjut');
                },
                error: function(data) {
                    if (data.status == 400) {
                        Toast(2000).fire({
                            icon: 'error',
                            title: data.responseJSON.message
                        }).then((success) => {
                            window.location.href = data.responseJSON.url
                        })
                    }
                }
            })
        })

        function formatDonatur(number) {
            let result = "";

            if (number >= 1000000000) {
                const billion = Math.floor(number / 1000000000);
                const million = Math.round((number % 1000000000) / 1000000);
                if (million === 0) {
                    result = `${billion} M`;
                } else {
                    result = `${billion}.${million} M`;
                }
            } else if (number >= 1000000) {
                const million = Math.floor(number / 1000000);
                const thousand = Math.round((number % 1000000) / 100000);
                if (thousand === 0) {
                    result = `${million} JT`;
                } else {
                    result = `${million}.${thousand} JT`;
                }
            } else if (number >= 1000) {
                const thousand = Math.floor(number / 1000);
                result = `${thousand} K`;
            } else {
                result = `${number}`;
            }

            return result;
        }

        function deleteTransaction(id) {
            $.ajax({
                url: '{{ getenv('API_URL') }}payment/delete_transaction/' + id,
                method: 'post',
                headers: {
                    'Authorization': 'Bearer {{ getenv('API_KEY') }}'
                },
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {

                }
            })
        }
    </script>
@endpush
