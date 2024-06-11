<!DOCTYPE html>
<html>
<head>
    <title>Pick-Up Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .receipt {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .receipt h1 {
            text-align: center;
            font-size: 28px;
            color: #333;
        }
        .receipt p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }
        .receipt .highlight {
            color: #e67e22;
        }
        .receipt table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .receipt table, .receipt th, .receipt td {
            border: 1px solid #ddd;
        }
        .receipt th, .receipt td {
            padding: 12px;
            text-align: left;
        }
        .receipt th {
            background-color: #f7f7f7;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <h1>Rincian Pemesanan Anda</h1>
        <p><strong>ID Pesanan:</strong> <span class="highlight">{{ $order->order_id }}</span></p>
        <p><strong>Tanggal Pemesanan:</strong> {{ date('d F Y, H:i', strtotime($order->created_at)) }}</p>
        <p><strong>Status Transaksi:</strong> <span class="highlight">berhasil</span></p>
        
        <!-- Calculate total payment -->
        @php
            $total_payment = 0;
            foreach ($kendaraans as $kendaraan) {
                $total_payment += $kendaraan->harga * $duration;
            }
        @endphp
        
        <p><strong>Total Pembayaran:</strong> <span class="highlight">Rp. {{ number_format($total_payment, 0, ',', '.') }}</span></p>
        
        <table>
            <thead>
                <tr>
                    <th>Kendaraan</th>
                    <th>Harga</th>
                    <th>Durasi Penyewaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kendaraans as $kendaraan)
                    <tr>
                        <td>{{ $kendaraan->nama }}</td>
                        <td>Rp. {{ number_format($kendaraan->harga, 0, ',', '.') }} / Hari</td>
                        <td>{{ $duration }} hari</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p><strong>Tanggal Penjemputan:</strong> {{ $pickUpDate }}</p>
        <p><strong>Tanggal Pengembalian:</strong> {{ $returnDate }}</p>
    </div>
    <div class="footer">
        <p>Terima kasih telah menggunakan layanan kami. Selamat menikmati perjalanan Anda!</p>
    </div>
</body>
</html>
<script>
    // Tampilkan animasi loading saat halaman dimuat
    Swal.fire({
        title: "",
        text: "Memuat data...",
        imageUrl: "https://media.tenor.com/wpSo-8CrXqUAAAAi/loading-loading-forever.gif",
        imageAlt: "Loading animation",
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false
    });

    window.addEventListener('load', function() {
        setTimeout(function() {
            // Sembunyikan animasi loading
            Swal.close();
        }, 500);
    });
</script>