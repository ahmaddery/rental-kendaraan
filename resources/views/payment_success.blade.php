<!DOCTYPE html>
<html>
<head>
    <title>Payment Success</title>
</head>
<body>
    <h1>Payment Successful</h1>
    <p>Thank you for your payment!</p>
    <p>Order ID: {{ $payment->order_id }}</p>
    <p>Transaction Status: 
        @if ($payment->transaction_status == 'settlement')
            <span class="badge badge-success">Success</span>
        @else
            <span class="badge badge-warning">{{ $payment->transaction_status }}</span>
        @endif
    </p>

    <ul>
        @php
            $kendaraanIds = explode(',', $payment->kendaraan_id);
            $kendaraans = \App\Models\Kendaraan::whereIn('id', $kendaraanIds)->get();
        @endphp
        @foreach ($kendaraans as $kendaraan)
            <p>Duration: {{ floor($payment->gross_amount / $kendaraan->harga) }} days</p>
        @endforeach
    </ul>

    <!-- Form for taking vehicle -->
    <h2>Pick Up Vehicle:</h2>
    <form action="{{ route('pengambilan.store') }}" method="POST" id="pickUpForm">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <input type="hidden" name="kendaraan_id" value="{{ $payment->kendaraan_id }}">
        <label for="tanggal_pengambilan">Pick Up Date:</label>
        <input type="date" id="tanggal_pengambilan" name="tanggal_pengambilan" required min="{{ date('Y-m-d') }}">
        <label for="tanggal_pengembalian">Return Date:</label>
        <input type="date" id="tanggal_pengembalian" name="tanggal_pengembalian" readonly>
        <button type="submit">Pick Up</button>
    </form>

    <a href="{{ route('index') }}">Return to Home</a>

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
