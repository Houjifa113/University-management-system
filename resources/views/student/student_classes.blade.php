<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Classes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<main class="container py-5" style="max-width: 48rem;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">{{ $student->username }}'s Classes</h1>
        <a href="{{ route('student.profile', $student) }}" class="btn btn-outline-secondary">Back to Profile</a>
    </div>

    @forelse ($classes as $classlist)
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="h5 mb-1">{{ $classlist->class_name }}</h2>
                <p class="mb-0 text-muted">
                    Teacher: {{ $classlist->teacher?->name ?? 'No teacher assigned' }}
                </p>
            </div>
        </div>
    @empty
        <div class="alert alert-secondary">No classes have been assigned yet.</div>
    @endforelse
</main>
</body>
</html>
