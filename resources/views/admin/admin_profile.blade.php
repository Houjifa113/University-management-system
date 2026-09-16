<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
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
        }

        @media (max-width: 576px) {
            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <main class="container py-4 py-md-5" style="max-width: 54rem;">
        <div class="mb-4">
            <p class="text-info text-uppercase small fw-semibold mb-1">Administration</p>
            <h1 class="mb-1">Admin Profile</h1>
            <p class="text-light-emphasis mb-0">Review and manage your administrator account details.</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success shadow-sm" role="status">{{ session('success') }}</div>
        @endif

        <section class="glass-card p-4 p-md-5">
            <dl class="row mb-0">
                <dt class="col-sm-4 profile-label">Name</dt>
                <dd class="col-sm-8 profile-value">{{ $adminProfile->name }}</dd>

                <dt class="col-sm-4 profile-label">Email</dt>
                <dd class="col-sm-8 profile-value">{{ $adminProfile->email }}</dd>

                <dt class="col-sm-4 profile-label">Department</dt>
                <dd class="col-sm-8 profile-value mb-0">{{ $adminProfile->department }}</dd>
            </dl>

            <div class="mt-4 pt-2">
                <a href="{{ route('admin.profile.edit') }}" class="btn btn-update-profile px-4">Update Profile</a>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
