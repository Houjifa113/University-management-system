<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <main class="container py-4 py-md-5 flex-grow-1" style="max-width: 54rem;">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
            <div>
                <p class="text-primary fw-semibold text-uppercase small mb-1">Administration</p>
                <h1 class="mb-1">Admin Dashboard</h1>
                <p class="text-muted mb-0">Manage people, classes, and your account from one place.</p>
            </div>
            <a href="{{ route('admin.profile') }}" class="btn btn-outline-primary align-self-start align-self-sm-center">View Profile</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success shadow-sm" role="status">
                {{ session('success') }}
            </div>
        @endif

        <div class="row g-4">
            <div class="col-md-6">
                <section class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="h5 mb-1">Create</h2>
                        <p class="text-muted small mb-4">Add a new person or class to the system.</p>
                        <div class="d-grid gap-2">
                            <a href="{{ url('/signup') }}" class="btn btn-success">Create Teacher</a>
                            <a href="{{ route('form') }}" class="btn btn-success">Create Student</a>
                            <a href="{{ route('class.create') }}" class="btn btn-success">Create Class</a>
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-md-6">
                <section class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="h5 mb-1">Browse records</h2>
                        <p class="text-muted small mb-4">Review existing classes, teachers, and students.</p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('class.index') }}" class="btn btn-outline-primary">Class List</a>
                            <a href="{{ route('teacherlist.index') }}" class="btn btn-outline-primary">Teacher List</a>
                            <a href="{{ route('studentlist') }}" class="btn btn-outline-primary">Student List</a>
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-12">
                <section class="card border-0 shadow-sm">
                    <div class="card-body p-4 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                        <div>
                            <h2 class="h5 mb-1">Administrator access</h2>
                            <p class="text-muted small mb-0">Create an additional administrator account when needed.</p>
                        </div>
                        <a href="{{ route('admin.register') }}" class="btn btn-outline-secondary text-nowrap align-self-start align-self-sm-center">Create Admin</a>
                    </div>
                </section>
            </div>
        </div>
    </main>
    <footer class="border-top bg-white py-3">
        <form action="{{ route('logout') }}" method="POST" class="container d-flex justify-content-end" style="max-width: 54rem;">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Logout</button>
        </form>
    </footer>
</body>
</html>
