<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-x5zFqs3Rqxtf3rPn"></script>
</head>
<body>
    <div class="container">
        <h1>Checkout</h1>
        <div id="snap-form"></div>
    </div>

    <script type="text/javascript">
        snap.pay('{{$snapToken}}');
    </script>
</body>
</html>
