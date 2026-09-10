<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
  <main class="container py-5 flex-grow-1">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="mb-0">Student List</h1>
      <div>
        <a href="{{ route('teacherlist.index') }}" class="btn btn-outline-primary">Teacher List</a>
        <a href="{{ route('student.search') }}" class="btn btn-outline-secondary">Search Students</a>
      </div>
    </div>

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('studentlist.import') }}" method="POST" enctype="multipart/form-data" class="mb-4">
      @csrf
      <label for="student_data_upload" class="form-label">Student Data Upload</label>

      <div class="input-group">
        <input
          type="file"
          name="student_data_upload"
          id="student_data_upload"
          class="form-control"
          accept=".csv,text/csv"
          required
        >
        <button type="submit" class="btn btn-primary">Upload CSV</button>
      </div>
      <div class="form-text">Required columns: username, email, gender, department. Each imported student receives a unique temporary password in their profile.</div>
      @if ($errors->has('student_data_upload'))
        <ul class="text-danger mt-2 mb-0">
          @foreach ($errors->get('student_data_upload') as $message)
            <li>{{ $message }}</li>
          @endforeach
        </ul>
      @endif
    </form>

    <div class="mb-4">
      <label class="form-label d-block">Student Data Download</label>
      <a href="{{ route('studentlist.export') }}" class="btn btn-success">Download CSV</a>
      <div class="form-text">Downloads student data except images, passwords, and dates.</div>
    </div>

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
        <tbody>
          @foreach($data as $studentlist)
            <tr>
              <td>{{ $studentlist->username }}</td>
              <td>{{ $studentlist->email }}</td>
              <td>{{ $studentlist->gender }}</td>
              <td>{{ $studentlist->department }}</td>
              <td>
                @if($studentlist->image)
                  <img src="{{ asset('storage/' . $studentlist->image) }}" width="50" height="50">
                @else
                  No Image
                @endif
              <td><a href="{{ route('student.profile.edit', $studentlist->id) }}" class="btn btn-sm btn-primary">Update</a></td>
              <td>
                <form action="{{ route('student.destroy', $studentlist->id) }}" method="POST">
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
      {{ $data->links() }}
    </div>
  </main>
  <form action="{{ route('logout') }}" method="POST" class="d-flex justify-content-center py-4">
    @csrf
    <button type="submit" class="btn btn-outline-danger">Logout</button>
  </form>
</body>
</html>
