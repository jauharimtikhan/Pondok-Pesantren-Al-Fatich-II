@extends('layouts.app', ['activePage' => 'home'])

@section('content')
    @include('layouts.header')
    <div id="main-content">

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Paket Wakaf</h3>
                    </div>

                </div>
            </div>
        </div>
        <section class="section">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="tablePaketWakaf">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Paket</th>
                            <th>To</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>


        </section>

    </div>

    {{-- Modal Add --}}
    <div class="modal fade modal-borderless" id="modaladd" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalAddTitle" aria-hidden="true">
        <div class="modal-dialog  modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddTitle">
                        Buat Paket Wakaf
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="form-add" autocomplete="off">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nama_paket" class="form-label">Nama Paket</label>
                            <input type="text" name="nama_paket" id="nama_paket" class="form-control">
                            <span class="text-danger nama_paket"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="harga_paket" class="form-label">Harga Paket</label>
                            <input type="text" data-prefix="Rp. " name="harga_paket" id="harga_paket"
                                class="form-control">
                            <span class="text-danger harga_paket"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="harga_kelipatan_paket" class="form-label">Kelipatan Paket</label>
                            <input type="text" data-prefix="Rp. " name="harga_kelipatan_paket" id="harga_kelipatan_paket"
                                class="form-control">
                            <span class="text-danger harga_kelipatan_paket"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="campaign_wakaf" class="form-label">Campaign Wakaf</label>
                            <select name="campaign_wakaf" id="campaign_wakaf" class="form-select"></select>
                            <span class="text-danger campaign_wakaf"></span>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Kembali
                    </button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal Edit --}}

    {{-- Modal Add --}}
    <div class="modal fade modal-borderless" id="modaledit" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" role="dialog" aria-labelledby="modalEditTitle" aria-hidden="true">
        <div class="modal-dialog  modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle">
                        Edit Paket Wakaf
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="form-edit" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id_paket_edit" id="id_paket_edit">
                        <div class="form-group mb-3">
                            <label for="nama_paket_edit" class="form-label">Nama Paket</label>
                            <input type="text" name="nama_paket_edit" id="nama_paket_edit" class="form-control">
                            <span class="text-danger nama_paket"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="harga_paket_edit" class="form-label">Harga Paket</label>
                            <input type="text" data-prefix="Rp. " name="harga_paket_edit" id="harga_paket_edit"
                                class="form-control">
                            <span class="text-danger harga_paket"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="harga_kelipatan_paket_edit" class="form-label">Kelipatan Paket</label>
                            <input type="text" data-prefix="Rp. " name="harga_kelipatan_paket_edit"
                                id="harga_kelipatan_paket_edit" class="form-control">
                            <span class="text-danger harga_paket"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="campaign_wakaf_edit" class="form-label">Campaign Wakaf</label>
                            <select name="campaign_wakaf_edit" id="campaign_wakaf_edit" class="form-select"></select>
                            <span class="text-danger campaign_wakaf"></span>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Kembali
                    </button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal Edit --}}
@endsection
@push('js')
    <script>
        $(document).ready(function() {



            $('#mnWakaf').addClass('active')
            $('#mnWakafs').addClass('active')
            $('#mnPaketWakafs').addClass('active')
            $('#harga_paket').maskMoney()
            $('#harga_kelipatan_paket').maskMoney()

        })

        let table = $('#tablePaketWakaf').DataTable({
            lengthChange: false,
            responsive: true,
            layout: {
                topStart: {
                    buttons: [{
                        text: 'Buat Paket Wakaf',
                        className: 'btn btn-primary',
                        action: function(e, dt, node, config) {
                            $('#modaladd').modal('show')
                            getWakaf()
                        }
                    }]
                }
            },
            "ajax": {
                "url": '{{ route('paket_wakaf.get') }}',
                "method": 'get',
                "success": function(res) {
                    let dt = [];
                    table.clear()
                    $.each(res.data, function(i, key) {
                        let id = key.id;
                        let name = key.nama_paket;
                        let to = key.name;
                        let btn = `<div class="d-flex justify-content-center" style="gap: 9px;">
                                        <button type="button" data-id="${id}"
                                            class="btn btn-warning btn-sm text-white" onclick="edit(this)"><i
                                                class="bi bi-pencil-square"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            data-id="${id}" onclick="deleteData(this)"><i
                                                class="bi bi-trash3-fill"></i></button>
                                    </div>`;
                        dt = [i + 1, name, to, btn];
                        table.rows.add([dt]);
                    });
                    table.draw();
                }
            },
            "drawCallback": function() {
                $('#tablePaketWakaf tbody td').addClass('text-truncate');
            }
        })

        function getWakaf() {
            $.ajax({
                url: '{{ route('wakaf.get') }}',
                method: 'get',
                success: function(res) {
                    let Wakafs = {}

                    $('#campaign_wakaf').append(
                        $('<option>').text('--Pilih Campaign Wakaf--').val('')
                    )
                    $.each(res.data, function(i, key) {
                        $('#campaign_wakaf').append(
                            $('<option class="text-truncate">').text(key.name).val(key.id)
                        )
                        $('#campaign_wakaf_edit').append(
                            $('<option class="text-truncate">').text(key.name).val(key.id)
                        )
                    })
                },
                complete: function() {
                    new Choices($('#campaign_wakaf')[0], {
                        allowHTML: true,
                        noResultsText: 'Tidak Ada Hasil',
                        noChoicesText: 'Tidak Ada Pilihan ',
                        itemSelectText: 'Tekan Untuk Memilih',
                    })


                }
            })
        }

        $('.form-add').submit(function(e) {
            e.preventDefault();
            const hP = $('#harga_paket').maskMoney()
            const harga_paket = cleanMaskMoney(hP)
            const hKp = $('#harga_kelipatan_paket').maskMoney()
            const harga_kelipatan_paket = cleanMaskMoney(hKp)

            $.ajax({
                url: '{{ route('paket_wakaf.add') }}',
                method: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    nama_paket: $('#nama_paket').val(),
                    harga_paket: harga_paket,
                    harga_kelipatan_paket: harga_kelipatan_paket,
                    campaign_wakaf: $('#campaign_wakaf').val(),
                },
                beforeSend: function() {
                    $('button[type="submit"]').attr('disabled', 'disabled')
                },
                success: function(res) {
                    if (res.statusCode == 200) {
                        Toast(res.message, 'success').then((success) => {
                            table.ajax.reload()
                        })
                    }
                },
                complete: function() {
                    $('button[type="submit"]').removeAttr('disabled', 'disabled')
                },
                error: function(err) {
                    if (err.status == 422) {
                        $('span.text-danger').text('')
                        $.each(err.responseJSON.errors, function(prefix, val) {
                            $(`.${prefix}`).text(val)
                        })
                    } else {
                        Toast(err.responseJSON.message, 'error')
                    }
                }
            })
        })

        function edit(el) {
            let id = $(el).data('id')
            $('#modaledit').modal('show')
            $.ajax({
                url: '{{ route('paket_wakaf.getById', ':id') }}'.replace(':id', id),
                method: 'get',
                success: function(res) {
                    getWakaf()
                    $('#id_paket_edit').val(id)
                    $.each(res.data, function(i, val) {
                        $('#nama_paket_edit').val(val.nama_paket)
                        $('#harga_paket_edit').val(val.harga)
                        $('#harga_kelipatan_paket_edit').val(val.multiple_price)
                        $('#campaign_wakaf_edit option[value="' + val.id_wakaf + '"]').prop('selected',
                            true);
                    })
                    $('#harga_paket_edit').maskMoney()
                    $('#harga_kelipatan_paket_edit').maskMoney()
                }
            })
        }

        $('.form-edit').submit(function(e) {
            e.preventDefault();
            const hP = $('#harga_paket_edit').maskMoney()
            const harga_paket = cleanMaskMoney(hP)
            const hKp = $('#harga_kelipatan_paket_edit').maskMoney()
            const harga_kelipatan_paket = cleanMaskMoney(hKp)
            $.ajax({
                url: '{{ route('paket_wakaf.edit') }}',
                method: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    id_paket_edit: $('#id_paket_edit').val(),
                    nama_paket_edit: $('#nama_paket_edit').val(),
                    harga_paket_edit: harga_paket,
                    harga_kelipatan_paket_edit: harga_kelipatan_paket,
                    campaign_wakaf_edit: $('#campaign_wakaf_edit').val(),
                },

                beforeSend: function() {
                    $('button[type=submit]').attr('disabled', 'disabled');
                },
                success: function(res) {
                    if (res.statusCode == 200) {
                        Toast(res.message, 'success').then((success) => {
                            table.ajax.reload()
                        })
                    }
                },
                complete: function() {
                    $('button[type=submit]').removeAttr('disabled', 'disabled');
                },
                error: function(err) {
                    Toast(err.responseJSON.message, 'error')
                }
            })
        })

        function deleteData(el) {
            let id = $(el).data('id')


            const datas = {
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Tidak, Batalkan!',
                title: 'Apakah anda yakin?',
                text: 'Ingin menghapus data ini, Anda tidak dapat mengembalikannya!'
            }

            DeleteData(datas).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('paket_wakaf.delete', ':id') }}'.replace(':id', id),
                        method: 'delete',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            if (res.statusCode == 200) {
                                Toast(res.message, 'success').then((success) => {
                                    table.ajax.reload()
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
    </script>
@endpush
