<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <main class="container py-5 flex-grow-1">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Teacher List</h1>
            <div>
                <a href="{{ route('studentlist') }}" class="btn btn-outline-primary">Student List</a>
                <a href="{{ route('teacher.search') }}" class="btn btn-outline-secondary">Search Teachers</a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive bg-white rounded shadow-sm">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Image</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teacherlist as $teacher)
                        <tr>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td>{{ $teacher->department }}</td>
                            <td>
                                @if($teacher->image)
                                    <img src="{{ asset('storage/' . $teacher->image) }}" alt="Profile image for {{ $teacher->name }}" width="50" height="50">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('teacherlist.edit', $teacher->id) }}" method="GET">
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('teacherlist.destroy', $teacher->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

       
            <div>
                {{ $teacherlist->links() }}
            </div>
        </div>
    </main>
    <form action="{{ route('logout') }}" method="POST" class="d-flex justify-content-center py-4">
        @csrf
        <button type="submit" class="btn btn-outline-danger">Logout</button>
    </form>
</body>
</html>
