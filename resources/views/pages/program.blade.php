@extends('layouts.app', ['activePage' => 'program'])

@section('content')
    @include('layouts.header')
    <div id="main-content">

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Program</h3>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tableProgram">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Program</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>

    {{-- Modal Add Program --}}
    <div class="modal fade modal-borderless" id="modaladd" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" role="dialog" aria-labelledby="modaladdtitleid" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaladdtitleid">
                        Buat Program Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="form-add">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nama_program" class="form-label">Nama Program</label>
                            <input type="text" name="nama_program" id="nama_program" class="form-control">
                            <span class="text-danger nama_program"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status_program" class="form-label">Status Program</label>
                            <input type="text" name="status_program" id="status_program" class="form-control">
                            <span class="text-danger status_program"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="link_program" class="form-label">Link Program</label>
                            <input type="text" name="link_program" id="link_program" class="form-control">
                            <span class="text-danger link_program"></span>
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

    {{-- Modal Edit Program --}}
    <div class="modal fade modal-borderless" id="modaledit" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" role="dialog" aria-labelledby="modaledittitleid" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaledittitleid">
                        Edit Program
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="form-edit">
                        @csrf
                        <input type="hidden" name="id_edit" id="id_edit">
                        <div class="form-group mb-3">
                            <label for="nama_program_edit" class="form-label">Nama Program</label>
                            <input type="text" name="nama_program_edit" id="nama_program_edit" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="status_program_edit" class="form-label">Status Program</label>
                            <input type="text" name="status_program_edit" id="status_program_edit"
                                class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="link_program_edit" class="form-label">Link Program</label>
                            <input type="text" name="link_program_edit" id="link_program_edit" class="form-control">
                            <span class="text-danger link_program"></span>
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
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            getProgram()
        })
        let table = $('#tableProgram').DataTable({
            lengthChange: false,
            responsive: true,
            layout: {
                topStart: {
                    buttons: [{
                        text: 'Buat Program',
                        className: 'btn btn-primary',
                        action: function(e, dt, node, config) {
                            $('#modaladd').modal('show');
                        }
                    }]
                }
            },
        })

        function getProgram() {
            $.ajax({
                url: '{{ route('program.get') }}',
                method: 'get',
                success: function(res) {
                    let dt = [];
                    table.clear();
                    $.each(res.data, function(i, v) {
                        // console.log(v);
                        let id = v.id;
                        let nama = v.name;
                        let btn = `<div class="d-flex justify-content-center" style="gap: 9px;">
                                        <button type="button" data-id="${id}"
                                            class="btn btn-warning btn-sm text-white" onclick="edit(this)"><i
                                                class="bi bi-pencil-square"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            data-id="${id}" onclick="deleteData(this)"><i
                                                class="bi bi-trash3-fill"></i></button>
                                    </div>`;
                        dt = [i + 1, nama, btn];
                        table.rows.add([dt]).draw();
                    })
                }
            })
        }

        $('.form-add').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('program.add') }}',
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
                            getProgram()
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

        function edit(el) {
            let id = $(el).data('id');
            $('#modaledit').modal('show')
            $.ajax({
                url: '{{ route('program.getById', ':id') }}'.replace(':id', id),
                method: 'get',
                success: function(res) {
                    $.each(res.data, function(i, v) {
                        $('#id_edit').val(v.id);
                        $('#nama_program_edit').val(v.name);
                        $('#status_program_edit').val(v.status);
                        $('#link_program_edit').val(v.link);
                    })
                }
            })
        }

        $('.form-edit').submit(function(e) {
            e.preventDefault()
            $.ajax({
                url: '{{ route('program.edit') }}',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('button[type="submit"]').attr('disabled', 'disabled')
                },
                success: function(res) {
                    if (res.statusCode == 200) {
                        Toast(res.message, 'success').then((success) => {
                            getProgram()
                        })
                    }
                },
                complete: function() {
                    $('button[type="submit"]').removeAttr('disabled', 'disabled')
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
                        url: '{{ route('program.delete', ':id') }}'.replace(':id', id),
                        method: 'delete',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            if (res.statusCode == 200) {
                                Toast(res.message, 'success').then((success) => {
                                    getProgram()
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
