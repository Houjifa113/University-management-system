<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Teacher</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
  <main class="container py-5 flex-grow-1" style="max-width: 48rem;">
    <div class="mb-4">
      <h1 class="mb-1">Register Teacher</h1>
      <p class="text-muted mb-0">Create a teacher account and set up their profile.</p>
    </div>

    @if (session('success'))
      <div class="alert alert-success shadow-sm" role="status">
        {{ session('success') }}
      </div>
    @endif

    <div class="card border-0 shadow-sm">
      <div class="card-body p-4 p-md-5">
        <form action="{{ route('teacherlist.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="row g-4">
            <div class="col-md-6">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="email" class="form-label">Email address</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="password_confirmation" class="form-label">Confirm password</label>
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>

            <div class="col-12">
              <label for="department" class="form-label">Department</label>
              <input type="text" class="form-control @error('department') is-invalid @enderror" id="department" name="department" value="{{ old('department') }}">
              @error('department')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-12">
              <label for="image" class="form-label">Profile image</label>
              <p class="form-text mt-0 mb-2">JPG, PNG, or GIF — maximum 3 MB.</p>
              <div class="d-flex flex-wrap align-items-center gap-2">
                <label for="image" class="btn btn-outline-primary">Upload Image</label>
                <span id="image-name" class="text-muted small">No image selected</span>
              </div>
              <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/gif" required hidden>
              @error('image')
                <div class="text-danger small mt-2">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="mt-4 pt-2">
            <button type="submit" class="btn btn-success">Register Teacher</button>
          </div>
        </form>
      </div>
    </div>
  </main>

  <script>
    document.getElementById('image').addEventListener('change', function () {
      document.getElementById('image-name').textContent = this.files[0]
        ? this.files[0].name
        : 'No image selected';
    });
  </script>
</body>
</html>
