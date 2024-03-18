@extends('admin::layouts/app', ['activePage' => 'kegiatan'])

@section('content')
    @include('admin::layouts/header')
    <div id="main-content">

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Kegiatan Pondok</h3>
                        <p class="text-subtitle text-muted">Manajemen data kegiatan pondok pesantren Al Fatich 2</p>
                    </div>

                </div>
            </div>
            <section class="section">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tableKegiatan">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Gambar Kegiatan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </section>
        </div>

    </div>


    {{-- Modal Add --}}
    <div class="modal fade modal-borderless" id="modaladd" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" role="dialog" aria-labelledby="modaladdtitleid" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaladdtitleid">
                        Buat Kegiatan Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="form-add" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control">
                            <span class="text-danger nama_kegiatan"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="deskripsi_kegiatan" class="form-label">Deskripsi Kegiatan</label>
                            <div class="form-group with-title">
                                <label for="deskripsi_kegiatan">Masukan Deskripsi Kegiatan Di Sini</label>
                                <textarea class="form-control" name="deskripsi_kegiatan" id="deskripsi_kegiatan"></textarea>
                            </div>
                            <span class="text-danger deskripsi_kegiatan"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="gambar_kegiatan" class="form-label">Gambar Kegiatan</label>
                            <input type="file" name="gambar_kegiatan" id="gambar_kegiatan"
                                class="image-preview-filepond">
                            <span class="text-danger gambar_kegiatan"></span>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Kembali
                    </button>
                    <button type="submit" class="btn btn-primary">Buat</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade modal-borderless" id="modaledit" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" role="dialog" aria-labelledby="modaledittitleid" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaledittitleid">
                        Update Kegiatan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="form-edit" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_kegiatan_edit" id="id_edit">
                        <div class="form-group mb-3">
                            <label for="nama_kegiatan_edit" class="form-label">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan_edit" id="nama_kegiatan_edit" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="deskripsi_kegiatan_edit" class="form-label">Deskripsi Kegiatan</label>
                            <div class="form-group with-title">
                                <label for="deskripsi_kegiatan_edit">Masukan Deskripsi Kegiatan Di Sini</label>
                                <textarea class="form-control" name="deskripsi_kegiatan_edit" id="deskripsi_kegiatan_edit"></textarea>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="gambar_kegiatan_edit" class="form-label">Gambar Kegiatan</label>
                            <input type="file" name="gambar_kegiatan_edit" id="gambar_kegiatan_edit"
                                class="image-preview-filepond">
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
@push('css')
    <style>
        .custom-image-kegiatan {
            width: 30%;
            height: 30%;
            border-radius: 10px;
        }
    </style>
@endpush
@push('js')
    <script>
        getKegiatan();
        let table = $('#tableKegiatan').DataTable({
            lengthChange: false,
            responsive: true,
            layout: {
                topStart: {
                    buttons: [{
                        text: 'Buat Kegiatan Baru',
                        className: 'btn btn-primary',
                        action: function(e, dt, node, config) {
                            $('#modaladd').modal('show');
                        }
                    }]
                }
            },
        })

        function getKegiatan() {
            $.ajax({
                url: '{{ route('kegiatan.get') }}',
                method: 'get',
                success: function(res) {
                    if (res.statusCode == 200) {
                        let dt = []
                        table.clear();
                        $.each(res.data, (key, val) => {
                            let id = val.id;
                            let nama = val.name;
                            let image =
                                `<img src="${val.image}" alt="gambar kegiatan pondok" class=" custom-image-kegiatan" />`;
                            let btn = `<div class="d-flex justify-content-center" style="gap: 9px;">
                                                <button type="button" data-id="${id}"
                                                    class="btn btn-warning btn-sm text-white" onclick="edit(this)"><i
                                                        class="bi bi-pencil-square"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-id="${id}" onclick="deleteData(this)"><i
                                                        class="bi bi-trash3-fill"></i></button>
                                            </div>`;
                            dt = [key + 1, nama, image, btn]
                            table.rows.add([dt]).draw();
                        })
                    }
                },
                error: function(err) {}
            })
        }


        $('.form-add').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('kegiatan.add') }}',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('button[type="submit"]').text('Loading...').attr('disabled', 'disabled')
                },
                success: function(res) {
                    if (res.statusCode == 200) {
                        Toast(res.message, 'success').then((success) => {
                            getKegiatan()
                            $('#nama_kegiatan').val('')
                            $('#deskripsi_kegiatan').val('')
                            $('#gambar_kegiatan').val('')
                        })
                    }
                },
                complete: function() {
                    $('button[type="submit"]').text('Buat').removeAttr('disabled', 'disabled')
                },
                error: function(err) {
                    console.log({
                        err
                    });
                    if (err.status == 422) {
                        $('span.text-danger').text('');
                        $.each(err.responseJSON.errors, function(key, val) {
                            $('span.' + key).text(val[0]);
                        })
                    }
                }
            })
        })

        const edit = (el) => {
            let id = $(el).data('id');
            $('#id_edit').val(id)
            $('#modaledit').modal('show')
            $.ajax({
                url: '{{ route('kegiatan.getById', ':id') }}'.replace(':id', id),
                method: 'get',
                success: function(res) {
                    let data = res.data
                    $('#nama_kegiatan_edit').val(data.name)
                    $('#deskripsi_kegiatan_edit').val(data.description)
                    FilePond.create(document.querySelector("#gambar_kegiatan_edit"), {
                        credits: null,
                        allowImagePreview: true,
                        allowImageFilter: false,
                        allowImageExifOrientation: false,
                        allowImageCrop: false,
                        acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg", "image/webp"],
                        fileValidateTypeDetectType: (source, type) =>
                            new Promise((resolve, reject) => {
                                resolve(type);
                            }),
                        storeAsFile: true,
                    }).addFile(`{{ asset('${data.image}') }}`)
                }
            })
        }

        $('.form-edit').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('kegiatan.update') }}',
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
                            getKegiatan()
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
                        url: '{{ route('kegiatan.delete', ':id') }}'.replace(':id', id),
                        method: 'delete',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            if (res.statusCode == 200) {
                                Toast(res.message, 'success').then((success) => {
                                    getKegiatan()
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
