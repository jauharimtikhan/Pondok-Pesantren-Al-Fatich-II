@extends('admin::layouts/app', ['activePage' => 'home'])

@section('content')
    @include('admin::layouts/header')
    <div id="main-content">

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Data Donatur</h3>
                    </div>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="tableDataDonatur">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No. Whatsapp</th>
                            <th>Total</th>
                            <th>Campaign Wakaf</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @foreach ($wakafs as $wakaf)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $wakaf->name }}</td>
                                <td>{{ $wakaf->phone }}</td>
                                <td>{{ convertRp($wakaf->amount) }}</td>
                                <td>{{ $wakaf->wakaf }}</td>
                                <td>
                                    <div class="d-flex justify-content-center " style="gap: 9px;">
                                        <button type="button" class="btn btn-warning text-white"
                                            data-id="{{ $wakaf->id }}" onclick="showDetails(this)">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>

                                        <button class="btn btn-danger" type="button" data-id="{{ $wakaf->id }}"
                                            onclick="deleteData(this)"><i class="bi bi-trash3-fill"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </section>

        {{-- Modal Detail --}}
        <div class="modal fade modal-borderless" id="modalShowDetails" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" role="dialog" aria-labelledby="modalShowDetailsId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalShowDetailsId"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="render">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="spinner-border text-primary" role="status" id="loader">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Kembali
                        </button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>


        </div>


    </div>
@endsection
@push('js')
    <script>
        $('#mnWakaf').addClass('active')
        $('#mnWakafs').addClass('active')
        $('#mnDataUang').addClass('active')
        let table = $('#tableDataDonatur').DataTable({
            lengthChange: false,
            responsive: true,
        })

        const showDetails = (el) => {
            let id = $(el).data('id')
            $('#modalShowDetails').modal('show')

            $.ajax({
                url: '{{ route('donatur.getDetails', ':id') }}'.replace(':id', id),
                method: 'GET',
                success: function(res) {
                    if (res.statusCode == 200) {
                        $('#render').html("")
                        $.each(res.results, function(i, k) {
                            $('#modalShowDetailsId').text(`Detail donatur ${k.donatur_name}`)
                            let component = `
                            <ul class="list-group my-1">
                                <a href="#${k.id}" data-bs-toggle="collapse">
                                <li class="list-group-item">
                                       Transaksi ke-${i+1}
                                 </li>
                                </a>
                            </ul> 
                            <div class="collapse" id="${k.id}">
                                <div class="card card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">Nama: ${k.donatur_name}</li>
                                        <li class="list-group-item">No Whatsapp                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         : ${k.donatur_phone}</li>
                                        <li class="list-group-item">Total: ${formatRupiah(k.result.gross_amount)}</li>
                                        <li class="list-group-item">Status: ${k.result.transaction_status}</li>
                                        <li class="list-group-item">Bank: ${k.result.va_numbers[0].bank}</li>
                                        <li class="list-group-item">No Rekening: ${k.result.va_numbers[0].va_number}</li>
                                        <li class="list-group-item">Metode Pembayaran: ${k.result.payment_type.replace('_', ' ')}</li>
                                        <li class="list-group-item">Transaksi Dibuat Pada: ${changeDate(k.result.transaction_time)}</li>
                                        <li class="list-group-item">Transaksi Sukses Pada: ${changeDate(k.result.settlement_time)}</li>
                                    </ul>
                                    </div>
                                </div>`;


                            $('#render').append(component)
                        })
                    }
                },
                complete: function() {
                    $('#loader').addClass('d-none')
                },
                error: function(err) {
                    console.log(err);
                }
            })
        }

        function changeDate(text) {
            let originalDateTime = text
            let dateTimeParts = originalDateTime.split(" ");
            let datePart = dateTimeParts[0];
            let timePart = dateTimeParts[1];

            let dateObject = new Date(datePart);

            let day = dateObject.getDate();
            let month = getShortMonth(dateObject.getMonth());
            let year = dateObject.getFullYear();

            let formattedDateTime = day + '-' + month + '-' + year + ' ' + timePart;

            return formattedDateTime;
        }

        function getShortMonth(month) {
            let months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des'];
            return months[month];
        }
    </script>
@endpush
