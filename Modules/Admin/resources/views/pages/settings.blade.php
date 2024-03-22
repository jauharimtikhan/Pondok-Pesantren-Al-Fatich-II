@extends('admin::layouts/app', ['activePage' => 'Halaman Pengaturan'])

@section('content')
    @include('admin::layouts/header')

    <div id="main-content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Pengaturan</h3>
                        <p class="text-subtitle text-danger">*Pastikan anda faham dengan pengaturan ini, Jika salah maka
                            website tidak akan berjalan dengan seharusnya</p>
                    </div>
                </div>
            </div>
        </div>

        <section class="section">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-core-setting-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-core-setting" type="button" role="tab"
                        aria-controls="pills-core-setting" aria-selected="true">Pengaturan
                        Utama</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-db-tab" data-bs-toggle="pill" data-bs-target="#pills-db"
                        type="button" role="tab" aria-controls="pills-db" aria-selected="false">Pengaturan
                        Database</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-umum-tab" data-bs-toggle="pill" data-bs-target="#pills-umum"
                        type="button" role="tab" aria-controls="pills-umum" aria-selected="false">Pengaturan
                        Umum</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                @include('admin::components/settings/setting-app')
                @include('admin::components/settings/setting-db')
                @include('admin::components/settings/etc')
            </div>
        </section>

    </div>
@endsection
