@extends('admin::layouts/app', ['activePage' => 'home'])

@section('content')
    @include('admin::layouts/header')
    <div id="main-content">

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Dashboard</h3>
                    </div>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="">Target Dana <i class="bi bi-coin" style="font-size: 40px; "></i></h2>
                            <h3 class="mt-3">Rp. 6.000.000.000</h3>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h2>Dana Terkumpul <i class="bi bi-wallet-fill" style="font-size: 40px"></i></h2>
                            <h3 class="mt-3">{{ convertRp($earn[0]->total) }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Grafik Donatur</h5>
                </div>
                <div class="card-body">
                    <div style="width: 80%; margin: auto;">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
@push('js')
    <script>
        let ctx = document.getElementById('barChart').getContext('2d');

        $.ajax({
            url: '{{ route('home.get.donaturs.chart') }}',
            method: 'GET',
            success: function(res) {
                let dt = []
                let to = []
                $.each(res.data, function(key, val) {
                    dt.push(key)
                    to.push(val)
                })
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: dt,
                        datasets: [{
                            label: 'Total Donatur',
                            data: to,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                suggestedMax: 100
                            }
                        },

                    }
                });
            },
            error: function(err) {
                console.log(err);
            }
        })
    </script>
@endpush
