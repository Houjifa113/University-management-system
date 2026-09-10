<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <main class="container py-5 flex-grow-1" style="max-width: 42rem;">
        <section class="card shadow-sm">
            <div class="card-body p-4">
                <h1 class="h3 mb-4">Student Profile</h1>

                @if ($student->image)
                    <img
                        src="{{ asset('storage/'.$student->image) }}"
                        alt="{{ $student->username }}'s profile image"
                        class="img-thumbnail mb-4"
                        style="max-width: 12rem;"
                    >
                @endif

              

                    <dt class="col-sm-4">Name</dt>
                    <dd class="col-sm-8">{{ $student->username }}</dd>

                    <dt class="col-sm-4">Email</dt>
                    <dd class="col-sm-8">{{ $student->email }}</dd>

                    <dt class="col-sm-4">Gender</dt>
                    <dd class="col-sm-8">{{ $student->gender }}</dd>

                    <dt class="col-sm-4">Department</dt>
                    <dd class="col-sm-8">{{ $student->department }}</dd>

                    @if (Auth::guard('student')->id() === $student->id && $student->temporary_password)
                        <dt class="col-sm-4">Temporary Password</dt>
                        <dd class="col-sm-8">{{ $student->temporary_password }}</dd>
                    @endif

                </dl>

                <a href="{{ route('student.profile.edit', $student) }}" class="btn btn-primary">Edit Profile</a>
                <a href="{{ route('student.classes', $student) }}" class="btn btn-outline-primary">View Classes</a>
            </div>
        </section>
    </main>
    <form action="{{ route('logout') }}" method="POST" class="d-flex justify-content-center py-4">
        @csrf
        <button type="submit" class="btn btn-outline-danger">Logout</button>
    </form>
</body>
</html>
