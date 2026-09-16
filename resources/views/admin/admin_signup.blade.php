<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <main class="container py-5 flex-grow-1" style="max-width: 42rem;">
        <div class="mb-4">
            <p class="text-primary fw-semibold text-uppercase small mb-1">Administration</p>
            <h1 class="mb-1">Register Admin</h1>
            <p class="text-muted mb-0">Only an existing admin can create another admin account.</p>
        </div>

        <section class="card border-0 shadow-sm">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('admin.register.store') }}" method="POST">
                    @csrf

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label" for="name">Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="password">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="password_confirmation">Confirm password</label>
                            <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="department">Department</label>
                            <input class="form-control @error('department') is-invalid @enderror" id="department" name="department" value="{{ old('department') }}" required>
                            @error('department')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4 pt-2">
                        <button type="submit" class="btn btn-primary">Register Admin</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
