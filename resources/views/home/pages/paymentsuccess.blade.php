@extends('home.layouts.app')
@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <div class="spinner-border text-success " id="loader" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>

        <section id="render"></section>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        const formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        })
        $.ajax({
            url: '{{ getenv('API_URL') }}payment_status?order_id={{ $order_id }}',
            method: 'get',
            headers: {
                'Authorization': 'Bearer {{ getenv('API_KEY') }}'

            },
            success: function(data) {
                const tr_status = data.data.transaction_status
                const tr_id = data.data.transaction_id
                const bank = data.data.va_numbers[0].bank
                const va = data.data.va_numbers[0].va_number
                const gross_amount = formatter.format(data.data.gross_amount)
                if (data.data.transaction_status == 'settlement' || data.data.transaction_status == 'capture') {
                    $('#render').append(`@include('home.components.payments.success', ['gross_amount' => '${gross_amount}'])`)
                    updateStatus(tr_status, tr_id, gross_amount)
                } else if (data.data.transaction_status == 'pending') {
                    $('#render').append(`@include('home.components.payments.pending', [
                        'bank' => '${bank}',
                        'va' => '${va}',
                        'gross_amount' => '${gross_amount}',
                    ])`)
                    updateStatus(tr_status, tr_id, data.data.gross_amount)
                }
            },
            complete: function() {
                $('#loader').addClass('d-none')
            },
            error: function(err) {
                console.log(err);
            }
        })

        function updateStatus(tr_status, tr_id, gross_amount) {
            $.ajax({
                url: '{{ getenv('API_URL') }}payment/update',
                method: 'post',
                headers: {
                    'Authorization': 'Bearer {{ getenv('API_KEY') }}',
                },
                data: {
                    donatur_id: '{{ $donatur_id }}',
                    transaction_status: tr_status,
                    transaction_id: tr_id,
                    wakaf_id: '{{ $wakaf_id }}',
                    last_amount: parseInt('{{ $last_amount }}'),
                    gross_amount: cleanNumber(gross_amount)
                },
                success: function(res) {

                },
                error: function(err) {

                }
            })
        }

        function downloadSertifikat() {
            console.log('ok');
        }
    </script>
@endpush
