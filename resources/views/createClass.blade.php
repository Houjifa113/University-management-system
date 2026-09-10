<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Class</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<main class="container py-5" style="max-width: 42rem;">
    <h1 class="h3 mb-4">Create Class</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @if ($teacher)
        <div class="alert alert-info">
            Assigned teacher: <strong>{{ $teacher->name }}</strong>
        </div>
    @else
        <div class="alert alert-secondary">No teacher has been assigned yet.</div>
    @endif

    @if ($students->isNotEmpty())
        <div class="alert alert-info">
            Assigned students:
            <strong>{{ $students->pluck('username')->join(', ') }}</strong>
        </div>
    @else
        <div class="alert alert-secondary">No students have been assigned yet.</div>
    @endif

    <div class="d-grid gap-3">
        <a href="{{ route('class.teacher.assign') }}" class="btn btn-primary">Assign Teacher</a>
        <a href="{{ route('class.student.assign') }}" class="btn btn-outline-primary">Assign Student</a>
    </div>

    <form action="{{ route('class.store') }}" method="POST" class="mt-4">
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

        <button type="submit" class="btn btn-success w-100 mt-3">Create</button>
    </form>
</main>
</body>
</html>
