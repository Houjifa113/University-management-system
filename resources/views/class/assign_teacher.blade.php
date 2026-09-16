<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Teacher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<main class="container py-5">
    <h1 class="h3 mb-4">Assign Teacher</h1>

    <div class="row g-3">
        @forelse ($teachers as $teacher)
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        @if ($teacher->image)
                            <img src="{{ asset('storage/' . $teacher->image) }}" alt="{{ $teacher->name }}" class="rounded-circle mb-3" width="100" height="100">
                        @else
                            <p class="text-muted">No image</p>
                        @endif

                        <h2 class="h5">{{ $teacher->name }}</h2>
                        <p class="text-muted">{{ $teacher->email }}</p>

                        <form action="{{ route('class.teacher.store', $teacher) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Assign</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No unassigned teachers are available.</p>
        @endforelse
    </div>

    <a href="{{ route('class.create') }}" class="btn btn-outline-secondary mt-4">Back to Create Class</a>
</main>
</body>
</html>
