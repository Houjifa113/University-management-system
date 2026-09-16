<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
  <main class="container py-5 flex-grow-1">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
      <div>
        <h1 class="mb-1">Add Student</h1>
        <p class="text-muted mb-0">Create a new student account and profile.</p>
      </div>
      <a href="{{ route('studentlist') }}" class="btn btn-outline-primary align-self-start align-self-sm-center">Student List</a>
    </div>

    <div class="card shadow-sm border-0">
      <div class="card-body p-4 p-md-5">
        <form action="{{ route('add.studentlist') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="row g-4">
            <div class="col-md-6">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" autocomplete="username" required>
              @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" autocomplete="email" required>
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" autocomplete="new-password" required>
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="designation" class="form-label">Department</label>
              <select class="form-select @error('designation') is-invalid @enderror" name="designation" id="designation" required>
                <option value="" disabled @selected(! old('designation'))>Select a department</option>
                <option value="SWE" @selected(old('designation') === 'SWE')>SWE</option>
                <option value="BA" @selected(old('designation') === 'BA')>BA</option>
                <option value="PM" @selected(old('designation') === 'PM')>PM</option>
              </select>
              @error('designation')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <fieldset class="col-12">
              <legend class="col-form-label pt-0 mb-2">Gender</legend>
              <div class="d-flex flex-wrap gap-3">
                @foreach (['Male', 'Female', 'Other'] as $gender)
                  <div class="form-check">
                    <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" value="{{ $gender }}" id="gender-{{ strtolower($gender) }}" @checked(old('gender') === $gender) required>
                    <label class="form-check-label" for="gender-{{ strtolower($gender) }}">{{ $gender }}</label>
                  </div>
                @endforeach
              </div>
              @error('gender')
                <div class="text-danger small mt-2">{{ $message }}</div>
              @enderror
            </fieldset>

            <div class="col-12">
              <label for="image" class="form-label">Profile image <span class="text-muted">(optional)</span></label>
              <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.gif,image/jpeg,image/png,image/gif">
              <div class="form-text">Accepted formats: JPG, JPEG, PNG, or GIF.</div>
              @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="d-flex flex-wrap gap-2 mt-4 pt-2">
            <button type="submit" class="btn btn-primary">Register Student</button>
            <a href="{{ route('studentlist') }}" class="btn btn-outline-secondary">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </main>
</body>
</html>
