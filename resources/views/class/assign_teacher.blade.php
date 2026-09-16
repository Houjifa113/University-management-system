<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Teacher</title>
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
        <h1 class="mb-1">Assign Teacher</h1>
        <p class="text-muted mb-0">Choose the teacher you want to assign to this class.</p>
    </div>

    <div class="row g-3">
        @forelse ($teachers as $teacher)
            <div class="col-sm-6 col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            @if ($teacher->image)
                                <img src="{{ asset('storage/' . $teacher->image) }}" alt="{{ $teacher->name }}" class="rounded-circle mb-3" width="100" height="100" style="object-fit: cover; border: 2px solid rgb(100 255 218 / 30%);">
                            @else
                                <p class="text-muted">No image</p>
                            @endif

                            <h2 class="h5">{{ $teacher->name }}</h2>
                            <p class="text-muted">{{ $teacher->email }}</p>
                        </div>

                        <form action="{{ route('class.teacher.store', $teacher) }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit" class="btn btn-confirm w-100">Assign</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No unassigned teachers are available.</p>
        @endforelse
    </div>

    <div class="mt-4">
        <a href="{{ route('class.create') }}" class="btn btn-cancel">Back to Create Class</a>
    </div>
</main>
</body>
</html>
