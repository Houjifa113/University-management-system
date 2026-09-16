<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class List</title>
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

        .btn-dashboard {
            border: 1px solid #0ea5e9;
            border-radius: 8px;
            background: rgb(15 23 42 / 25%);
            color: #7dd3fc;
            font-weight: 600;
        }

        .btn-details {
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #64ffda 0%, #00bfa5 100%);
            box-shadow: 0 10px 15px -3px rgb(100 255 218 / 30%);
            color: #0a192f;
            font-weight: 700;
        }

        .table {
            --bs-table-bg: transparent;
            --bs-table-color: #e2e8f0;
            --bs-table-striped-bg: rgb(255 255 255 / 4%);
            --bs-table-striped-color: #e2e8f0;
            --bs-table-border-color: rgb(255 255 255 / 10%);
            margin-bottom: 0;
        }

        .table thead th {
            border-bottom-color: rgb(100 255 218 / 35%);
            background-color: rgb(2 12 27 / 35%);
            color: #64ffda;
            font-weight: 700;
            white-space: nowrap;
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
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
        <div>
            <p class="text-info text-uppercase small fw-semibold mb-1">Class management</p>
            <h1 class="mb-1">Class List</h1>
            <p class="text-light-emphasis mb-0">Review the classes, teachers, and assigned students.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-dashboard align-self-start align-self-sm-center">Back to Admin Dashboard</a>
    </div>

    @if ($classes->isEmpty())
        <div class="alert alert-secondary">No classes have been created yet.</div>
    @else
        <div class="table-responsive glass-card">
            <table class="table table-striped align-middle">
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
                                <a href="{{ route('class.show', $classlist) }}" class="btn btn-sm btn-details">View Details</a>
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
