<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Crystal Sapphire Theme */
        body.bg-light.min-vh-100 {
            background-color: #0f172a !important;
            background-image:
                radial-gradient(at 0% 0%, hsla(217, 91%, 30%, 1) 0, transparent 50%),
                radial-gradient(at 100% 0%, hsla(199, 89%, 48%, 1) 0, transparent 50%),
                radial-gradient(at 50% 100%, hsla(215, 25%, 27%, 1) 0, transparent 50%) !important;
            color: #f1f5f9 !important;
            font-family: 'Inter', -apple-system, sans-serif !important;
        }

        .card {
            background-color: rgb(255 255 255 / 5%) !important;
            border: 1px solid rgb(255 255 255 / 10%) !important;
            border-radius: 20px !important;
            box-shadow: 0 8px 32px 0 rgb(0 0 0 / 37%) !important;
            backdrop-filter: blur(12px) !important;
            -webkit-backdrop-filter: blur(12px) !important;
            transition: all 0.3s ease !important;
        }

        .card:hover {
            background-color: rgb(255 255 255 / 8%) !important;
            border: 1px solid rgb(255 255 255 / 20%) !important;
            transform: translateY(-5px);
        }

        h1, h2, h3, .h1, .h2, .h3, .card-title {
            color: #e2e8f0 !important;
            font-weight: 700 !important;
            text-shadow: 0 2px 4px rgb(0 0 0 / 20%);
        }

        p, .text-muted {
            color: #94a3b8 !important;
        }

        .btn-primary,
        a[href*="profile"] {
            padding: 10px 24px !important;
            border: none !important;
            border-radius: 12px !important;
            background: linear-gradient(135deg, #0ea5e9 0%, #2563eb 100%) !important;
            box-shadow: 0 4px 15px rgb(37 99 235 / 40%) !important;
            color: #fff !important;
            font-weight: 600 !important;
        }

        a.btn-outline-secondary,
        [class*="create-admin"] {
            border: 2px solid #d97706 !important;
            border-radius: 12px !important;
            background-color: #f59e0b !important;
            box-shadow: 0 4px 14px 0 rgb(245 158 11 / 39%) !important;
            color: #000 !important;
            font-weight: 800 !important;
            text-transform: uppercase !important;
        }

        .logout-container {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            width: 100% !important;
            padding: 2rem 0 !important;
        }

        .btn-logout {
            padding: 8px 24px !important;
            border: none !important;
            border-radius: 50px !important;
            background-color: #ef4444 !important;
            box-shadow: 0 4px 12px rgb(239 68 68 / 30%) !important;
            color: #fff !important;
            font-weight: 600 !important;
            transition: background-color 0.2s, box-shadow 0.2s, transform 0.2s;
        }

        .btn-logout:hover {
            background-color: #dc2626 !important;
            box-shadow: 0 6px 16px rgb(239 68 68 / 40%) !important;
            color: #fff !important;
            transform: translateY(-1px);
        }

        footer {
            border-top: 1px solid rgb(255 255 255 / 10%) !important;
            background: transparent !important;
        }

        @media (max-width: 576px) {
            .btn {
                width: 100% !important;
                margin-bottom: 0.5rem !important;
            }

            .card {
                border-radius: 12px !important;
            }
        }
    </style>
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
    <footer class="border-top py-3">
        <form action="{{ route('logout') }}" method="POST" class="container logout-container" style="max-width: 54rem;">
            @csrf
            <button type="submit" class="btn btn-logout">Logout</button>
        </form>
    </footer>
</body>
</html>
