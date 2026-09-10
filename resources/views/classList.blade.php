<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<main class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Class List</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Back to Admin Dashboard</a>
    </div>

    @if ($classes->isEmpty())
        <div class="alert alert-secondary">No classes have been created yet.</div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle bg-white">
                <thead>
                    <tr>
                        <th>Class Name</th>
                        <th>Teacher</th>
                        <th>Students</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $classlist)
                        <tr>
                            <td>{{ $classlist->class_name }}</td>
                            <td>{{ $classlist->teacher?->name ?? 'No teacher assigned' }}</td>
                            <td>{{ $classlist->students_count }}</td>
                            <td>{{ $classlist->created_at->format('d M Y, h:i A') }}</td>
                            <td>{{ $classlist->updated_at->format('d M Y, h:i A') }}</td>
                            <td>
                                <a href="{{ route('class.show', $classlist) }}" class="btn btn-sm btn-primary">View Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</main>
</body>
</html>
