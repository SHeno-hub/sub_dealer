<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Sub-Dealer Portal</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f6f8;
            height: 100vh;
            width: 100%;
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            z-index: 0;
        }

        .circle-1 {
            width: 380px;
            height: 380px;
            background: linear-gradient(135deg, #4facfe, #1a73c7);
            top: -80px;
            right: 15%;
            animation: float1 6s ease-in-out infinite;
        }

        .circle-2 {
            width: 380px;
            height: 380px;
            background: linear-gradient(135deg, #a8d0f0, #4a90d9);
            bottom: -150px;
            left: 25%;
            animation: float2 7s ease-in-out infinite;
        }

        .dot {
            position: absolute;
            border-radius: 50%;
            background: #3ba7e0;
            z-index: 0;
        }

        .dot-1 {
            width: 16px;
            height: 16px;
            top: 45%;
            right: 27%;
            animation: float3 5s ease-in-out infinite;
        }

        .dot-2 {
            width: 20px;
            height: 20px;
            top: 60%;
            left: 25%;
            animation: float4 5.5s ease-in-out infinite;
        }

        @keyframes float1 {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-15px, 20px); }
        }

        @keyframes float2 {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(15px, -20px); }
        }

        @keyframes float3 {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-10px, 10px); }
        }

        @keyframes float4 {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(10px, -10px); }
        }

        .login-card {
            position: relative;
            z-index: 1;
            background: #fff;
            width: 400px;
            padding: 40px 40px 30px;
            border-radius: 6px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        .login-card img.logo {
            max-width: 220px;
            margin-bottom: 20px;
        }

        .login-card h1 {
            font-size: 22px;
            font-weight: 700;
            color: #222;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 18px;
            text-align: left;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d5dbe0;
            border-radius: 4px;
            font-size: 14px;
            color: #333;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            border-color: #1a73c7;
        }

        .form-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 20px;
            margin-bottom: 25px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #555;
        }

        .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #1a73c7;
            cursor: pointer;
        }

        .btn-login {
            background: #1a73c7;
            color: #fff;
            border: none;
            padding: 10px 28px;
            border-radius: 4px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-login:hover {
            background: #14589c;
        }

        .forgot-password {
            display: block;
            margin-top: 5px;
            font-size: 14px;
            font-weight: 600;
            color: #222;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .error-message {
            background: #fdecea;
            color: #b3261e;
            padding: 10px 14px;
            border-radius: 4px;
            font-size: 13px;
            margin-bottom: 18px;
            text-align: left;
        }
    </style>
</head>
<body>

    <div class="circle circle-1"></div>
    <div class="circle circle-2"></div>
    <div class="dot dot-1"></div>
    <div class="dot dot-2"></div>

    <div class="login-card">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">

        <h1>SUB-DEALER PORTAL</h1>

        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <div class="form-group">
                <input type="text" name="email" placeholder="Username" required autofocus>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="form-row">
                <label class="remember-me">
                    <input type="checkbox" name="remember">
                    Remember Me
                </label>

                <button type="submit" class="btn-login">Login</button>
            </div>
        </form>

        <a href="#" class="forgot-password">Forgot Password ?</a>
    </div>

</body>
</html>