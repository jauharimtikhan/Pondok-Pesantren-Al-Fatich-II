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


    {{-- Modal Add --}}
    <div class="modal fade modal-borderless" id="modaladd" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" role="dialog" aria-labelledby="modaladdtitle" aria-hidden="true">
        <div class="modal-dialog  modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaladdtitle">
                        Tambah kategori artikel
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="form-add">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nama Kategori</label>
                            <input type="text" name="name" id="name" class="form-control">
                            <span class="text-danger name"></span>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Kembali
                    </button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}

    <div class="modal fade modal-borderless" id="modaledit" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" role="dialog" aria-labelledby="modaledittitle" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaledittitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="form-edit">
                        @csrf
                        <input type="hidden" name="id" id="idedit">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nama Kategori</label>
                            <input type="text" name="name" id="nameedit" class="form-control">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Kembali
                    </button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('#mnPost').addClass('active')
        $('#mnSubKategoriPost').addClass('active')
        getCategories()
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

        function getCategories() {
            $.ajax({
                url: '{{ route('kategori.get') }}',
                method: 'get',
                success: function(res) {
                    let dt = [];
                    table.clear();
                    $.each(res.data, function(i, key) {
                        let id = key.id;
                        let name = key.name;
                        let btn = `<div class="d-flex justify-content-center" style="gap: 9px;">
                                                <button type="button" data-id="${id}"
                                                    class="btn btn-warning btn-sm text-white" onclick="edit(this)"><i
                                                        class="bi bi-pencil-square"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-id="${id}" onclick="deleteData(this)"><i
                                                        class="bi bi-trash3-fill"></i></button>
                                            </div>`
                        dt = [i + 1, name, btn]
                        table.rows.add([dt]).draw();
                    })
                }
            })
        }

        $('.form-add').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('kategori.add') }}',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('button[type=submit]').attr('disabled', 'disabled');
                },
                success: function(res) {
                    if (res.statusCode == 201) {
                        Toast(res.message, 'success').then((success) => {
                            getCategories();
                        });
                    }
                },
                complete: function() {
                    $('button[type=submit]').removeAttr('disabled', 'disabled');
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

        $('.form-edit').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('kategori.edit') }}',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('button[type="submit"]').attr('disabled', 'disabled');
                },
                success: function(res) {
                    if (res.statusCode == 200) {
                        Toast(res.message, 'success').then((success) => {
                            getCategories();
                        })
                    }
                },
                complete: function() {
                    $('button[type="submit"]').removeAttr('disabled', 'disabled');
                },
                error: function(err) {
                    Toast(err.responseJSON.message, 'error');
                }
            })
        })

        function edit(el) {
            let id = $(el).data('id');
            $('#modaledit').modal('show');
            $.ajax({
                url: '{{ route('kategori.getById', ':id') }}'.replace(':id', id),
                method: 'get',
                success: function(res) {
                    // console.log(res);
                    $.each(res.data, function(key, val) {
                        $('#idedit').val(val.id);
                        $('#modaledittitle').text('Edit Kategori ' + val.name);
                        $('#nameedit').val(val.name);

                    })
                }
            })
        }

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
                        url: '{{ route('kategori.delete', ':id') }}'.replace(':id', id),
                        method: 'delete',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            if (res.statusCode == 200) {
                                Toast(res.message, 'success').then((success) => {
                                    getCategories();
                                })
                            }
                        },
                        error: function(err) {
                            Toast(err.responseJSON.message, 'error');
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
