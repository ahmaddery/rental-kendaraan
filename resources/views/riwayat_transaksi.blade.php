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
        .table th, .table td {
            vertical-align: middle;
        }
        .table th {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">Riwayat Transaksi</h1>

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
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Tanggal Pembelian</th>
                        <th>Status Transaksi</th>
                        <th>Total Pembayaran</th>
                        <th>Payment Type</th>
                        <th>Detail Kendaraan</th>
                        <th>Quantity</th>
                        <th>Cetak Struk</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayatTransaksi as $transaksi)
                        <tr>
                            <td>{{ $transaksi->order_id }}</td>
                            <td>{{ $transaksi->purchase_date }}</td>
                            <td>
                                @if ($transaksi->transaction_status == 'settlement')
                                    <span class="badge badge-success">Success</span>
                                @else
                                    <span class="badge badge-warning">{{ $transaksi->transaction_status }}</span>
                                @endif
                            </td>
                            <td>{{ number_format($transaksi->gross_amount, 0, ',', '.') }} IDR</td>
                            <td>{{ $transaksi->payment_type }}</td>
                            <td>
                                @php
                                    $kendaraanIds = explode(',', $transaksi->kendaraan_id);
                                    $kendaraans = \App\Models\Kendaraan::whereIn('id', $kendaraanIds)->get();
                                @endphp
                                @foreach ($kendaraans as $kendaraan)
                                    <p>{{ $kendaraan->nama }} - {{ number_format($kendaraan->harga, 0, ',', '.') }} IDR</p>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($kendaraans as $kendaraan)
                                    <p>{{ floor($transaksi->gross_amount / $kendaraan->harga) }}</p>
                                @endforeach
                            </td>
                            <td>
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
                                            <p><strong>Order ID:</strong> {{ $transaksi->order_id }}</p>
                                            <p><strong>Tanggal Pembelian:</strong> {{ $transaksi->purchase_date }}</p>
                                            <p><strong>Status Transaksi:</strong> {{ $transaksi->transaction_status }}</p>
                                            <p><strong>Payment Type:</strong> {{ $transaksi->payment_type }}</p>
                                        </div>
                                        <div class="items">
                                            <p><strong>Detail Kendaraan:</strong></p>
                                            @foreach ($kendaraans as $kendaraan)
                                                <p><span>{{ $kendaraan->nama }}</span> - {{ number_format($kendaraan->harga, 0, ',', '.') }} IDR</p>
                                            @endforeach
                                        </div>
                                        <div class="items">
                                            <p><strong>Quantity:</strong></p>
                                            @foreach ($kendaraans as $kendaraan)
                                                <p>{{ floor($transaksi->gross_amount / $kendaraan->harga) }}</p>
                                                <p><strong>Total Pembayaran:</strong> {{ number_format($transaksi->gross_amount, 0, ',', '.') }} IDR</p>
                                            @endforeach
                                        </div>
                                        <div class="footer">
                                            <p>Terima kasih telah berbelanja bersama kami!</p>
                                            <p class="company-details">Rental Kendaraan</p>
                                            <p class="company-details">Jln, Abc, Indonesia 123</p>
                                            <p class="company-details">Telepon: (021) 12345678 | Email: info@perusahaan.com</p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
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
        printWindow.document.write('<style>.receipt {max-width: 800px;margin: 20px auto;padding: 20px;border: 1px solid #ddd;border-radius: 10px;background-color: #ffffff;font-family: Arial, sans-serif;box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);} .receipt .header, .receipt .footer {text-align: center;margin-bottom: 20px;} .receipt .header img {max-width: 100px;margin-bottom: 10px;} .receipt .header h1 {margin-bottom: 5px;font-size: 28px;color: #333;font-weight: bold;} .receipt .header p {margin: 0;font-size: 14px;color: #666;} .receipt h3 {margin-bottom: 20px;font-size: 24px;color: #333;text-align: center;border-bottom: 2px solid #007bff;padding-bottom: 10px;} .receipt .details p, .receipt .items p {margin: 5px 0;font-size: 16px;} .receipt .items p span {display: inline-block;min-width: 150px;font-weight: bold;} .receipt .footer p {font-size: 14px;color: #555;} .receipt .footer p.company-details {margin: 0;} .btn-primary {background-color: #007bff;border-color: #007bff;} .badge {font-size: 14px;} .table th, .table td {vertical-align: middle;} .table th {background-color: #007bff;color: #fff;}</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(receiptContent);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>
</body>
</html>
