<section class="payment-pending">
    <div class="container g-5 d-flex justify-content-center">
        <div class="payment-pending-card">
            <i class="bi bi-exclamation-circle"></i>
            <h1>Pending</h1>
            <h2>Total
                <b>
                    {{ $gross_amount }}
                </b>
            </h2>
            <p>Silahkan lakukan pembayaran sesuai dengan nominal yang tertera diatas</p>
            <h4><b>BANK</b> : {{ $bank }}</h4>

            <div class="d-flex align-items-center justify-content-center flex-column">
                <span>No Rekening</span>
                <span class="payment-pending-no-rekening">{{ $va }}</span>
            </div>
            <small class="text-danger text-wrap text-break mt-3">*Setelah melakukan pembayaran mohon refresh halaman
                ini
                untuk
                meminta file
                sertifikat</small>
            <br>
            <small class="text-danger text-wrap text-break">*Jika anda meninggalkan halaman ini maka anda tidak
                dapat meminta file sertifikat!</small>
        </div>
    </div>
</section>
