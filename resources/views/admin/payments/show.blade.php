@include('admin.layouts.navbar')
<div class="container-fluid content-wrapper d-flex justify-content-center align-items-center pt-5"
    style="min-height: 60vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-lg-7">
                <h1>Detail Pembayaran</h1>
                <ul>
                    <li><strong>User:</strong> {{ $payment->user->name }}</li>
                    <li><strong>Kendaraan:</strong> {{ $payment->kendaraan->nama }}</li>
                    <li><strong>order id:</strong> {{ $payment->order_id }}</li>
                    <li><strong>Tanggal Pembelian:</strong> {{ $payment->purchase_date }}</li>
                    <li><strong>waktu transaksi:</strong> {{ $payment->transaction_time }}</li>
                    <li><strong>status transaksi:</strong> {{ $payment->transaction_status }}</li>
                    <li><strong>ID transaksi:</strong> {{ $payment->transaction_id }}</li>
                    <li><strong>pesan status:</strong> {{ $payment->status_message }}</li>
                    <li><strong>code status:</strong> {{ $payment->status_code }}</li>
                    <li><strong>Jam Pembayaran:</strong> {{ $payment->settlement_time }}</li>
                    <li><strong>Tipe transaksi:</strong> {{ $payment->payment_type }}</li>
                    <li><strong>Jumlah Pembayaran:</strong> {{ $payment->gross_amount }}</li>
                    <li><strong>fraud status:</strong> {{ $payment->fraud_status }}</li>
                    <li><strong>Mata Uang:</strong> {{ $payment->currency }}</li>
                    <li><strong>Id Merchant:</strong> {{ $payment->merchant_id }}</li>
                    
                </ul>
            </div>
        </div>
    </div>