<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Teacher</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Dashboard Background - Navy & Moonlight Blue */
    body {
      min-height: 100vh;
      background-color: #0a192f !important;
      background-image: linear-gradient(135deg, #0a192f 0%, #112240 50%, #1e3a8a 100%) !important;
      background-attachment: fixed !important;
      color: #e6f1ff !important;
    }

    /* Crystal Blue Card */
    .card {
      background: rgb(30 58 138 / 40%) !important;
      border: 1px solid rgb(255 255 255 / 20%) !important;
      border-radius: 20px !important;
      box-shadow: 0 8px 32px 0 rgb(0 0 0 / 30%) !important;
      color: #fff !important;
      backdrop-filter: blur(20px) saturate(160%) !important;
      -webkit-backdrop-filter: blur(20px) saturate(160%) !important;
    }

    /* Professional Dashboard Form Fields */
    input, select, textarea {
      padding: 12px 15px !important;
      border: 2px solid rgb(100 255 218 / 30%) !important;
      border-radius: 8px !important;
      background-color: rgb(255 255 255 / 5%) !important;
      color: #fff !important;
      transition: all 0.3s ease !important;
    }

    input:focus, select:focus, textarea:focus {
      outline: none !important;
      border-color: #64ffda !important;
      background-color: rgb(255 255 255 / 10%) !important;
      box-shadow: 0 0 10px rgb(100 255 218 / 30%) !important;
    }

    label {
      color: #64ffda !important;
      font-weight: 600 !important;
      letter-spacing: 0.5px !important;
    }

    /* Visibility Enhancements */
    .form-text {
      color: #64ffda !important;
      font-weight: 600 !important;
      text-shadow: 0 0 5px rgb(100 255 218 / 40%) !important;
    }

    .text-muted.small {
      display: inline-block !important;
      padding: 2px 8px !important;
      border: 1px solid #00ffff !important;
      border-radius: 6px !important;
      background: rgb(0 255 255 / 10%) !important;
      color: #00ffff !important;
      font-size: 0.75rem !important;
      font-weight: 700 !important;
      opacity: 1 !important;
      text-shadow: 0 0 8px rgb(0 255 255 / 30%) !important;
    }

    @media (max-width: 576px) {
      .btn {
        width: 100% !important;
        margin-bottom: 0.5rem !important;
      }
    }
  </style>
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
