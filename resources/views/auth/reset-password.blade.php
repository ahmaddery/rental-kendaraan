<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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

        .form-section, .image-section {
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

        .input-group .error {
            color: red;
            font-size: 0.875em;
            margin-top: 5px;
        }

        .form-btn {
            width: 100%;
            padding: 10px;
            background: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .form-btn:hover {
            background: #45a049;
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
        <div class="card animate__animated animate__fadeIn">
            <div class="form-section col-12 col-md-6">
                <h1>Reset Password</h1>
                <p>Please enter your email address and a new password.</p>
                
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="input-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" placeholder="Enter your email" value="{{ old('email', $request->email) }}" required readonly autofocus>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>                    

                    <div class="input-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" placeholder="Enter new password" required>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="input-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm new password" required>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <button type="submit" class="form-btn">{{ __('Reset Password') }}</button>
                </form>
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
        // Show loading animation when the page is loaded
        Swal.fire({
            title: "",
            text: "Loading...",
            imageUrl: "https://media.tenor.com/wpSo-8CrXqUAAAAi/loading-loading-forever.gif",
            imageAlt: "Loading animation",
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false
        });

        window.addEventListener('load', function() {
            setTimeout(function() {
                // Hide loading animation
                Swal.close();
            }, 500);
        });
    </script>
</body>

</html>
