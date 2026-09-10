<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
<main class="container py-4 py-md-5 flex-grow-1" style="max-width: 54rem;">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
        <div>
            <p class="text-primary fw-semibold text-uppercase small mb-1">Class management</p>
            <h1 class="mb-0">Class Details</h1>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('class.create') }}" class="btn btn-outline-secondary">Back to Create Class</a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Admin Dashboard</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success shadow-sm" role="status">{{ session('success') }}</div>
    @endif

    <section class="card border-0 shadow-sm mb-4 overflow-hidden">
        <div class="card-body p-4 p-md-5">
            <p class="text-muted text-uppercase small fw-semibold mb-2">Class</p>
            <h2 class="h3 mb-3">{{ $classlist->class_name }}</h2>
            <p class="text-muted mb-0">Created: {{ $classlist->created_at->format('d M Y') }}</p>
        </div>
    </section>

    <div class="row g-4">
        <div class="col-lg-5">
            <section class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h2 class="h5 mb-4">Assigned Teacher</h2>

                    @if ($classlist->teacher)
                        <dl class="row mb-0">
                            <dt class="col-sm-4 text-muted fw-normal">Name</dt>
                            <dd class="col-sm-8">{{ $classlist->teacher->name }}</dd>

                            <dt class="col-sm-4 text-muted fw-normal">Email</dt>
                            <dd class="col-sm-8">{{ $classlist->teacher->email }}</dd>

                            <dt class="col-sm-4 text-muted fw-normal text-nowrap">Department</dt>
                            <dd class="col-sm-8 mb-0">{{ $classlist->teacher->department }}</dd>
                        </dl>
                    @else
                        <p class="mb-0 text-muted">No teacher has been assigned to this class.</p>
                    @endif
                </div>
            </section>
        </div>

        <div class="col-lg-7">
            <section class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h2 class="h5 mb-4">Assigned Students</h2>

                    @forelse ($classlist->students as $student)
                        <div class="border-top py-3">
                            <p class="fw-semibold mb-1">{{ $student->username }}</p>
                            <p class="text-muted small mb-1">{{ $student->email }}</p>
                            <p class="mb-0"><span class="text-muted">Department:</span> {{ $student->department }}</p>
                        </div>
                    @empty
                        <p class="mb-0 text-muted">No students have been assigned to this class.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</main>
</body>
</html>
