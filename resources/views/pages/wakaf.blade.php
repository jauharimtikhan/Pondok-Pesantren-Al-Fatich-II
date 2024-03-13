@extends('layouts.app', ['activePage' => 'wakaf'])

@section('content')
    @include('layouts.header')
    <div id="main-content">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Wakaf</h3>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <section class="section">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="tableWakaf">
                    <thead>
                        <tr>
                            <th class="text-center" width="10%">No</th>
                            <th>Judul Wakaf</th>
                            <th>Target Wakaf</th>
                            <th>Uang Terkumpul</th>
                            <th>Tanggal Dibuat</th>
                            <th class="text-center" width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </section>
    </div>

    {{-- Modal Add Wakaf --}}
    <div class="modal fade modal-borderless" id="modaladd" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" role="dialog" aria-labelledby="modaladdtitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaladdtitle">
                        Buat Campaign Wakaf
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="form-add" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="judul_wakaf" class="form-label">Judul Wakaf</label>
                                    <input type="text" name="judul_wakaf" id="judul_wakaf" class="form-control"
                                        placeholder="Masukan Judul Wakaf">
                                    <span class="text-danger judul_wakaf"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="link_wakaf" class="form-label">Link Wakaf</label>
                                    <input type="text" name="link_wakaf" id="link_wakaf" placeholder="Masukan Link Wakaf"
                                        id="link_wakaf" class="form-control">
                                    <span class="text-danger link_wakaf"></span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="target" class="form-label">Target Wakaf</label>
                                    <input type="text" data-prefix="Rp." name="target" id="target"
                                        placeholder="Masukan Target Wakaf" class="form-control">
                                    <span class="text-danger target"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tanggal_berakhir" class="form-label">Tanggal Berakhir</label>
                                    <input type="date" name="tanggal_berakhir" id="tanggal_berakhir"
                                        placeholder="Pilih Tanggal Berakhir" class="form-control flatpickr-no-config">
                                    <span class="text-danger tanggal_berakhir"></span>
                                </div>

                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Benefit" class="form-label">Benefit</label>
                            <div class="form-group with-title">
                                <label for="benefit">Masukan Benefit Wakaf Di Sini</label>
                                <textarea class="form-control" name="benefit" id="benefit"></textarea>
                            </div>
                            <span class="text-danger benefit"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="deskripsi" class="">Deskripsi</label>
                            <div class="form-group with-title">
                                <label for="deskripsi">Masukan Deskripsi Wakaf Di Sini</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi"></textarea>
                            </div>
                            <span class="text-danger deskripsi"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="image" class="form-label">Gambar Wakaf</label>
                            <input type="file" name="image" id="image" class="image-preview-filepond">
                            <span class="text-danger image"></span>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Kembali
                    </button>
                    <button type="submit" class="btn btn-primary">Buat Wakaf</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal Add Wakaf --}}

    {{-- Modal Edit Wakaf --}}
    <div class="modal fade modal-borderless" id="modaledit" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" role="dialog" aria-labelledby="modaledittitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modaledittitle">
                        Edit Campaign Wakaf
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="form-edit" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_wakaf_edit" id="id_wakaf_edit">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="judul_wakaf_edit" class="form-label">Judul Wakaf</label>
                                    <input type="text" name="judul_wakaf_edit" id="judul_wakaf_edit"
                                        class="form-control" placeholder="Masukan Judul Wakaf_edit">
                                    <span class="text-danger judul_wakaf"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="link_wakaf_edit" class="form-label">Link Wakaf</label>
                                    <input type="text" name="link_wakaf_edit" id="link_wakaf_edit"
                                        placeholder="Masukan Link Wakaf" id="link_wakaf" class="form-control">
                                    <span class="text-danger link_wakaf"></span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="target_edit" class="form-label">Target Wakaf</label>
                                    <input type="text" data-prefix="Rp." name="target_edit" id="target_edit"
                                        placeholder="Masukan Target Wakaf" class="form-control">
                                    <span class="text-danger target"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="tanggal_berakhir_edit" class="form-label">Tanggal Berakhir</label>
                                    <input type="date" name="tanggal_berakhir_edit" id="tanggal_berakhir_edit"
                                        placeholder="Pilih Tanggal Berakhir" class="form-control flatpickr-no-config">
                                    <span class="text-danger tanggal_berakhir"></span>
                                </div>

                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Benefit_edit" class="form-label">Benefit</label>
                            <div class="form-group with-title">
                                <label for="benefit_edit">Masukan Benefit Wakaf Di Sini</label>
                                <textarea class="form-control" name="benefit_edit" id="benefit_edit"></textarea>
                            </div>
                            <span class="text-danger benefit"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="deskripsi_edit" class="">Deskripsi</label>
                            <div class="form-group with-title">
                                <label for="deskripsi_edit">Masukan Deskripsi Wakaf Di Sini</label>
                                <textarea class="form-control" name="deskripsi_edit" id="deskripsi_edit"></textarea>
                            </div>
                            <span class="text-danger deskripsi"></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="image_edit" class="form-label">Gambar Wakaf</label>
                            <input type="file" name="image_edit" id="image_edit" class="image-preview-filepond">
                            <span class="text-danger image"></span>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Kembali
                    </button>
                    <button type="submit" class="btn btn-primary">Update Wakaf</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal Edit Wakaf --}}
@endsection

@push('js')
    <script>
        $('#mnWakaf').addClass('active')
        $('#mnWakafs').addClass('active')
        $('#mnListWakafs').addClass('active')
        getWakaf();
        const formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
        })
        $('#target').maskMoney()
        let table = $('#tableWakaf').DataTable({
            lengthChange: false,
            responsive: true,
            layout: {
                topStart: {
                    buttons: [{
                        text: 'Buat Campaign Wakaf',
                        className: 'btn btn-primary',
                        action: function(e, dt, node, config) {
                            $('#modaladd').modal('show')

                        }
                    }]
                }
            },
        })

        function getWakaf() {
            $.ajax({
                url: '{{ route('wakaf.get') }}',
                method: 'get',
                success: function(res) {
                    let dt = []
                    table.clear();
                    $.each(res.data, function(key, val) {
                        let id = val.id
                        let judul = val.name;
                        let target = formatRupiah(val.target);
                        let uang_terkumpul = ""
                        if (val.last_amount) {
                            uang_terkumpul += formatRupiah(val.last_amount);
                        } else {
                            uang_terkumpul += 'Rp. 0';
                        }
                        let created = val.created_at;
                        let btn = `<div class="d-flex justify-content-center" style="gap: 9px;">
                                                <button type="button" data-id="${id}"
                                                    class="btn btn-warning btn-sm text-white" onclick="edit(this)"><i
                                                        class="bi bi-pencil-square"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-id="${id}" onclick="deleteData(this)"><i
                                                        class="bi bi-trash3-fill"></i></button>
                                            </div>`
                        dt = [key + 1, judul, target, uang_terkumpul, created, btn]
                        table.rows.add([dt]).draw();
                    })
                }
            })
        }

        $('.form-add').submit(function(e) {
            e.preventDefault();
            const t = $('#target').maskMoney()
            const cleanTarget = cleanMaskMoney(t)
            $.ajax({
                url: '{{ route('wakaf.add') }}',
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
                            getWakaf()
                            $('#judul_wakaf').val('')
                            $('#link_wakaf').val('')
                            $('#target').val('')
                            $('#benefit').val('')
                            $('#deskripsi').val('')
                            $('#taggal_berakhir').val('')
                        })
                    }
                },
                complete: function() {
                    $('button[type="submit"]').removeAttr('disabled', 'disabled')
                },
                error: function(err) {
                    if (err.status == 422) {
                        $('span.text-danger').text('');
                        $.each(err.responseJSON.errors, function(prefix, val) {
                            $('.' + prefix).text(val[0])
                        })
                    }
                }
            })
        })

        function edit(el) {
            let id = $(el).data('id')

            $('#modaledit').modal('show')
            $.ajax({
                url: '{{ route('wakaf.getById', ':id') }}'.replace(':id', id),
                method: 'get',
                success: function(res) {
                    let data = res.data


                    $('#id_wakaf_edit').val(data[0].id)
                    $('#judul_wakaf_edit').val(data[0].name)
                    $('#target_edit').val(data[0].target)
                    $('#deskripsi_edit').val(data[0].description)
                    $('#tanggal_berakhir_edit').val(data[0].expire_date)
                    $('#benefit_edit').val(data[0].benefit)
                    $('#link_wakaf_edit').val(data[0].link)
                    FilePond.create(document.querySelector("#image_edit"), {
                        credits: null,
                        allowImagePreview: true,
                        allowImageFilter: false,
                        allowImageExifOrientation: false,
                        allowImageCrop: false,
                        acceptedFileTypes: ["image/png", "image/jpg", "image/jpeg"],
                        fileValidateTypeDetectType: (source, type) =>
                            new Promise((resolve, reject) => {
                                resolve(type);
                            }),
                        storeAsFile: true,
                    }).addFile(`{{ asset('${data[0].image}') }}`)
                    $('#target_edit').maskMoney()
                }
            })
        }

        $('.form-edit').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('wakaf.edit') }}',
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
                            getWakaf()
                        })
                    }
                },
                complete: function() {
                    $('button[type="submit"]').removeAttr('disabled', 'disabled')
                },
                error: function(err) {
                    Toast(err.responseJSON.errors, 'error')
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
                        url: '{{ route('wakaf.delete', ':id') }}'.replace(':id', id),
                        method: 'delete',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            if (res.statusCode == 200) {
                                Toast(res.message, 'success').then((success) => {
                                    getWakaf()
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
