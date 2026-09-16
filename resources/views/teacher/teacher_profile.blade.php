<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <main class="container py-5 flex-grow-1" style="max-width: 42rem;">
        <section class="card shadow-sm">
            <div class="card-body p-4">
                <h1 class="h3 mb-4">Teacher Profile</h1>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($teacher->image)
                    <img
                        src="{{ asset('storage/'.$teacher->image) }}"
                        alt="{{ $teacher->name }}'s profile image"
                        class="img-thumbnail mb-4"
                        style="max-width: 12rem;"
                    >
                @endif

                <dl class="row">
                    <dt class="col-sm-4">Name</dt>
                    <dd class="col-sm-8">{{ $teacher->name }}</dd>

                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8">{{ $teacher->email }}</dd>

                    <dt class="col-sm-4">Department</dt>
                    <dd class="col-sm-8">{{ $teacher->department }}</dd>
                </dl>

                <div class="d-grid gap-2">
                    @if (Auth::guard('web')->check() && Auth::guard('web')->id() === $teacher->id)
                        <a href="{{ route('teacher.profile.edit', $teacher) }}" class="btn btn-success">Edit Profile</a>
                    @endif
                    <a href="{{ route('form') }}" class="btn btn-primary">Create Student</a>
                    <a href="{{ route('studentlist') }}" class="btn btn-outline-primary">Student List</a>
                    <a href="{{ route('teacher.classes', $teacher) }}" class="btn btn-outline-primary">View Classes</a>
                </div>
            </div>
        </section>
    </main>
    <form action="{{ route('logout') }}" method="POST" class="d-flex justify-content-center py-4">
        @csrf
        <button type="submit" class="btn btn-outline-danger">Logout</button>
    </form>
</body>
</html>
