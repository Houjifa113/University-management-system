<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Students</title>
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

        .card {
            border: 1px solid rgb(255 255 255 / 10%) !important;
            border-radius: 20px !important;
            background-color: rgb(255 255 255 / 5%) !important;
            box-shadow: 0 8px 32px 0 rgb(0 0 0 / 37%) !important;
            backdrop-filter: blur(12px) !important;
            -webkit-backdrop-filter: blur(12px) !important;
            cursor: pointer;
            transition: border-color 0.2s, background-color 0.2s, transform 0.2s;
        }

        .card:hover {
            border-color: rgb(100 255 218 / 50%) !important;
            background-color: rgb(255 255 255 / 8%) !important;
            transform: translateY(-3px);
        }

        .text-muted {
            color: #94a3b8 !important;
        }

        .form-check-input {
            border-color: #64ffda;
            background-color: rgb(2 12 27 / 60%);
        }

        .form-check-input:checked {
            border-color: #00bfa5;
            background-color: #00bfa5;
        }

        .form-check-label {
            color: #e2e8f0;
            font-weight: 600;
        }

        .btn-confirm {
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #64ffda 0%, #00bfa5 100%);
            box-shadow: 0 10px 15px -3px rgb(100 255 218 / 30%);
            color: #0a192f;
            font-weight: 700;
        }

        .btn-cancel {
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
<body>
<main class="container py-4 py-md-5" style="max-width: 54rem;">
    <div class="mb-4">
        <p class="text-info text-uppercase small fw-semibold mb-1">Class management</p>
        <h1 class="mb-1">Assign Students</h1>
        <p class="text-muted mb-0">Choose the students you want to include in this class.</p>
    </div>
    @php($selectedIds = collect(old('student_ids', $selectedStudentIds))->map(fn ($studentId) => (int) $studentId)->all())

    <form action="{{ route('class.student.store') }}" method="POST">
        @csrf

        @error('student_ids')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="row g-3">
            @forelse ($students as $student)
                <div class="col-sm-6 col-md-4">
                    <label class="card h-100 text-center" for="student-{{ $student->id }}">
                        <div class="card-body">
                            @if ($student->image)
                                <img src="{{ asset('storage/' . $student->image) }}" alt="{{ $student->username }}" class="rounded-circle mb-3" width="100" height="100">
                            @else
                                <p class="text-muted">No image</p>
                            @endif

                            <h2 class="h5">{{ $student->username }}</h2>
                            <p class="text-muted">{{ $student->email }}</p>

                            <div class="form-check d-inline-block">
                                <input
                                    id="student-{{ $student->id }}"
                                    class="form-check-input"
                                    type="checkbox"
                                    name="student_ids[]"
                                    value="{{ $student->id }}"
                                    @checked(in_array($student->id, $selectedIds, true))
                                >
                                <span class="form-check-label">Select student</span>
                            </div>
                        </div>
                    </label>
                </div>
            @empty
                <p class="text-muted">No students are available.</p>
            @endforelse
        </div>

        <div class="d-flex flex-column flex-sm-row gap-2 mt-4">
            <a href="{{ route('class.create') }}" class="btn btn-cancel">Cancel</a>
            <button type="submit" class="btn btn-confirm" @disabled($students->isEmpty())>Confirm selected students</button>
        </div>
    </form>
</main>
</body>
</html>
