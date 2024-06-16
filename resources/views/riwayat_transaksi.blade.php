    @include('layouts.navbar')
 
        <div class="container mt-5">
            <div class="row mb-5">
                <div class="col-6 mt-5">
                    <h2 class="mb-1">Riwayat Transaksi</h2>
                </div>
                <div class="col-6 mt-5">
                    <form method="GET" action="{{ route('riwayat.transaksi') }}" class="d-flex">
                        <input type="text" name="search" class="form-control me-2" placeholder="Search Id Transaksi...." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-light">Search</button>
                    </form>
                </div>
            </div>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        
            @if ($riwayatTransaksi->isEmpty())
                <div class="alert alert-info">
                    Anda belum memiliki riwayat transaksi.
                </div>
            @else
                <div class="row">
                    @foreach ($riwayatTransaksi as $transaksi)
                        <div class="col-md-12">
                            <div class="card mb-2">
                                <div class="card-body bg-light row">
                                    <div class="col-md-3">
                                        <p><strong>Order ID:</strong> {{ $transaksi->order_id }}</p>
                                        <p><strong>Tgl Order:</strong> {{ $transaksi->purchase_date }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p><strong>Total Pembayaran:</strong> {{ number_format($transaksi->gross_amount, 0, ',', '.') }} IDR</p>
                                        <p><strong>Payment Type:</strong> {{ $transaksi->payment_type }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        @php
                                            $kendaraanIds = explode(',', $transaksi->kendaraan_id);
                                            $kendaraans = \App\Models\Kendaraan::whereIn('id', $kendaraanIds)->get();
                                        @endphp
                                        @foreach ($kendaraans as $kendaraan)
                                            <p><strong>Detail:</strong> {{ $kendaraan->nama }} - {{ number_format($kendaraan->harga, 0, ',', '.') }} IDR</p>
                                            <p><strong>Quantity:</strong> {{ floor($transaksi->gross_amount / $kendaraan->harga) }}</p>
                                            @if ($feedbackStatuses[$transaksi->id][$kendaraan->id] === 'not_exists')
                                                <a href="{{ route('kendaraan.detail', $kendaraan->id) }}" class="btn btn-warning">Beri Feedback</a>
                                            @else
                                                <span class="badge badge-success">Feedback Diberikan</span>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-3">
                                        <p><strong>Status Transaksi:</strong> 
                                            @if ($transaksi->transaction_status == 'settlement')
                                                <span class="badge badge-success">Success</span>
                                            @else
                                                <span class="badge badge-warning">{{ $transaksi->transaction_status }}</span>
                                            @endif
                                        <button class="btn btn-primary mt-2 mx-5" onclick="printReceipt({{ $transaksi->id }})">Cetak Struk</button>
                                    </div>
                                </div>
                                <div class="text-right">  
                                    <div id="receipt-{{ $transaksi->id }}" class="d-none">
                                        <div class="receipt">
                                            <div class="header">
                                                <img src="https://via.placeholder.com/100" alt="Company Logo">
                                                <h1>Rental Kendaraan</h1>
                                                <p>Jln, Abc, Indonesia 123</p>
                                                <p>Telepon: (021) 12345678 | Email: info@perusahaan.com</p>
                                            </div>
                                            <h3>Struk Pembelian</h3>
                                            <div class="details">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <p><strong>Order ID</strong></p>
                                                    </div>
                                                    <div class="col-8">
                                                        <p>: {{ $transaksi->order_id }}</p>
                                                    </div>
                                                    <div class="col-4">
                                                        <p><strong>Tanggal Pembelian</strong></p>
                                                    </div>
                                                    <div class="col-8">
                                                        <p>: {{ $transaksi->purchase_date }}</p>
                                                    </div>
                                                    <div class="col-4">
                                                        <p><strong>Status Transaksi</strong></p>
                                                    </div>
                                                    <div class="col-8">
                                                        <p>: {{ $transaksi->transaction_status }}</p>
                                                    </div>
                                                    <div class="col-4">
                                                        <p><strong>Payment Type</strong></p>
                                                    </div>
                                                    <div class="col-8">
                                                        <p>: {{ $transaksi->payment_type }}</p>
                                                    </div>
                                                    <div class="col-4">
                                                        <p><strong>Detail Kendaraan</strong></p>
                                                    </div>
                                                    <div class="col-8">
                                                        @foreach ($kendaraans as $kendaraan)
                                                        <p>: {{ $kendaraan->nama }} - {{ number_format($kendaraan->harga, 0, ',', '.') }} IDR</p>
                                                        @endforeach
                                                    </div>
                                                    <div class="col-4">
                                                        <p><strong>Quantity</strong></p>
                                                    </div>
                                                    <div class="col-8">
                                                        @foreach ($kendaraans as $kendaraan)
                                                        <p>: {{ floor($transaksi->gross_amount / $kendaraan->harga) }}</p>
                                                        @endforeach
                                                    </div>
                                                    <div class="col-4">
                                                        <p><strong>Total Pembayaran</strong></p>
                                                    </div>
                                                    <div class="col-8">
                                                        <p>: {{ number_format($transaksi->gross_amount, 0, ',', '.') }} IDR</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="footer">
                                                <p>Terima kasih telah berbelanja bersama kami!</p>
                                                <p class="company-details">Rental Kendaraan</p>
                                                <p class="company-details">Jln, Abc, Indonesia 123</p>
                                                <p class="company-details">Telepon: (021) 12345678 | Email: info@perusahaan.com</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="row mt-2">
                <div class="col-md-11">
                    {{ $riwayatTransaksi->links('pagination::bootstrap-4') }}
                </div>
                <div class="col-md-1">
                    <a class="btn btn-danger float-end" href="{{ route('index') }}">Back</a>
                </div>
            </div>
           
        </div>

<script>
    function printReceipt(id) {
        var receiptContent = document.getElementById('receipt-' + id).innerHTML;
        var printWindow = window.open('', '_blank');
        printWindow.document.open();
        printWindow.document.write('<html><head><title>Print Receipt</title>');
        printWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">');
        printWindow.document.write('<style>.receipt {max-width: 800px;margin: 20px auto;padding: 20px;border: 1px solid #ddd;border-radius: 10px;background-color: #ffffff;font-family: Arial, sans-serif;box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);}.receipt .header, .receipt .footer {text-align: center;margin-bottom: 20px;}.receipt .header img {max-width: 100px;margin-bottom: 10px;}.receipt .header h1 {margin-bottom: 5px;font-size: 28px;color: #333;font-weight: bold;}.receipt .header p {margin: 0;font-size: 14px;color: #666;}.receipt h3 {margin-bottom: 20px;font-size: 24px;color: #333;text-align: center;border-bottom: 2px solid #007bff;padding-bottom: 10px;}.receipt .details p, .receipt .items p {margin: 5px 0;font-size: 16px;}.receipt .items p span {display: inline-block;min-width: 150px;font-weight: bold;}.receipt .footer p {font-size: 14px;color: #555;}.receipt .footer p.company-details {margin: 0;}</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(receiptContent);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>

