<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Dashboard Background */
        body {
            min-height: 100vh;
            background-color: #0a192f !important;
            background-image: linear-gradient(135deg, #0a192f 0%, #112240 50%, #1e3a8a 100%) !important;
            background-attachment: fixed !important;
            color: #e6f1ff !important;
            font-family: 'Inter', sans-serif;
        }

        /* Professional Glass Card */
        .card {
            padding: 2rem;
            border: 1px solid rgb(100 255 218 / 10%) !important;
            border-radius: 16px !important;
            background: rgb(17 34 64 / 70%) !important;
            box-shadow: 0 20px 40px rgb(2 12 27 / 70%) !important;
            backdrop-filter: blur(12px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(12px) saturate(180%) !important;
        }

        label {
            color: #64ffda !important;
            font-weight: 600 !important;
        }

        input, select, textarea {
            border: 2px solid rgb(100 255 218 / 30%) !important;
            border-radius: 8px !important;
            background-color: rgb(2 12 27 / 50%) !important;
            color: #fff !important;
        }

        /* Update: Amber */
        .btn-warning, [class*="update"], [value*="Update"] {
            border: none !important;
            background: linear-gradient(135deg, #ffbf00 0%, #ff8c00 100%) !important;
            box-shadow: 0 4px 15px rgb(255 191 0 / 40%) !important;
            color: #000 !important;
            font-weight: bold !important;
        }

        /* Delete: Bright Red */
        .btn-danger, [class*="delete"], [value*="Delete"] {
            border: none !important;
            background: linear-gradient(135deg, #ff4b2b 0%, #ff416c 100%) !important;
            box-shadow: 0 4px 15px rgb(255 75 43 / 40%) !important;
            color: #fff !important;
            font-weight: bold !important;
        }

        /* Logout: Red Outline */
        .logout-btn, [href*="logout"] {
            border: 2px solid #ff4b2b !important;
            background: transparent !important;
            color: #ff4b2b !important;
            font-weight: bold !important;
            text-transform: uppercase !important;
        }

        @media (max-width: 768px) {
            .btn {
                width: 100% !important;
                margin-bottom: 0.5rem !important;
            }
        }
    </style>
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <main class="container py-5 flex-grow-1">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
            <h1 class="mb-0">Teacher List</h1>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('studentlist') }}" class="btn btn-outline-primary">Student List</a>
                <a href="{{ route('teacher.search') }}" class="btn btn-outline-secondary">Search Teachers</a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive card bg-white rounded shadow-sm">
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
                                    <button type="submit" class="btn btn-sm btn-primary update-action">Update</button>
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

        <div class="mt-4">
            {{ $teacherlist->links() }}
        </div>
    </main>
    <form action="{{ route('logout') }}" method="POST" class="d-flex justify-content-center py-4">
        @csrf
        <button type="submit" class="btn btn-outline-danger logout-btn">Logout</button>
    </form>
</body>
</html>
