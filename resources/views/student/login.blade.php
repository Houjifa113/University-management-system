<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <main class="container py-5" style="max-width: 28rem;">
        <section class="card shadow-sm">
            <div class="card-body p-4">
                <h1 class="h3 mb-4">Student Login</h1>

                <form action="{{ route('student.login.submit') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="identifier" class="form-label">Email</label>
                        <input id="identifier" type="email" name="identifier" class="form-control" placeholder="Email" value="{{ old('identifier') }}" required autofocus>
                        @error('identifier')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
