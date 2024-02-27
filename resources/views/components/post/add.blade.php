@extends('layouts.app', ['activePage' => 'Buat Artikel'])

@section('content')
    @include('layouts.header')

    <div id="main-content">

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Buat Artikel</h3>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        <section class="section">
            <form action="" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" autocomplete="on" placeholder="Title"
                                        id="title" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <label for="kategori" id="addKategoriLabel" class="form-label text-danger"
                                        style="cursor: pointer">Tambah
                                        Kategori</label>
                                    <select name="kategori" id="kategori" class=" form-select">
                                        <option value="">--Pilih Kategori--</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="full" class="form-label">Content</label>
                                    <textarea name="content" id="full"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" name="slug" id="slug" autocomplete="on"
                                        placeholder="Otomatis terisi" class="form-control" />
                                </div>
                                <div class="form-group mb-3">
                                    <label for="metadescription" class="form-label">Meta Tag</label>
                                    <select multiple name="metadescription" id="metadescription" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="thumbnail" class="form-label">Thumbnail</label>
                                    <input type="file" name="thumbnail" id="thumbnail" class="image-preview-filepond">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="featured">
                                                <label class="form-check-label" for="featured">Featured</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="published" checked>
                                                <label class="form-check-label" for="published">Publish</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">
                                    <button type="button" class="btn btn-warning text-white btn-md"><i
                                            class="bi bi-arrow-left"></i> Kembali</button>
                                </div>
                                <div class="col-12 col-md-6 col-lg-6">
                                    <button type="submit" class="btn btn-success btn-md float-end">Publish <i
                                            class="bi bi-cloud-plus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </section>
    </div>


    <div class="modal fade modal-borderless" id="modalAddKategori" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleAddKategori" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleAddKategori">
                        Tambah Kategori
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="form-add-kategori">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Nama Kategori</label>
                            <input type="text" name="name" autocomplete="on" placeholder="Nama Kategori"
                                id="name" class="form-control">
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
    {{-- End Modal Add Kategori --}}
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            getKategori();
            $('#mnPost').addClass('active')
            $('#mnSub').addClass('active')
            $('#mnSubPost').addClass('active')
            $('#addKategoriLabel').click(function() {
                $('#modalAddKategori').modal('show')
            })

            $('.form-add-kategori').submit(function(e) {
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
                                getKategori();
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
        })

        $('#title').keyup(function() {
            let title = $(this).val()
            $('#slug').val(title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, ''))
        })

        $('#metadescription').select2({
            tags: true,

        })

        function getKategori() {
            $.ajax({
                url: '{{ route('kategori.get') }}',
                method: 'get',
                success: function(res) {
                    $('#kategori').empty()
                    $.each(res.data, function(key, val) {
                        $('#kategori').append($('<option>', {
                            value: val.id,
                            text: val.name
                        }))
                    })
                }
            })
        }


        tinymce.init({
            selector: '#full',
            plugins: 'image code preview',
            toolbar: `undo redo | link image | code | bold italic | 
            alignleft aligncenter alignright alignjustify |
             bullist numlist outdent indent | removeformat | preview`,
            /* enable title field in the Image dialog*/
            image_title: true,
            /* enable automatic uploads of images represented by blob or data URIs*/
            automatic_uploads: true,
            /*
              URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
              images_upload_url: 'postAcceptor.php',
              here we add custom filepicker only to Image dialog
            */
            file_picker_types: 'image',
            /* and here's our custom image picker*/
            file_picker_callback: (cb, value, meta) => {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.addEventListener('change', (e) => {
                    const file = e.target.files[0];

                    const reader = new FileReader();
                    reader.addEventListener('load', () => {
                        /*
                          Note: Now we need to register the blob in TinyMCEs image blob
                          registry. In the next release this part hopefully won't be
                          necessary, as we are looking to handle it internally.
                        */
                        const id = 'blobid' + (new Date()).getTime();
                        const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        const base64 = reader.result.split(',')[1];
                        const blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        /* call the callback and populate the Title field with the file name */
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    });
                    reader.readAsDataURL(file);
                });

                input.click();
            },
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });
    </script>
@endpush

@push('css')
    <style>
        /* Mengatur lebar Select2 */
        .select2-container {
            width: 200px;
            /* Atur sesuai kebutuhan */
        }

        /* Mengatur warna latar belakang dan warna teks pilihan yang dipilih */
        .select2-selection__rendered {
            background-color: #f0f0f0;
            /* Warna latar belakang */
            color: #333;
            /* Warna teks */
        }

        /* Mengatur border radius */
        .select2-selection__rendered {
            border-radius: 5px;
            /* Atur sesuai kebutuhan */
        }

        /* Mengatur tampilan panah dropdown */
        .select2-selection__arrow {
            height: 100%;
            /* Tinggi */
            top: 50%;
            /* Posisi vertikal */
        }

        /* Mengatur warna panah dropdown */
        .select2-selection__arrow b {
            border-color: #555 transparent transparent;
            /* Warna border */
        }

        /* Mengatur tampilan dropdown menu */
        .select2-results__option {
            padding: 8px 12px;
            background-color: #333
                /* Padding */
        }

        /* Mengatur warna latar belakang hover pada pilihan dropdown */
        .select2-results__option--highlighted {
            background-color: #474747;
            /* Warna latar belakang */
        }
    </style>
@endpush
