<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
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

        .profile-img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border: 2px solid rgb(100 255 218 / 30%);
            border-radius: 16px;
            background-color: rgb(2 12 27 / 50%);
            box-shadow: 0 8px 24px rgb(0 0 0 / 30%);
        }

        .btn-update-profile {
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #64ffda 0%, #00bfa5 100%);
            box-shadow: 0 10px 15px -3px rgb(100 255 218 / 30%);
            color: #0a192f;
            font-weight: 700;
            padding: 10px 24px;
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
            padding: 10px 24px;
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

        @media (max-width: 576px) {
            .btn-update-profile,
            .btn-secondary-action {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <main class="container py-4 py-md-5 flex-grow-1" style="max-width: 54rem;">
        <div class="mb-4">
            <p class="text-info text-uppercase small fw-semibold mb-1">Student</p>
            <h1 class="mb-1">Student Profile</h1>
            <p class="text-white mb-0">Review and manage your student account details.</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success shadow-sm" role="status">{{ session('success') }}</div>
        @endif

        <section class="glass-card p-4 p-md-5">
            @if ($student->image)
                <div class="mb-4">
                    <img
                        src="{{ asset('storage/'.$student->image) }}"
                        alt="{{ $student->username }}'s profile image"
                        class="profile-img"
                    >
                </div>
            @endif

            <dl class="row mb-0">
                <dt class="col-sm-4 profile-label">Name</dt>
                <dd class="col-sm-8 profile-value">{{ $student->username }}</dd>

                <dt class="col-sm-4 profile-label">Email</dt>
                <dd class="col-sm-8 profile-value">{{ $student->email }}</dd>

                <dt class="col-sm-4 profile-label">Gender</dt>
                <dd class="col-sm-8 profile-value">{{ $student->gender }}</dd>

                <dt class="col-sm-4 profile-label">Department</dt>
                <dd class="col-sm-8 profile-value">{{ $student->department }}</dd>

                @if (Auth::guard('student')->id() === $student->id && $student->temporary_password)
                    <dt class="col-sm-4 profile-label">Temporary Password</dt>
                    <dd class="col-sm-8 profile-value mb-0">{{ $student->temporary_password }}</dd>
                @endif
            </dl>

            <div class="d-flex flex-wrap gap-2 mt-4 pt-2">
                <a href="{{ route('student.profile.edit', $student) }}" class="btn-update-profile">Edit Profile</a>
                <a href="{{ route('student.classes', $student) }}" class="btn-secondary-action">View Classes</a>
            </div>
        </section>
    </main>

    <form action="{{ route('logout') }}" method="POST" class="d-flex justify-content-center py-4">
        @csrf
        <button type="submit" class="btn btn-logout">Logout</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
