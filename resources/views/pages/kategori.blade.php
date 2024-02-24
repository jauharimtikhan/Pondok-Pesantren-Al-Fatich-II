@extends('layouts.app', ['activePage' => 'kategori'])

@section('content')
    @include('layouts.header')
    <div id="main-content">

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Kategori Artikel</h3>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        <section class="section">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="tableKategoriPost">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Kategori</th>
                            <th class="text-center" width="20%">Actions</th>
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
        $('#mnPost').addClass('active')
        $('#mnSubKategoriPost').addClass('active')

        let table = $('#tableKategoriPost').DataTable({
            lengthChange: false,
            responsive: true,
            layout: {
                topStart: {
                    buttons: [{
                        text: 'Tambah Kategori',
                        className: 'btn btn-primary',
                        action: function(e, dt, node, config) {
                            $('#modaladd').modal('show');
                        }
                    }]
                }
            },
        })
    </script>
@endpush
