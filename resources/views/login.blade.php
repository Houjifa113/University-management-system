<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Management System - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            background-color: #008b8b;
            background-image: linear-gradient(180deg, #40e0d0 0%, #00ced1 25%, #008b8b 60%, #002b36 100%);
            background-attachment: fixed;
            font-family: 'Inter', sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 28rem;
            padding: 2rem;
            background: rgb(255 255 255 / 40%) !important;
            border: 1px solid rgb(255 255 255 / 30%) !important;
            border-radius: 24px !important;
            box-shadow: 0 8px 32px 0 rgb(31 38 135 / 15%) !important;
            backdrop-filter: blur(15px) saturate(180%);
            -webkit-backdrop-filter: blur(15px) saturate(180%);
        }

        .uni-logo-box {
            display: grid;
            width: 3.75rem;
            height: 3.75rem;
            margin: 0 auto 1.5rem;
            place-items: center;
            border-radius: 0.875rem;
            background: #0f52ba;
            box-shadow: 0 10px 15px -3px rgb(15 82 186 / 30%);
            color: #fff;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .login-card h1 {
            color: #1e293b;
            font-weight: 700;
            letter-spacing: -0.025em;
        }

        .login-card .form-label {
            color: #475569;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .login-card .form-control {
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
        }

        .login-card .form-control:focus {
            border-color: #0f52ba;
            box-shadow: 0 0 0 0.25rem rgb(15 82 186 / 10%);
        }

        .btn-sapphire {
            padding: 15px !important;
            border: 2px solid rgb(255 255 255 / 80%) !important;
            border-radius: 12px !important;
            background: linear-gradient(135deg, #00ff88 0%, #00b0ff 100%) !important;
            box-shadow: 0 0 20px rgb(0 255 136 / 60%), 0 0 40px rgb(0 176 255 / 20%) !important;
            color: #fff !important;
            font-size: 1.1rem !important;
            font-weight: 800 !important;
            letter-spacing: 2px !important;
            text-shadow: 0 1px 2px rgb(0 0 0 / 30%) !important;
            text-transform: uppercase !important;
            transition: all 0.3s ease !important;
        }

        .btn-sapphire:hover {
            box-shadow: 0 0 30px rgb(0 255 136 / 80%), 0 0 50px rgb(0 176 255 / 40%) !important;
            filter: brightness(1.1);
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center p-3 p-sm-4">
    <main class="card login-card border-0">
        <div class="uni-logo-box" aria-hidden="true">U</div>

        <h1 class="h3 text-center mb-1">University Portal</h1>
        <p class="text-center text-muted mb-4 small">Welcome back! Please enter your details.</p>

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            @if (session('success'))
                <div class="alert alert-success py-2 small" role="status">{{ session('success') }}</div>
            @endif

            @error('identifier')
                <div class="alert alert-danger py-2 small" role="alert">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="identifier" class="form-label">Email address</label>
                <input id="identifier" type="email" name="identifier" class="form-control" placeholder="name@university.edu" value="{{ old('identifier') }}" required>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <input type="submit" name="login" value="Login" class="btn btn-sapphire w-100">
        </form>
        <p class="mt-5 mb-0 text-center text-muted small">&copy; {{ now()->year }} University Management System</p>
    </main>
</body>
</html>
