<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background-color: #0f172a !important;
            background-image:
                radial-gradient(at 0% 0%, hsla(217, 91%, 30%, 1) 0, transparent 50%),
                radial-gradient(at 100% 0%, hsla(199, 89%, 48%, 1) 0, transparent 50%),
                radial-gradient(at 50% 100%, hsla(215, 25%, 27%, 1) 0, transparent 50%) !important;
            color: #f1f5f9 !important;
            font-family: 'Inter', -apple-system, sans-serif;
        }

        h1, h2, h3, .h1, .h2, .h3 {
            color: #e2e8f0 !important;
            font-weight: 700;
            text-shadow: 0 2px 4px rgb(0 0 0 / 20%);
        }

        .glass-card {
            border: 1px solid rgb(255 255 255 / 10%);
            border-radius: 20px;
            background-color: rgb(255 255 255 / 5%);
            box-shadow: 0 8px 32px 0 rgb(0 0 0 / 37%);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .profile-label {
            color: #64ffda;
            font-weight: 600;
        }

        .profile-value {
            color: #e2e8f0;
        }

        .btn-update-profile {
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #64ffda 0%, #00bfa5 100%);
            box-shadow: 0 10px 15px -3px rgb(100 255 218 / 30%);
            color: #0a192f;
            font-weight: 700;
            padding: 8px 20px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s ease;
        }

        .btn-update-profile:hover {
            color: #0a192f;
            filter: brightness(1.08);
            transform: translateY(-1px);
        }

        .btn-secondary-action {
            border: 1px solid #0ea5e9;
            border-radius: 8px;
            background: rgb(15 23 42 / 25%);
            color: #7dd3fc;
            font-weight: 600;
            padding: 8px 20px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s ease;
        }

        .btn-secondary-action:hover {
            background: rgb(14 165 233 / 20%);
            color: #bae6fd;
            border-color: #38bdf8;
            transform: translateY(-1px);
        }

        @media (max-width: 576px) {
            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
<main class="container py-4 py-md-5 flex-grow-1" style="max-width: 54rem;">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
        <div>
            <p class="text-info text-uppercase small fw-semibold mb-1">Class management</p>
            <h1 class="mb-1">Class Details</h1>
            <p class="text-white mb-0">Overview of class information, assigned teacher, and enrolled students.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('class.create') }}" class="btn btn-secondary-action">Back to Create Class</a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-update-profile">Admin Dashboard</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm" role="status">{{ session('success') }}</div>
    @endif

    <section class="glass-card p-4 p-md-5 mb-4">
        <p class="text-info text-uppercase small fw-semibold mb-1">Class</p>
        <h2 class="h3 mb-2" style="color: #64ffda !important;">{{ $classlist->class_name }}</h2>
        <p class="text-white mb-0">Created: {{ $classlist->created_at->format('d M Y') }}</p>
    </section>

    <div class="row g-4">
        <div class="col-lg-5">
            <section class="glass-card p-4 h-100">
                <h2 class="h5 mb-4" style="color: #64ffda !important;">Assigned Teacher</h2>

                @if ($classlist->teacher)
                    <dl class="row mb-0">
                        <dt class="col-sm-4 profile-label">Name</dt>
                        <dd class="col-sm-8 profile-value">{{ $classlist->teacher->name }}</dd>

                        <dt class="col-sm-4 profile-label">Email</dt>
                        <dd class="col-sm-8 profile-value">{{ $classlist->teacher->email }}</dd>

                        <dt class="col-sm-4 profile-label">Department</dt>
                        <dd class="col-sm-8 profile-value mb-0">{{ $classlist->teacher->department }}</dd>
                    </dl>
                @else
                    <p class="mb-0 text-white">No teacher has been assigned to this class.</p>
                @endif
            </section>
        </div>

        <div class="col-lg-7">
            <section class="glass-card p-4 h-100">
                <h2 class="h5 mb-4" style="color: #64ffda !important;">Assigned Students</h2>

                @forelse ($classlist->students as $student)
                    <div class="border-top py-3" style="border-color: rgb(255 255 255 / 10%) !important;">
                        <p class="fw-semibold mb-1" style="color: #64ffda;">{{ $student->username }}</p>
                        <p class="text-white small mb-1">{{ $student->email }}</p>
                        <p class="mb-0 profile-value"><span class="profile-label">Department:</span> {{ $student->department }}</p>
                    </div>
                @empty
                    <p class="mb-0 text-white">No students have been assigned to this class.</p>
                @endforelse
            </section>
        </div>
    </div>
</main>
</body>
</html>
