<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admin Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <main class="container py-5" style="max-width: 36rem;">
        <div class="card">
            <div class="card-body">
                <h1 class="h3 mb-4">Update Admin Profile</h1>
                <form action="{{ route('admin.profile.update') }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control" id="name" type="text" name="name" value="{{ old('name', $adminProfile->name) }}" required>
                        @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" id="email" type="email" name="email" value="{{ old('email', $adminProfile->email) }}" required>
                        @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="department">Department</label>
                        <input class="form-control" id="department" type="text" name="department" value="{{ old('department', $adminProfile->department) }}" required>
                        @error('department') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="password">New password <span class="text-muted">(optional)</span></label>
                        <input class="form-control" id="password" type="password" name="password">
                        @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="password_confirmation">Confirm new password</label>
                        <input class="form-control" id="password_confirmation" type="password" name="password_confirmation">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.profile') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button class="btn btn-primary" type="submit">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
