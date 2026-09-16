<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Class</title>
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

        .glass-card {
            border: 1px solid rgb(255 255 255 / 10%);
            border-radius: 20px;
            background-color: rgb(255 255 255 / 5%);
            box-shadow: 0 8px 32px 0 rgb(0 0 0 / 37%);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        h1, h2, h3, .h1, .h2, .h3 {
            color: #e2e8f0 !important;
            font-weight: 700;
            text-shadow: 0 2px 4px rgb(0 0 0 / 20%);
        }

        .page-kicker, label {
            color: #64ffda !important;
            font-weight: 600;
        }

        .assignment-status {
            border: 1px solid rgb(255 255 255 / 10%);
            border-radius: 12px;
            background-color: rgb(2 12 27 / 30%);
            color: #cbd5e1;
        }

        .assignment-status strong {
            color: #f1f5f9;
        }

        .form-control {
            border: 1px solid rgb(100 255 218 / 30%);
            border-radius: 8px;
            background-color: rgb(2 12 27 / 50%);
            color: #fff;
        }

        .form-control:focus {
            border-color: #64ffda;
            background-color: rgb(2 12 27 / 70%);
            box-shadow: 0 0 0 0.25rem rgb(100 255 218 / 15%);
            color: #fff;
        }

        .btn-assign-teacher, .btn-create-class {
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #64ffda 0%, #00bfa5 100%);
            box-shadow: 0 10px 15px -3px rgb(100 255 218 / 30%);
            color: #0a192f;
            font-weight: 700;
        }

        .btn-assign-student {
            border: 1px solid #0ea5e9;
            border-radius: 8px;
            background: rgb(15 23 42 / 25%);
            color: #7dd3fc;
            font-weight: 600;
        }

        @media (max-width: 576px) {
            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body class="d-flex flex-column">
<main class="container py-4 py-md-5 flex-grow-1" style="max-width: 54rem;">
    <div class="mb-4">
        <p class="page-kicker text-uppercase small mb-1">Class management</p>
        <h1 class="mb-1">Create Class</h1>
        <p class="text-light-emphasis mb-0">Assign a teacher and students before creating the class.</p>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm" role="status">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <section class="glass-card p-4 p-md-5">
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                @if ($teacher)
                    <div class="assignment-status h-100 p-3">
                        <p class="text-uppercase small text-info mb-1">Assigned teacher</p>
                        <strong>{{ $teacher->name }}</strong>
                    </div>
                @else
                    <div class="assignment-status h-100 p-3">No teacher has been assigned yet.</div>
                @endif
            </div>

            <div class="col-md-6">
                @if ($students->isNotEmpty())
                    <div class="assignment-status h-100 p-3">
                        <p class="text-uppercase small text-info mb-1">Assigned students</p>
                        <strong>{{ $students->pluck('username')->join(', ') }}</strong>
                    </div>
                @else
                    <div class="assignment-status h-100 p-3">No students have been assigned yet.</div>
                @endif
            </div>
        </div>

        <div class="d-grid d-sm-flex gap-3 mb-4">
            <a href="{{ route('class.teacher.assign') }}" class="btn btn-assign-teacher flex-sm-fill">Assign Teacher</a>
            <a href="{{ route('class.student.assign') }}" class="btn btn-assign-student flex-sm-fill">Assign Student</a>
        </div>

        <form action="{{ route('class.store') }}" method="POST">
            @csrf

            <label for="class_name" class="form-label">Class name</label>
            <input
                type="text"
                id="class_name"
                name="class_name"
                value="{{ old('class_name') }}"
                class="form-control @error('class_name') is-invalid @enderror"
                maxlength="100"
                required
            >
            @error('class_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-create-class w-100 mt-4">Create</button>
        </form>
    </section>
</main>
</body>
</html>
