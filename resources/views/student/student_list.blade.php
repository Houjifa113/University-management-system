<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    /* Global Dashboard Theme */
    body {
      min-height: 100vh;
      margin: 0;
      background-color: #0a192f !important;
      background-image: linear-gradient(135deg, #0a192f 0%, #112240 50%, #1e3a8a 100%) !important;
      background-attachment: fixed !important;
      color: #e6f1ff !important;
      font-family: 'Inter', -apple-system, sans-serif;
    }

    /* Professional Glass Container */
    .card, .container-glass {
      border: 1px solid rgb(100 255 218 / 10%) !important;
      border-radius: 16px !important;
      background: rgb(17 34 64 / 70%) !important;
      box-shadow: 0 20px 40px rgb(2 12 27 / 70%) !important;
      backdrop-filter: blur(12px) saturate(180%) !important;
      -webkit-backdrop-filter: blur(12px) saturate(180%) !important;
    }

    /* Functional Button Colors */
    .btn-warning, [class*="update"], [value*="Update"] {
      border: none !important;
      background: linear-gradient(135deg, #ffbf00 0%, #ff8c00 100%) !important;
      box-shadow: 0 4px 15px rgb(255 191 0 / 40%) !important;
      color: #000 !important;
      font-weight: bold !important;
      text-transform: uppercase !important;
    }

    .btn-danger, [class*="delete"], [value*="Delete"] {
      border: none !important;
      background: linear-gradient(135deg, #ff4b2b 0%, #ff416c 100%) !important;
      box-shadow: 0 4px 15px rgb(255 75 43 / 40%) !important;
      color: #fff !important;
      font-weight: bold !important;
      text-transform: uppercase !important;
    }

    .logout-btn, [href*="logout"] {
      border: 2px solid #ff4b2b !important;
      background: transparent !important;
      color: #ff4b2b !important;
      font-weight: bold !important;
    }

    /* Responsive Layout */
    .container {
      width: 100% !important;
      max-width: 1200px !important;
      margin: 0 auto !important;
      padding: 15px !important;
    }

    .table-responsive {
      overflow-x: auto !important;
      -webkit-overflow-scrolling: touch !important;
    }

    @media (max-width: 768px) {
      .btn {
        width: 100% !important;
        margin-bottom: 0.5rem !important;
      }

      .card {
        padding: 1rem !important;
      }
    }

    @media (max-width: 576px) {
      .input-group {
        flex-direction: column;
      }
      .input-group > .btn {
        width: 100% !important;
        margin-top: 0.5rem;
        border-radius: 8px !important;
      }
      .input-group > .form-control {
        width: 100% !important;
        border-radius: 8px !important;
      }
    }
  </style>
</head>
<body class="bg-light d-flex flex-column min-vh-100">
  <main class="container py-5 flex-grow-1">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
      <h1 class="mb-0">Student List</h1>
      <div class="d-flex flex-wrap gap-2">
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

    <div class="table-responsive container-glass bg-white rounded shadow-sm">
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
              <td><a href="{{ route('student.profile.edit', $studentlist->id) }}" class="btn btn-sm btn-primary update-action">Update</a></td>
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
    <button type="submit" class="btn btn-outline-danger logout-btn">Logout</button>
  </form>
</body>
</html>
