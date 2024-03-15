<div class="tab-pane fade show active" id="pills-core-setting" role="tabpanel" aria-labelledby="pills-core-setting-tab">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Konfigurasi Utama</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th class="text-center">Setting</th>
                                <th width="30%" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="renderCoreApp"></tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-borderless" id="modaledit" tabindex="-1" data-bs-backdrop="static"
    data-bs-keyboard="false" role="dialog" aria-labelledby="modalEditTitle" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-edit">
                    @csrf
                    <input type="hidden" name="old" id="old">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="setting" id="setting">
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



<script>
    gets();

    function gets() {
        $.ajax({
            url: '{{ route('settings.get') }}?query=APP',
            method: 'get',
            success: function(res) {
                $('#renderCoreApp').empty()
                let no = 1
                $.each(res.data, function(key, value) {
                    let id = key
                    let result = key + '=' + value
                    let btn = `<div class="d-flex justify-content-center" style="gap: 9px;">
                                        <button type="button" data-id="${id}"
                                            class="btn btn-warning btn-sm text-white" onclick="edit(this)"><i
                                                class="bi bi-pencil-square"></i></button>
                                    </div>`;
                    $('#renderCoreApp').append(
                        $('<tr>'),
                        $('<td>').text(no++),
                        $('<td>').text(result),
                        $('<td>').html(btn),
                        $('</tr>')
                    )
                })
            }
        })
    }

    function edit(e) {
        let id = $(e).data('id')
        $('#modaledit').modal('show')
        $.ajax({
            url: '{{ route('settings.get') }}?query=' + id,
            method: 'GET',
            success: function(res) {
                $.each(res.data, function(key, val) {
                    $('#old').val(key + '=' + val)
                    $('#id').val(key)
                    $('#modalEditTitle').text('Update Pengaturan ' + key)
                    $('#setting').val(val)

                })
            }
        })
    }

    $('.form-edit').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: '{{ route('settings.update', ':id') }}'.replace(':id', $('#id').val()),
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.statusCode == 200) {
                    Toast('Berhasil update pengaturan', 'success').then((success) => {
                        gets()
                    })
                }
            },
            error: function(err) {
                console.log(err);
            }
        })
    })
</script>
