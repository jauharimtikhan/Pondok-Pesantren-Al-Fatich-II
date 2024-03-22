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
                            <th>id</th>
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

        {{-- Modal Details --}}
        <div class="modal fade modal-borderless" id="modaledit" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" role="dialog" aria-labelledby="modaledittitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modaledittitle">
                            Detail Transaksi
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="shows"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Kembali
                        </button>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
@push('js')
    <script>
        getTransaction()
        let table = $('#tableTransaksi').DataTable({
            lengthChange: false,
            responsive: true,
            dom: 'Bfrtip',
            select: true,
            select: {
                style: 'multi'
            },
            buttons: [{
                extend: 'selected',
                text: `<i class="bi bi-trash-fill"></i> Hapus`,
                className: 'btn btn-danger',
                action: function(e, dt, node, config) {
                    let ids = []
                    dt.rows({
                        selected: true
                    }).data().each(function(row) {
                        ids.push(row[0])
                    })
                    bulkdelete(ids)
                }
            }]
        })

        function getTransaction() {
            $.ajax({
                url: '{{ route('transaction.get') }}',
                method: 'get',
                success: function(data) {
                    let dt = [];
                    table.clear()
                    $.each(data.data, function(i, key) {
                        let id = key.id;
                        let payment_id = key.payment_id;
                        let name = key.name;
                        let status = key.status;
                        let created_at = key.created_at;
                        let updated_at = key.updated_at;
                        let btn = `<div class="d-flex justify-content-center" style="gap: 9px;"> 
                                        <button type="button" data-id="${payment_id}" class="btn btn-warning btn-sm text-white" onclick="edit(this)"><i class="bi bi-eye-fill"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-id="${id}" onclick="deleteData(this)"><i
                                                class="bi bi-trash3-fill"></i></button>
                                    </div>`;

                        dt = [id, i + 1, name, status, created_at, updated_at, btn];
                        table.rows.add([dt]).draw();
                    })
                },
                complete: function() {
                    table.column(0).visible(false);
                }
            })
        }

        function edit(e) {
            let id = $(e).data('id');

            $.ajax({
                url: '{{ getenv('API_URL') }}' + 'payment_status?order_id=' + id,
                method: 'get',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                success: function(res) {
                    if (res.statusCode == 200) {
                        const data = res.data;
                        if (res.data.status_code == 404) {
                            Toast('Transaksi tidak ditemukan', 'error');
                            return
                        }
                        $('#modaledit').modal('show')
                        const payment_type = data.payment_type.replace('_', ' ');
                        let component = `<ul class="list-group list-group-flush">
                                            <li class="list-group-item my-1">Transaksi ID: ${data.order_id}</li>
                                            <li class="list-group-item my-1">Total Transaksi: ${formatRupiah(data.gross_amount)}</li>
                                            <li class="list-group-item my-1">Metode Pembayaran: ${payment_type}</li>
                                            <li class="list-group-item my-1">Bank: ${data.va_numbers[0].bank}</li>
                                            <li class="list-group-item my-1">No Rekening: ${data.va_numbers[0].va_number}</li>
                                            <li class="list-group-item my-1">Tanggal Transaksi Dibuat: ${data.transaction_time ?? '-'}</li>
                                            <li class="list-group-item my-1">Tanggal Transaksi ${data.transaction_status}: ${data.settlement_time ?? '-'}</li>
                                         </ul>`;
                        $('#shows').append(component);
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            })
        }

        function deleteData(el) {
            let id = $(el).data('id')


            const datas = {
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Tidak, Batalkan!',
                title: 'Apakah anda yakin?',
                text: 'Ingin menghapus data transaksi ini, Anda tidak dapat mengembalikannya!'
            }

            DeleteData(datas).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('transaction.delete', ':id') }}'.replace(':id', id),
                        method: 'delete',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            if (res.statusCode == 200) {
                                Toast(res.message, 'success').then((success) => {
                                    getTransaction()
                                })
                            }
                        }
                    })
                } else if (
                    result.dismis == Swal.DismissReason.Cancel
                ) {
                    Toast('Anda membatalkan tindakan!', 'info')
                }
            })
        }

        function bulkdelete(id) {
            const datas = {
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Tidak, Batalkan!',
                title: 'Apakah anda yakin?',
                text: 'Ingin menghapus data transaksi ini, Anda tidak dapat mengembalikannya!'
            }

            DeleteData(datas).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('transaction.bulkDelete') }}',
                        method: 'post',
                        data: {
                            _token: '{{ csrf_token() }}',
                            ids: id
                        },
                        success: function(res) {
                            if (res.statusCode == 200) {
                                Toast(res.message, 'success').then((success) => {
                                    getTransaction()
                                })
                            }
                        },
                        error: function(err) {
                            if (err.status == 500) {
                                Toast(err.responseJSON.message, 'error');
                            }
                        }
                    })
                } else if (
                    result.dismis == Swal.DismissReason.Cancel
                ) {
                    Toast('Anda membatalkan tindakan!', 'info')
                }
            })

        }
    </script>
@endpush
