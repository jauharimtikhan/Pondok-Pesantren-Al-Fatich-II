@extends('admin::layouts/app', ['activePage' => 'transaksi'])

@section('content')
    @include('admin::layouts/header')
    <div id="main-content">

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Transaksi</h3>
                    </div>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="tableTransaksi">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                            <th>Tanggal Diupdate</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

        </section>

    </div>
@endsection
@push('js')
    <script>
        let table = $('#tableTransaksi').DataTable({
            lengthChange: false,
            responsive: true,
        })
    </script>
@endpush
