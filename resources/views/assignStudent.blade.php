<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<main class="container py-5">
    <h1 class="h3 mb-4">Assign Students</h1>
    @php($selectedIds = collect(old('student_ids', $selectedStudentIds))->map(fn ($studentId) => (int) $studentId)->all())

    <form action="{{ route('class.student.store') }}" method="POST">
        @csrf

        @error('student_ids')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="row g-3">
            @forelse ($students as $student)
                <div class="col-md-4">
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

        <div class="d-flex gap-2 mt-4">
            <a href="{{ route('class.create') }}" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary" @disabled($students->isEmpty())>Confirm selected students</button>
        </div>
    </form>
</main>
</body>
</html>
