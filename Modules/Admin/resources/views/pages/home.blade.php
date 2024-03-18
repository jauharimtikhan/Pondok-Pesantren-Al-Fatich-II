@extends('admin::layouts\app', ['activePage' => 'home'])

@section('content')
    @include('admin::layouts\header')
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
        </section>

    </div>
@endsection
@push('js')
    <script></script>
@endpush
