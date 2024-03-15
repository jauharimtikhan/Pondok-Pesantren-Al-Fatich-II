@extends('layouts.app', ['activePage' => 'artikel'])

@section('content')
    @include('layouts.header')

    <div id="main-content">

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Artikel</h3>
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
                            <th>Title</th>
                            <th>Kategori</th>
                            <th>Author</th>
                            <th>Tanggal Dibuat</th>
                            <th>Tanggal Diupdate</th>
                            <th class="text-center" width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->kategori }}</td>
                                <td>{{ $post->author }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>{{ $post->updated_at }}</td>
                                <td>
                                    <div class="d-flex justify-content-center " style="gap: 9px;">
                                        <a href="{{ route('artikel.edit', $post->id) }}"
                                            class="btn btn-warning text-white"><i class="bi bi-pencil-square"></i></a>
                                        <button class="btn btn-danger" type="button" data-id="{{ $post->id }}"
                                            onclick="deleteData(this)"><i class="bi bi-trash3-fill"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </section>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $('#mnPost').addClass('active')
        $('#mnSub').addClass('active')
        $('#mnSubPost').addClass('active')

        let table = $('#tableKategoriPost').DataTable({
            lengthChange: false,
            responsive: true,
            layout: {
                topStart: {
                    buttons: [{
                        text: 'Buat Artikel',
                        className: 'btn btn-primary',
                        action: function(e, dt, node, config) {
                            window.location.href = "{{ route('artikel.add') }}";
                        }
                    }]
                }
            },
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
                        url: '{{ route('artikel.delete', ':id') }}'.replace(':id', id),
                        method: 'delete',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            if (res.statusCode == 200) {
                                Toast(res.message, 'success').then((success) => {
                                    window.location.reload()
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
