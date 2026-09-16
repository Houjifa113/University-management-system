<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Students</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
  <main class="container py-5 flex-grow-1">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="mb-0">Search Students</h1>
      <a href="{{ route('studentlist') }}" class="btn btn-outline-primary">Student List</a>
    </div>

    <input id="student-search" type="search" class="form-control mb-3" placeholder="Search by student username" autocomplete="off">

    <div class="table-responsive bg-white rounded shadow-sm">
      <table class="table table-hover mb-0 align-middle">
        <thead class="table-dark">
          <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Department</th>
            <th>Image</th>
            <th>Update</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody id="student-results">
          <tr>
            <td colspan="7" class="text-center text-muted">Start typing a student username.</td>
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
  $('#student-search').on('input', function () {
    const search = $(this).val().trim();

    if (search === '') {
      $('#student-results').html('<tr><td colspan="7" class="text-center text-muted">Start typing a student username.</td></tr>');
      return;
    }

    $.ajax({
      url: '{{ route('student.search.results') }}',
      type: 'GET',
      data: { search: search },
      success: function (html) {
        $('#student-results').html(html);
      }
    });
  });
</script>
</body>
</html>
