<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Classes</title>
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
            transition: all 0.2s ease;
        }

        .glass-card:hover {
            background-color: rgb(255 255 255 / 8%);
            border-color: rgb(255 255 255 / 20%);
        }

        .class-title {
            color: #64ffda;
            font-weight: 600;
        }

        .student-count {
            color: #cbd5e1;
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
            .btn-secondary-action {
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
            <p class="text-info text-uppercase small fw-semibold mb-1">Faculty</p>
            <h1 class="mb-1">{{ $teacherlist->name }}'s Classes</h1>
            <p class="text-white mb-0">Overview of all assigned classes and student counts.</p>
        </div>
        <a href="{{ route('teacher.profile', $teacherlist) }}" class="btn-secondary-action align-self-start align-self-sm-center">Back to Profile</a>
    </div>

    @forelse ($classes as $classlist)
        <div class="glass-card p-4 mb-3">
            <h2 class="h5 class-title mb-1">{{ $classlist->class_name }}</h2>
            <p class="mb-0 student-count">{{ $classlist->students_count }} students</p>
        </div>
    @empty
        <div class="glass-card p-4 text-center text-white">No classes have been assigned yet.</div>
    @endforelse
</main>
</body>
</html>
