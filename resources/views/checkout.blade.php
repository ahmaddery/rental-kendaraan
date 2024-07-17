<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-x5zFqs3Rqxtf3rPn"></script>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
            position: relative;
        }

        h1 {
            margin-bottom: 30px;
            font-size: 26px;
            color: #333;
            position: relative;
        }

        h1::after {
            content: "";
            display: block;
            width: 60px;
            height: 3px;
            background-color: #007bff;
            margin: 10px auto 0;
            border-radius: 2px;
        }

        .order-summary {
            margin-bottom: 20px;
            border-top: 2px solid #007bff;
            padding-top: 20px;
            position: relative;
        }

        .order-summary h2 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #007bff;
        }

        .order-summary p {
            font-size: 16px;
            margin: 5px 0;
            color: #555;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .order-summary p strong {
            margin-right: 10px;
        }

        .order-summary p .icon {
            margin-right: 10px;
            color: #007bff;
        }

        .order-summary .total {
            font-weight: bold;
            font-size: 18px;
            margin-top: 10px;
            color: #28a745;
        }

        .pay-button, .back-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            margin-top: 10px;
            width: 100%;
            display: block;
        }

        .pay-button:hover, .back-button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .pay-button:active, .back-button:active {
            transform: scale(0.95);
        }

        .payment-info {
            text-align: left;
            margin-bottom: 20px;
        }

        .payment-info p {
            font-size: 14px;
            color: #777;
        }

        .payment-info .highlight {
            color: #007bff;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }

        .footer::before {
            content: "";
            display: block;
            width: 100px;
            height: 3px;
            background-color: #007bff;
            margin: 10px auto 20px;
            border-radius: 2px;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Checkout</h1>
        <div class="order-summary">
            <h2>Order Summary</h2>
            <p><span class="icon">&#128179;</span><strong>Order ID:</strong> {{ $payment->order_id }}</p>
            <p><span class="icon">&#128663;</span><strong>Kendaraan:</strong> {{ $payment->kendaraan->nama }}</p>
            <p><span class="icon">&#128176;</span><strong>Harga:</strong> Rp{{ number_format($payment->kendaraan->harga, 0, ',', '.') }}/ Hari</p>
            <p class="total"><span class="icon">&#128181;</span>Total: Rp{{ number_format($payment->gross_amount, 0, ',', '.') }}</p>
            @if(!empty($unavailableDates))
            <div class="unavailable-dates">
                <h2>Kendaraan Tidak Tersedia pada Tanggal-tanggal Berikut:</h2>
                <ul>
                    @foreach($unavailableDates as $unavailableDate)
                        <li>Dari {{ $unavailableDate['start'] }} hingga {{ $unavailableDate['end'] }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        </div>
        <div class="payment-info">
            <p><strong>Mohon pastikan semua detail telah benar sebelum melanjutkan pembayaran.</strong></p>
            <p class="highlight">Pengembalian dana tidak tersedia setelah pembayaran berhasil.</p>
        </div>
        <form id="payment-form" action="{{ route('payment.redirect') }}" method="POST">
            @csrf
            <input type="hidden" name="order_id" value="{{ $payment->order_id }}">
            <input type="hidden" name="transaction_status" id="transaction_status">
            <input type="hidden" name="status_code" id="status_code">
        </form>
        <button id="pay-button" class="pay-button">Selesaikan Pembayaran</button>
        <a href="{{ route('product') }}" class="back-button">Kembali</a>

        <div class="footer">
            <p>&copy; 2024. All rights reserved.</p>
        </div>
    </div>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay('{{$snapToken}}', {
                onSuccess: function(result) {
                    sendResultToServer(result);
                },
                onPending: function(result) {
                    sendResultToServer(result);
                },
                onError: function(result) {
                    alert("Payment failed!");
                    console.error(result);
                }
            });
        };

        function sendResultToServer(result) {
            document.getElementById('transaction_status').value = result.transaction_status;
            document.getElementById('status_code').value = result.status_code;
            document.getElementById('payment-form').submit();
        }
    </script>
</body>
</html>
