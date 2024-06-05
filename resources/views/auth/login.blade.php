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

        body,
        html {
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

        .form-section,
        .image-section {
            flex: 1;
        }

        .form-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 50px;
            background: #fff;
        }

        .form-section h1 {
            margin-bottom: 10px;
        }

        .form-section p {
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

        .forgot-password {
            color: #007bff;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .form-btn {
            width: 100%;
            padding: 10px;
            background: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-btn:hover {
            background: #45a049;
        }

        .toggle-link {
            margin-top: 20px;
            text-align: center;
        }

        .toggle-link a {
            color: #007bff;
            text-decoration: none;
        }

        .toggle-link a:hover {
            text-decoration: underline;
        }

        .image-section {
            display: none;
        }

        @media (min-width: 768px) {
            .image-section {
                display: block;
                background: url('/assets/images/backgrounds/sample1.jpg') no-repeat center center;
                background-size: cover;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="form-section col-12 col-md-6">
                <!-- Login Form -->
                <div id="login-form">
                    <h1>Selamat Datang!</h1>
                    <p>Silahkan masuk jika sudah memiliki account</p>
                    <form method="POST" action="{{ route('login') }}">
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
                        <button type="submit" class="form-btn">Login</button>
                    </form>
                    <div class="toggle-link">
                        <p>Don't have an account? <a href="#" id="show-register">Sign Up</a></p>
                    </div>
                </div>
<!-- Register Form -->
<div id="register-form" style="display: none;">
    <h1>Register</h1>
    <p>Silahkan daftar untuk membuat account baru</p>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <!-- Name -->
        <div class="input-group">
            <label for="register-name">Name</label>
            <input type="text" id="register-name" name="name" value="{{ old('name') }}" placeholder="Enter your name" required autofocus autocomplete="name">
            @if ($errors->has('name'))
                <span class="error">{{ $errors->first('name') }}</span>
            @endif
        </div>
        
        <!-- Email Address -->
        <div class="input-group">
            <label for="register-email">Email address</label>
            <input type="email" id="register-email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required autocomplete="username">
            @if ($errors->has('email'))
                <span class="error">{{ $errors->first('email') }}</span>
            @endif
        </div>
        
        <!-- Password -->
        <div class="input-group">
            <label for="register-password">Password</label>
            <input type="password" id="register-password" name="password" placeholder="Enter your password" required autocomplete="new-password">
            @if ($errors->has('password'))
                <span class="error">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <!-- Confirm Password -->
        <div class="input-group">
            <label for="register-password-confirm">Confirm Password</label>
            <input type="password" id="register-password-confirm" name="password_confirmation" placeholder="Confirm your password" required autocomplete="new-password">
            @if ($errors->has('password_confirmation'))
                <span class="error">{{ $errors->first('password_confirmation') }}</span>
            @endif
        </div>

        <button type="submit" class="form-btn">Register</button>
    </form>
    
    <div class="toggle-link">
        <p>Already have an account? <a href="#" id="show-login">Login</a></p>
    </div>
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
    <script>
        document.getElementById('show-register').addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('login-form').style.display = 'none';
            document.getElementById('register-form').style.display = 'block';
        });

        document.getElementById('show-login').addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('register-form').style.display = 'none';
            document.getElementById('login-form').style.display = 'block';
        });
    </script>
</body>

</html>
