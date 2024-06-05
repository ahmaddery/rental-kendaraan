<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body, html {
            height: 100%;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            padding: 15px;
        }

        .card {
            display: flex;
            flex-direction: row;
            width: 100%;
            max-width: 900px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .login-section, .image-section {
            flex: 1;
        }

        .login-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 50px;
            background: #fff;
        }

        .login-section h1 {
            margin-bottom: 10px;
        }

        .login-section p {
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 5px;
        }

        .forgot-password {
            color: #007bff;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            padding: 10px;
            background: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-btn:hover {
            background: #45a049;
        }

        .signup-link {
            margin-top: 20px;
            text-align: center;
        }

        .signup-link a {
            color: #007bff;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .image-section {
            display: none; /* Initially hide on all screens */
        }

        @media (min-width: 768px) {
            .image-section {
                display: block; /* Show on tablets and larger screens */
                background: url('/assets/images/backgrounds/sample1.jpg') no-repeat center center;
                background-size: cover;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="login-section col-12 col-md-6">
                <h1>Selamat Datang!</h1>
                <p>Silahkan masuk jika sudah memiliki account</p>
                <form method="POST" action="{{ route('login') }}" class="login">
                    @csrf
                    <div class="input-group">
                        <label for="email">Email address</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email">
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password">
                    </div>
                    <div class="actions">
                        <a href="{{ route('password.request') }}" class="forgot-password">forgot password</a>
                    </div>
                    <button type="submit" class="login-btn">Login</button>
                </form>
                <div class="signup-link">
                    <p>Don't have an account? <a href="{{ route('register') }}">Sign Up</a></p>
                </div>
            </div>
            <div class="image-section col-12 col-md-6">
                <!-- Image will be displayed only on tablets and larger screens -->
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
