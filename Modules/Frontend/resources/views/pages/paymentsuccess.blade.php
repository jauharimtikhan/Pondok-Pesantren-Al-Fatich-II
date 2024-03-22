@extends('frontend::layouts/app')
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
                'Authorization': `Bearer ${localStorage.getItem('token')}`

            },
            success: function(data) {
                if (data.data.status_code == 200 || data.data.status_code == 201) {
                    const tr_status = data.data.transaction_status
                    const tr_id = data.data.transaction_id
                    const bank = data.data.va_numbers[0].bank
                    const va = data.data.va_numbers[0].va_number
                    const gross_amount = formatter.format(data.data.gross_amount)
                    if (data.data.transaction_status == 'settlement' || data.data.transaction_status ==
                        'capture') {
                        $('#render').append(`@include('frontend::components/payments/success', [
                            'gross_amount' => '${gross_amount}',
                        ])`)
                        updateStatus(tr_status, tr_id, gross_amount, data.data.order_id)
                    } else if (data.data.transaction_status == 'pending') {
                        $('#render').append(`@include('frontend::components/payments/pending', [
                            'bank' => '${bank}',
                            'va' => '${va}',
                            'gross_amount' => '${gross_amount}',
                        ])`)
                        console.log(cleanNumber(gross_amount));
                        updateStatus(tr_status, tr_id, gross_amount, data.data.order_id)
                    }
                } else if (data.data.status_code == 404) {
                    Toast(2000).fire({
                        icon: 'error',
                        title: data.data.status_message
                    })
                    $('#render').append(`@include('frontend::components/payments/error')`)
                }
            },
            complete: function() {
                $('#loader').addClass('d-none')
            },
            error: function(err) {
                console.log(err);

            }
        })

        function updateStatus(tr_status, tr_id, gross_amount, order_id) {
            const last_amount = '{{ $last_amount }}'
            let wakaf_id = "{{ $wakaf_id }}"
            if (last_amount !== '') {
                last_amount = 0
            }
            if (wakaf_id == '') {
                wakaf_id = order_id
            }
            $.ajax({
                url: '{{ getenv('API_URL') }}payment/update',
                method: 'post',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token'),
                },
                data: {
                    donatur_id: '{{ $donatur_id }}',
                    transaction_status: tr_status,
                    transaction_id: tr_id,
                    wakaf_id: wakaf_id,
                    last_amount: last_amount,
                    gross_amount: cleanNumber(gross_amount),
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
