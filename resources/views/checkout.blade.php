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
        }
        h1 {
            margin-bottom: 30px;
            font-size: 26px;
            color: #333;
        }
        .order-summary {
            margin-bottom: 20px;
        }
        .order-summary h2 {
            font-size: 20px;
            margin-bottom: 15px;
        }
        .order-summary p {
            font-size: 16px;
            margin: 5px 0;
        }
        .order-summary .total {
            font-weight: bold;
            font-size: 18px;
            margin-top: 10px;
            color: #007bff;
        }
        .pay-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .pay-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <h1>Checkout</h1>
        <div class="order-summary">
            <h2>Order Summary</h2>
            <p>Order ID: {{ $payment->order_id }}</p>
            <p>Kendaraan: {{ $payment->kendaraan->nama }}</p>
            <p>Harga: {{ $payment->kendaraan->harga }}/ Hari</p>
            <p class="total">Total: Rp{{ $payment->gross_amount }}</p>
        </div>
        <form id="payment-form" action="{{ route('payment.redirect') }}" method="POST">
            @csrf
            <input type="hidden" name="order_id" value="{{ $payment->order_id }}">
            <input type="hidden" name="transaction_status" id="transaction_status">
            <input type="hidden" name="status_code" id="status_code">
        </form>
        <button id="pay-button" class="pay-button btn-lg btn-block">Complete Payment</button>
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
