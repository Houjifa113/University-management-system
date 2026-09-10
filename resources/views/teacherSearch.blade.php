<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Teachers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <main class="container py-5 flex-grow-1">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Search Teachers</h1>
            <div>
                <a href="{{ route('teacherlist.index') }}" class="btn btn-outline-primary">Teacher List</a>
            </div>
        </div>

        <input id="teacher-search" type="search" class="form-control mb-3" placeholder="Search by teacher name" autocomplete="off">

        <div class="table-responsive bg-white rounded shadow-sm">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Image</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody id="teacher-results">
                    <tr>
                        <td colspan="6" class="text-center text-muted">Start typing a teacher name.</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </main>
    <form action="{{ route('logout') }}" method="POST" class="d-flex justify-content-center py-4">
        @csrf
        <button type="submit" class="btn btn-outline-danger">Logout</button>
    </form>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $('#teacher-search').on('input', function () {
        const search = $(this).val().trim();

        if (search === '') {
            $('#teacher-results').html('<tr><td colspan="6" class="text-center text-muted">Start typing a teacher name.</td></tr>');
            return;
        }

        $.ajax({
            url: '{{ route('teacher.search.results') }}',
            type: 'GET',
            data: { search: search },
            success: function (html) {
                $('#teacher-results').html(html);
            }
        });
    });
</script>
</body>
</html>
