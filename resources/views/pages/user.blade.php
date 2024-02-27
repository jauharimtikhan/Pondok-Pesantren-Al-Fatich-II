@extends('layouts.app', ['activePage' => 'home'])

@section('content')
    @include('layouts.header')
    <div id="main-content">

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Manajemen User</h3>
                    </div>
                </div>
            </div>
            <hr class="mt-1">
        </div>
        <section class="section">
            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableUsers" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th class="text-center" width="20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </section>

        {{-- Modal Add User --}}
        <div class="modal fade modal-borderless" id="modaladd" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" role="dialog" aria-labelledby="modaladdtitle" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modaladdtitle">
                            Tambah User
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" class="form-add">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input autocomplete="on" type="text" placeholder="Name" class="form-control"
                                    id="name" name="name">
                                <span class="text-danger name"></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input autocomplete="on" type="text" name="email" id="email" placeholder="Email"
                                    class="form-control">
                                <span class="text-danger email"></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group flex-nowrap">
                                    <input autocomplete="on" type="text" name="password" id="password"
                                        class="form-control" placeholder="Password" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                    <span class="input-group-text" style="cursor: pointer;" id="generate">
                                        🔄
                                    </span>
                                </div>
                                <span class="text-danger password"></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" id="role" class="choices form-select">
                                    <option value="">--Pilih Role--</option>
                                    <option value="user">User</option>
                                    <option value="super admin">Super Admin</option>
                                    <option value="creator">Cerator</option>
                                </select>
                                <span class="text-danger role"></span>
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
        {{-- End Modal Add User --}}

        {{-- Modal Edit User --}}
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
                            <input type="hidden" name="checkpass" id="checkpass">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input autocomplete="off" type="text" placeholder="Name" class="form-control"
                                    id="nameedit" name="name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input autocomplete="off" type="text" name="email" id="emailedit"
                                    placeholder="Email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group flex-nowrap">
                                    <input autocomplete="off" type="text" name="password" id="passwordedit"
                                        class="form-control" placeholder="Password" aria-label="Username"
                                        aria-describedby="basic-addon1">
                                    <span class="input-group-text" style="cursor: pointer;" id="generate">
                                        🔄
                                    </span>
                                </div>
                                <span class="text-danger">Jika tidak ingin merubahnya, Biarkan saja</span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" id="basicselect" class="form-select">
                                </select>
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
        {{-- End Modal Edit User --}}

    </div>
@endsection
@push('js')
    <script type="text/javascript">
        getUsers()
        var options = [{
                value: 'super admin',
                text: 'Super Admin'
            },
            {
                value: 'user',
                text: 'User'
            },
            {
                value: 'creator',
                text: 'Creator'
            }
        ];

        $.each(options, function(index, option) {
            $('#basicselect').append($('<option>', {
                value: option.value,
                text: option.text
            }));
        });
        let table = $('#tableUsers').DataTable({
            lengthChange: false,
            responsive: true,
            layout: {
                topStart: {
                    buttons: [{
                        text: 'Tambah User',
                        className: 'btn btn-primary',
                        action: function(e, dt, node, config) {
                            $('#modaladd').modal('show');
                        }
                    }]
                }
            },
        })
        $('.form-add').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('user.add') }}',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('button[type=submit]').attr('disabled', 'disabled');
                },
                success: function(res) {
                    // console.log(res);
                    if (res.statusCode == 201) {
                        Toast(res.message, 'success').then((success) => {
                            getUsers();
                        })
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
                    console.log(err);
                }
            })
        })

        $('.form-edit').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('user.edit') }}',
                method: 'post',
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('button[type=submit]').attr('disabled', 'disabled');
                },
                success: function(res) {
                    // console.log(res);

                    if (res.statusCode == 200) {
                        Toast(res.message, 'success').then((success) => {
                            getUsers();
                            $('#modaledit').modal('hide');
                        })
                    }
                },
                complete: function() {
                    $('button[type=submit]').removeAttr('disabled', 'disabled');
                },
                error: function(err) {
                    console.log(err);
                    Toast(err.responseJSON.message, 'error');
                }

            })
        })

        $('#generate').on('click', function() {
            let password = Math.random().toString(36).slice(-8);
            $('#password').val(password);
            $('#passwordedit').val(password);
        })

        function getUsers() {
            $.ajax({
                url: '{{ route('user.get') }}',
                method: 'get',
                success: function(res) {
                    // console.log(res);
                    let dt = []
                    table.clear();
                    $.each(res.data, function(i, key) {
                        let id = key.id;
                        let name = key.name;
                        let role = key.role;
                        let btn = ` <div class="d-flex justify-content-center" style="gap: 9px;">
                                                <button type="button" data-id="${id}"
                                                    class="btn btn-warning btn-sm text-white" onclick="edit(this)"><i
                                                        class="bi bi-pencil-square"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    data-id="${id}" onclick="deleteData(this)"><i
                                                        class="bi bi-trash3-fill"></i></button>
                                            </div>`
                        dt = [i + 1, name, role, btn]
                        table.rows.add([dt]).draw();
                    })
                },
                error: function(err) {
                    console.log(err);
                }
            })
        }

        function edit(el) {
            let id = $(el).data('id')
            $('#idedit').val(id)
            $('#checkpass').val(false)
            $('#modaledit').modal('show');

            $.ajax({
                url: `{{ route('user.getById', ':id') }}`.replace(':id', id),
                method: 'get',
                success: function(res) {
                    // console.log(res);
                    $.each(res.data, function(key, val) {
                        $('#modaledittitle').text('Edit User ' + val.name);
                        $('#nameedit').val(val.name);
                        $('#roleedit').val(val.role);
                        $('#emailedit').val(val.email);
                        $('#passwordedit').attr('placeholder',
                            'Biarkan kosong jika tidak ingin merubah nya!').attr('type', 'password')
                        $('#passwordedit').val(val.password);
                        $('#basicselect option[value="' + val.role + '"]').prop('selected', true);
                        $('#passwordedit').on('change', function() {
                            $('#checkpass').val(true)
                        })
                    })
                },
                error: function(err) {
                    console.log(err);
                }
            })
        }

        function deleteData(el) {
            let id = $(el).data('id')

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger mx-2"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: "Apakah anda yakin?",
                text: "Ingin menhapus data ini. Anda tidak akan dapat mengembalikannya!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Lanjutkan!",
                cancelButtonText: "Tidak, Kembali!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('user.delete', ':id') }}'.replace(':id', id),
                        method: 'delete',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            if (res.statusCode == 200) {
                                Toast(res.message, 'success').then((success) => {
                                    getUsers();
                                })
                            }
                        },
                        error: function(err) {
                            Toast(err.responseJSON.message, 'error');
                        }
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    Toast('Anda membatalkan tindakan!', 'info')
                }
            });
        }
    </script>
@endpush
