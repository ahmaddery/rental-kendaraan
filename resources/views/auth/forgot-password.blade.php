<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
                <h1>Forgot Password</h1>
                <p>No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                
                <form id="forgotPasswordForm" method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="input-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" placeholder="Enter your email" required autofocus>
                        <!-- Removed the old error handling here -->
                    </div>

                    <div class="input-group">
                        <label for="captcha">Captcha: <span id="captchaQuestion"></span></label>
                        <input id="captcha" type="text" name="captcha" placeholder="Answer the question" required>
                        <span class="error" id="captchaError"></span>
                    </div>

                    <button type="submit" class="form-btn">{{ __('Email Password Reset Link') }}</button>
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
        function generateCaptcha() {
            const num1 = Math.floor(Math.random() * 10);
            const num2 = Math.floor(Math.random() * 10);
            const question = `${num1} + ${num2} = ?`;
            document.getElementById('captchaQuestion').textContent = question;
            return num1 + num2;
        }

        let captchaAnswer = generateCaptcha();

        document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            const captchaInput = document.getElementById('captcha').value;
            if (parseInt(captchaInput) !== captchaAnswer) {
                document.getElementById('captchaError').textContent = "Incorrect answer. Please try again.";
                captchaAnswer = generateCaptcha(); // Regenerate the captcha
            } else {
                document.getElementById('captchaError').textContent = "";

                // Show loading animation
                Swal.fire({
                    title: "",
                    text: "Sending reset email...",
                    imageUrl: "https://media.tenor.com/wpSo-8CrXqUAAAAi/loading-loading-forever.gif",
                    imageAlt: "Loading animation",
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false
                });

                // Use AJAX to submit the form
                const formData = new FormData(e.target);
                fetch(e.target.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    Swal.close(); // Close the loading animation

                    if (response.ok) {
                        return response.json();
                    } else {
                        throw response;
                    }
                })
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Email Sent',
                            text: 'Password reset email has been sent successfully!'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'There was an error sending the email. Please try again.'
                        });
                    }
                })
                .catch(error => {
                    error.json().then(errData => {
                        let errorMessage = 'There was an error sending the email. Please try again.';
                        if (errData.errors && errData.errors.email) {
                            errorMessage = errData.errors.email[0];
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMessage
                        });
                    });
                });
            }
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
    </script>
</body>

</html>
