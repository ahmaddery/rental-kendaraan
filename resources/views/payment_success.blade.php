<!DOCTYPE html>
<html>
<head>
    <title>Status Transaksi {{ $payment->transaction_status }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            color: #333;
        }
        .badge-warning {
            color: #856404;
            background-color: #fff3cd;
        }
        .badge-success {
            color: #155724;
            background-color: #d4edda;
        }
        .card {
            border: none;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 20px;
        }
        .card-header {
            background-color: #f1f1f1;
            padding: 20px;
        }
        .card-header h1 {
            font-size: 24px;
            margin: 0;
        }
        .card-body {
            padding: 20px;
        }
        .col-6 img {
            max-width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .details-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .details-row strong {
            margin-right: 10px;
        }
        .btn {
            padding: 10px 20px;
            border-radius: 50px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-warning {
            background-color: #ffc107;
            border: none;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
        .form-group input {
            border-radius: 50px;
            padding: 10px 15px;
            border: 1px solid #ced4da;
        }
        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
            border-radius: 8px;
            padding: 15px;
        }
        footer {
            margin-top: 50px;
            text-align: center;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header text-center">
                <h1>
                    @if ($payment->transaction_status == 'settlement')
                    <span class="badge badge-success">Pembayaran Berhasil</span>
                    @else
                    <span class="badge badge-warning">{{ $payment->transaction_status }}</span>
                    @endif
                </h1>
            </div>
            <div class="card-body row">
                <div class="col-6 text-center">
                    @php
                    $kendaraanIds = explode(',', $payment->kendaraan_id);
                    $kendaraans = \App\Models\Kendaraan::whereIn('id', $kendaraanIds)->get();
                    @endphp
                    @foreach ($kendaraans as $kendaraan)
                    <img src="{{ $kendaraan->image }}" alt="{{ $kendaraan->nama }}" class="img-fluid mb-4">
                    @endforeach
                </div>
                <div class="col-6">
                    <div class="details-row">
                        <strong>Order ID:</strong>
                        <span>{{ $payment->order_id }}</span>
                    </div>
                    <div class="details-row">
                        <strong>Tanggal Pembelian:</strong>
                        <span>{{ date('d F Y, H:i', strtotime($payment->purchase_date)) }}</span>
                    </div>
                    <div class="details-row mb-4">
                        <strong>Status Transaksi:</strong>
                        @if ($payment->transaction_status == 'settlement')
                        <span class="badge badge-success">Success</span>
                        @else
                        <span class="badge badge-warning">{{ $payment->transaction_status }}</span>
                        @endif
                    </div>
                    @foreach ($kendaraans as $kendaraan)
                    <div class="details-row">
                        <strong>Kendaraan:</strong>
                        <span>{{ $kendaraan->nama }}</span>
                    </div>
                    <div class="details-row">
                        <strong>Harga:</strong>
                        <span>Rp. {{ number_format($kendaraan->harga, 2, ',', '.') }} / Hari</span>
                    </div>
                    <div class="details-row">
                        <strong>Durasi Penyewaan:</strong>
                        <span>{{ floor($payment->gross_amount / $kendaraan->harga) }} Hari</span>
                    </div>
                    @endforeach
                </div>
                <div class="col-12 mt-4">
                    @if ($payment->transaction_status == 'settlement')
                    @if (!$isVehicleTaken)
                    <h2 class="text-center">Pilih Tanggal Pengambilan</h2>
                    <form action="{{ route('pengambilan.store') }}" method="POST" id="pickUpForm">
                        @csrf
                        <div class="form-group mb-4">
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <input type="hidden" name="kendaraan_id" value="{{ $payment->kendaraan_id }}">
                            <input type="hidden" name="order_id" value="{{ $payment->order_id }}">
                            <label for="tanggal_pengambilan" class="font-bold">Pilih tanggal pengambilan:</label>
                            <input type="date" id="tanggal_pengambilan" name="tanggal_pengambilan" class="form-control" required min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group mb-4">
                            <label for="tanggal_pengembalian" class="font-bold">Tanggal Pengembalian: *Diisi Otomatis</label>
                            <input type="date" id="tanggal_pengembalian" name="tanggal_pengembalian" class="form-control" readonly>
                        </div>
                        <p class="alert alert-info">
                            Pastikan Anda telah memilih tanggal dengan benar. Tanggal tidak dapat diubah setelah ditentukan.
                            Kami telah mengirimkan detail transaksi Anda. Silakan cek email untuk informasi lebih lanjut.
                        </p>
                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    </form>
                    @else
                    <p class="text-success text-center">Anda telah menentukan Tanggal pengambilan kendaraan</p>
                    @endif
                    @else
                    <h2 class="text-center">Ulangi Pembayaran</h2>
                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                        <button type="submit" class="btn btn-warning btn-block">Ulangi Pembayaran</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <a href="{{ route('index') }}" class="btn btn-secondary mt-5 d-block mx-auto" style="max-width: 200px;">Kembali</a>
    </div>

    <footer class="mt-10">
        <p>&copy; 2024. All rights reserved.</p>
    </footer>

    <script>
        var duration = {{ $duration }};
        document.getElementById('tanggal_pengambilan').addEventListener('change', function() {
            var pickUpDate = new Date(this.value);
            pickUpDate.setDate(pickUpDate.getDate() + duration);
            var year = pickUpDate.getFullYear();
            var month = String(pickUpDate.getMonth() + 1).padStart(2, '0');
            var day = String(pickUpDate.getDate()).padStart(2, '0');
            var formattedDate = `${year}-${month}-${day}`;
            document.getElementById('tanggal_pengembalian').value = formattedDate;
        });

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

        // Tampilkan animasi loading saat mengirimkan formulir
        document.getElementById('pickUpForm').addEventListener('submit', function() {
            Swal.fire({
                title: "",
                text: "Mengirim data...",
                imageUrl: "https://media.tenor.com/wpSo-8CrXqUAAAAi/loading-loading-forever.gif",
                imageAlt: "Loading animation",
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false
            });
        });
    </script>
</body>
</html>
