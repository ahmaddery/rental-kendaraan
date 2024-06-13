<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .receipt {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #ffffff;
            font-family: Arial, sans-serif;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .receipt .header, .receipt .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .receipt .header img {
            max-width: 100px;
            margin-bottom: 10px;
        }
        .receipt .header h1 {
            margin-bottom: 5px;
            font-size: 28px;
            color: #333;
            font-weight: bold;
        }
        .receipt .header p {
            margin: 0;
            font-size: 14px;
            color: #666;
        }
        .receipt h3 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
            text-align: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        .receipt .details p, .receipt .items p {
            margin: 5px 0;
            font-size: 16px;
        }
        .receipt .items p span {
            display: inline-block;
            min-width: 150px;
            font-weight: bold;
        }
        .receipt .footer p {
            font-size: 14px;
            color: #555;
        }
        .receipt .footer p.company-details {
            margin: 0;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .badge {
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-5 text-center">Riwayat Transaksi</h1>
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
                    <div class="card mb-4">
                        <div class="card-header">
                            <strong>Order ID:</strong> {{ $transaksi->order_id }}
                        </div>
                        <div class="card-body row">
                            <div class="col-md-6">
                                <p><strong>Tanggal Pembelian:</strong> {{ $transaksi->purchase_date }}</p>
                                <p><strong>Status Transaksi:</strong> 
                                    @if ($transaksi->transaction_status == 'settlement')
                                        <span class="badge badge-success">Success</span>
                                    @else
                                        <span class="badge badge-warning">{{ $transaksi->transaction_status }}</span>
                                    @endif
                                </p>
                                <p><strong>Total Pembayaran:</strong> {{ number_format($transaksi->gross_amount, 0, ',', '.') }} IDR</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Payment Type:</strong> {{ $transaksi->payment_type }}</p>
                                @php
                                    $kendaraanIds = explode(',', $transaksi->kendaraan_id);
                                    $kendaraans = \App\Models\Kendaraan::whereIn('id', $kendaraanIds)->get();
                                @endphp
                                @foreach ($kendaraans as $kendaraan)
                                <p><strong>Detail Kendaraan:</strong> {{ $kendaraan->nama }} - {{ number_format($kendaraan->harga, 0, ',', '.') }} IDR</p>
                                @endforeach
                                @foreach ($kendaraans as $kendaraan)
                                <p><strong>Quantity:</strong> {{ floor($transaksi->gross_amount / $kendaraan->harga) }}</p>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary" onclick="printReceipt({{ $transaksi->id }})">Cetak Struk</button>
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
                                                @foreach ($kendaraans as $kendaraan)
                                                <p>: {{ number_format($transaksi->gross_amount, 0, ',', '.') }} IDR</p>
                                                @endforeach
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
    <a class="btn btn-danger" href="{{ route('index') }}">back</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
</body>
</html>
