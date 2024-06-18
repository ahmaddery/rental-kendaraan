<!DOCTYPE html>
<html>
<head>
    <title>Payment {{ $payment->transaction_status }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .badge-warning {
            color: #856404;
            background-color: #fff3cd;
        }

        .badge-success {
            color: #155724;
            background-color: #d4edda;
        }

        .card-body .col-6 {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        footer {
            margin-top: 50px;
            text-align: center;
            color: #6c757d;
        }

    </style>
</head>
<body class="bg-gray-100">
    <div class="container mt-10">
        <div class="card m-0 p-0 col-md-12 shadow-lg">
            <div class="card-header bg-light">
                <h1 class="text-center">
                    @if ($payment->transaction_status == 'settlement')
                    <span class="badge badge-success text-xl font-bold ">Payment Success</span>
                    @else
                    <span class="badge badge-warning">{{ $payment->transaction_status }}</span>
                    @endif
                </h1>
            </div>
            <div class="card-body row">
                <div class="col-6 ">
                    @php
                    $kendaraanIds = explode(',', $payment->kendaraan_id);
                    $kendaraans = \App\Models\Kendaraan::whereIn('id', $kendaraanIds)->get();
                    @endphp
                    @foreach ($kendaraans as $kendaraan)
                    <img src="{{ $kendaraan->image }}" alt="{{ $kendaraan->nama }}" class="img-fluid mb-4">
                    @endforeach
                </div>
                <div class="col-6 bg-light">
                    <p class="card-text"><strong>Order ID:</strong> {{ $payment->order_id }}</p>
                    <p class="card-text"><strong>Tanggal Pembelian: {{ date('d F Y, H:i', strtotime($payment->purchase_date)) }}</strong></p>
                    <p class="card-text mb-4"><strong>Status Transaksi:</strong>
                        @if ($payment->transaction_status == 'settlement')
                        <span class="badge badge-success">Success</span>
                        @else
                        <span class="badge badge-warning">{{ $payment->transaction_status }}</span>
                        @endif
                    </p>
                    @php
                    $kendaraanIds = explode(',', $payment->kendaraan_id);
                    $kendaraans = \App\Models\Kendaraan::whereIn('id', $kendaraanIds)->get();
                    @endphp
                    @foreach ($kendaraans as $kendaraan)
                    <p><strong>Kendaraan:</strong> {{ $kendaraan->nama }}</p>
                    <p><strong>Harga:</strong> Rp. {{ number_format($kendaraan->harga, 2, ',', '.') }} / Hari</p>
                    <p><strong>Durasi Penyewaan:</strong> {{ floor($payment->gross_amount / $kendaraan->harga) }} Hari</p>
                    @endforeach
                </div>
                <div class="col-12 mt-2 bg-light">
                    @if ($payment->transaction_status == 'settlement')
                    @if (!$isVehicleTaken)
                    <h2 class="mt-4 mb-4 text-xl font-semibold">Pilih Tanggal Pengambilan:</h2>
                    <form action="{{ route('pengambilan.store') }}" method="POST" id="pickUpForm">
                        @csrf
                        <div class="form-group mb-4">
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <input type="hidden" name="kendaraan_id" value="{{ $payment->kendaraan_id }}">
                            <input type="hidden" name="order_id" value="{{ $payment->order_id }}" hidden>
                            <label for="tanggal_pengambilan" class="block font-bold mb-2">Pilih tanggal pengambilan:</label>
                            <input type="date" id="tanggal_pengambilan" name="tanggal_pengambilan" class="form-control" required min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group mb-4">
                            <label for="tanggal_pengembalian" class="block font-bold mb-2">Tanggal Pengembalian: *Diisi Otomatis</label>
                            <input type="date" id="tanggal_pengembalian" name="tanggal_pengembalian" class="form-control" readonly>
                        </div>
                        <p class="alert alert-info">
                            Pastikan Anda telah memilih tanggal dengan benar. Tanggal tidak dapat diubah setelah ditentukan.
                            Kami telah mengirimkan detail transaksi Anda. Silakan cek email untuk informasi lebih lanjut.
                        </p>
                        
                        <button type="submit" class="btn btn-primary d-flex justify-content-center">simpan</button>
                    </form>
                    @else
                    <p class="text-success">Anda telah menentukan Tanggal pengambilan kendaraan</p>
                    @endif
                    @else
                    <h2 class="mt-4 mb-4 text-xl font-semibold">Ulangi Pembayaran</h2>
                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                        <button type="submit" class="btn btn-warning">Ulangi Pembayaran</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <a href="{{ route('index') }}" class="btn btn-secondary mt-6">Kembali</a>
    </div>

    <footer class="mt-10 text-gray-600">
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
