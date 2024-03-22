@extends('admin::layouts/app', ['activePage' => 'Edit Artikel'])

@section('content')
    @include('admin::layouts/header')

    <div id="main-content">

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Edit Artikel</h3>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        <section class="section">
            <form action="" method="post" class="form-add">
                @csrf
                <input type="hidden" name="id" value="{{ $artikel[0]->id }}">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" value="{{ $artikel[0]->title }}" autocomplete="on"
                                        placeholder="Title" id="title" class="form-control">
                                    <span class="text-danger title"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <label for="kategori" id="addKategoriLabel"
                                        class="form-label text-white badge bg-warning" style="cursor: pointer">Tambah
                                        Kategori</label>
                                    <select name="kategori" id="kategori" class=" form-select">
                                        <option value="">--Pilih Kategori--</option>

                                    </select>
                                    <span class="text-danger kategori"></span>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="full" class="form-label">Content</label>
                                    <textarea name="content" id="full" style="opacity: 0.5">
                                        <?php $content = $artikel[0]->content;
                                        $finded = ['../../', '../', '/..', '../..', '/../'];
                                        foreach ($finded as $value) {
                                            if (strpos($content, $value) !== false) {
                                                $content = str_replace($value, getenv('ASSET_URL') . '/', $content);
                                            }
                                        }
                                        
                                        echo $content;
                                        ?>
                                   
                                    </textarea>
                                    <span class="text-danger content"></span>
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
                                        placeholder="Otomatis terisi" readonly value="{{ $artikel[0]->slug }}"
                                        class="form-control" />
                                    <span class="text-danger slug"></span>
                                </div>
                                <div class="form-group mb-3 d-flex flex-column">
                                    <label for="metadescription" class="form-label">Meta Tag</label>
                                    <select multiple name="metadescription[]" id="metadescription" class="form-control">
                                        @if (is_array($artikel[0]->meta_description))
                                            @foreach ($artikel[0]->meta_description as $tag)
                                                <option value="{{ $tag }}" selected>{{ $tag }}</option>
                                            @endforeach
                                        @else
                                            <?php
                                            $tags = explode(',', $artikel[0]->meta_description);
                                            ?>
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag }}" selected>
                                                    {{ $tag }}
                                                </option>
                                            @endforeach
                                        @endif

                                    </select>
                                    <span class="text-danger metadescription"></span>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="thumbnail" class="form-label">Thumbnail</label>
                                    <input type="file" name="thumbnail" id="thumbnail" class="image-preview-filepond">
                                    <span class="text-danger thumbnail"></span>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" name="is_featured"
                                                    value="{{ $artikel[0]->is_featured }}"
                                                    @if ($artikel[0]->is_featured == 1) {{ 'checked' }} @endif
                                                    type="checkbox" id="featured">
                                                <label class="form-check-label" for="featured">Featured</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" value="{{ $artikel[0]->is_published }}"
                                                    name="is_published"
                                                    @if ($artikel[0]->is_published == 1) {{ 'checked' }} @endif
                                                    type="checkbox" id="published">
                                                <label class="form-check-label" for="published">Publish</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6 col-md-6 col-lg-6">
                                    <a href="{{ route('artikel') }}" class="btn btn-warning text-white btn-md"><i
                                            class="bi bi-arrow-left"></i> Kembali</a>
                                </div>
                                <div class="col-6 col-md-6 col-lg-6">
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

    {{-- Modal Add Kategori --}}
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
<?php
$assetsImage = $artikel[0]->path;
$replace = 'http://localhost:8000/';
if (getenv('ASSET_URL') !== $replace) {
    if (strpos($assetsImage, $replace) !== false) {
        $newAsset = str_replace($replace, getenv('ASSET_URL') . '/', $assetsImage);
    } else {
        $newAsset = $assetsImage;
    }
}
?>
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            if (document.readyState == 'loading') {
                $('#full').addClass('d-none')
            }

            getKategori();
            $('#mnPost').addClass('active')
            $('#mnSub').addClass('active')
            $('#mnSubPost').addClass('active')
            $('#addKategoriLabel').click(function() {
                $('#modalAddKategori').modal('show')
            })

            FilePond.create(document.querySelector("#thumbnail"), {
                credits: null,
                allowImagePreview: true,
                allowImageFilter: false,
                allowImageExifOrientation: false,
                allowImageCrop: false,
                acceptedFileTypes: ["image/png", "image/jpg", "image/JPG", "image/jpeg", "image/webp"],
                fileValidateTypeDetectType: (source, type) =>
                    new Promise((resolve, reject) => {
                        resolve(type);
                    }),
                storeAsFile: true,
            }).addFile(`{{ $newAsset }}`)

            $('#featured').change((e) => {
                const state = e.target.checked;
                if (state) {
                    $('#featured').val(1);
                } else {
                    $('#featured').val(0);
                }
            })

            $('#published').change((e) => {
                const state = e.target.checked;
                if (state) {
                    $('#published').val(1);
                } else {
                    $('#published').val(0);
                }
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

            $('.form-add').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('artikel.update') }}',
                    method: 'post',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('button[type="submit"]').prop('disabled', true);
                    },
                    success: function(res) {
                        Toast(res.message, 'success').then((success) => {
                            window.location.reload();
                        })
                    },
                    complete: function() {
                        $('button[type="submit"]').prop('disabled', false);
                    },
                    error: function(err) {
                        if (err.status == 422) {
                            $('span.text-danger').text('');
                            $.each(err.responseJSON.errors, function(prefix, val) {
                                $('.' + prefix).text(val[0]);
                            })
                        }
                    }
                })
            })
        })

        $('#title').keyup(function() {
            let title = $(this).val()
            $('#slug').val(title.toLowerCase().replace(/ /g, '-').replace(/[^/w-]+/g, ''))
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
                },
                complete: function() {
                    $('#kategori').find('option[value={{ $artikel[0]->category_id }}]').attr('selected',
                        'selected');
                }
            })
        }

        const upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '{{ route('artikel.upload_image') }}');

            xhr.upload.onprogress = (e) => {
                progress(e.loaded / e.total * 100);
            };

            xhr.onload = () => {
                if (xhr.status === 403) {
                    reject({
                        message: 'HTTP Error: ' + xhr.status,
                        remove: true
                    });
                    return;
                }

                if (xhr.status < 200 || xhr.status >= 300) {
                    reject('HTTP Error: ' + xhr.status);
                    return;
                }

                const json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    reject('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                resolve(json.location);
            };

            xhr.onerror = () => {
                reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
            };

            const formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            formData.append('_token', '{{ csrf_token() }}');
            xhr.send(formData);
        });

        tinymce.init({
            selector: '#full',
            plugins: 'image code preview',
            toolbar: `undo redo | blocks fontfamily fontsize |
             bold italic underline strikethrough | link image media table | 
             align lineheight | numlist bullist indent outdent | emoticons charmap
              | removeformat | ltr rtl | fullscreen`,
            image_title: true,
            automatic_uploads: true,
            images_upload_url: '{{ route('artikel.upload_image') }}',
            images_upload_handler: upload_handler,
            images_reuse_filename: true,
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
                        const id = 'blobid' + (new Date()).getTime();
                        const blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        const base64 = reader.result.split(',')[1];
                        const blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

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
