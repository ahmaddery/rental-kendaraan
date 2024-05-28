<!DOCTYPE html>
<html>
<head>
    <title>Payment {{ $payment->transaction_status }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
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
        footer {
            margin-top: 50px;
            text-align: center;
            color: #6c757d;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mt-10">
        <div class="card shadow-lg">
            <div class="card-header bg-blue-500 text-white">
                <h1 class="text-xl font-bold">Payment 
                    @if ($payment->transaction_status == 'settlement')
                        <span class="badge badge-success">Success</span>
                    @else
                        <span class="badge badge-warning">{{ $payment->transaction_status }}</span>
                    @endif
                </h1>
            </div>
            <div class="card-body p-6">
                <p class="card-text mb-4">Thank you for your payment!</p>
                <p class="card-text"><strong>Order ID:</strong> {{ $payment->order_id }}</p>
                <p class="card-text"><strong>Tanggal Pembelian: {{ date('d F Y, H:i', strtotime($payment->purchase_date)) }}</strong></p>
                <p class="card-text mb-4"><strong>Transaction Status:</strong> 
                    @if ($payment->transaction_status == 'settlement')
                        <span class="badge badge-success">Success</span>
                    @else
                        <span class="badge badge-warning">{{ $payment->transaction_status }}</span>
                    @endif
                </p>
                <ul class="list-group mb-4">
                    @php
                        $kendaraanIds = explode(',', $payment->kendaraan_id);
                        $kendaraans = \App\Models\Kendaraan::whereIn('id', $kendaraanIds)->get();
                    @endphp
                    @foreach ($kendaraans as $kendaraan)
                        <li class="list-group-item">
                            <strong>Kendaraan:</strong> {{ $kendaraan->nama }}<br>
                            <strong>Price:</strong> Rp. {{ number_format($kendaraan->harga, 0, ',', '.') }} / Hari<br>
                            <strong>Durasi Penyewaan:</strong> {{ floor($payment->gross_amount / $kendaraan->harga) }} days<br>
                        </li>
                    @endforeach
                </ul>

                @if ($payment->transaction_status == 'settlement')
                    @if (!$isVehicleTaken)
                        <h2 class="mt-4 mb-4 text-xl font-semibold">Pick Up Vehicle:</h2>
                        <form action="{{ route('pengambilan.store') }}" method="POST" id="pickUpForm">
                            @csrf
                            <div class="form-group mb-4">
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                <input type="hidden" name="kendaraan_id" value="{{ $payment->kendaraan_id }}">
                                <input type="readonly" name="order_id" value="{{ $payment->order_id }}" readonly>
                                <label for="tanggal_pengambilan" class="block font-bold mb-2">Pick Up Date:</label>
                                <input type="date" id="tanggal_pengambilan" name="tanggal_pengambilan" class="form-control" required min="{{ date('Y-m-d') }}">
                            </div>
                            <div class="form-group mb-4">
                                <label for="tanggal_pengembalian" class="block font-bold mb-2">Return Date:</label>
                                <input type="date" id="tanggal_pengembalian" name="tanggal_pengembalian" class="form-control" readonly>
                            </div>
                            <button type="submit" class="btn btn-primary">Pick Up</button>
                        </form>
                    @else
                        <p class="text-success">Anda telah menentukan Tanggal pengambilan kendaraan</p>
                    @endif
                @else
                    <h2 class="mt-4 mb-4 text-xl font-semibold">Retry Payment</h2>
                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                        <button type="submit" class="btn btn-warning">Retry Payment</button>
                    </form>
                @endif
            </div>
        </div>
        <a href="{{ route('index') }}" class="btn btn-secondary mt-6">Return to Home</a>
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
    </script>
</body>
</html>
