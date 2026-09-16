<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background-color: #0f172a !important;
            background-image:
                radial-gradient(at 0% 0%, hsla(217, 91%, 30%, 1) 0, transparent 50%),
                radial-gradient(at 100% 0%, hsla(199, 89%, 48%, 1) 0, transparent 50%),
                radial-gradient(at 50% 100%, hsla(215, 25%, 27%, 1) 0, transparent 50%) !important;
            color: #f1f5f9 !important;
            font-family: 'Inter', -apple-system, sans-serif;
        }

        h1, h2, h3, .h1, .h2, .h3 {
            color: #e2e8f0 !important;
            font-weight: 700;
            text-shadow: 0 2px 4px rgb(0 0 0 / 20%);
        }

        .glass-card {
            border: 1px solid rgb(255 255 255 / 10%);
            border-radius: 20px;
            background-color: rgb(255 255 255 / 5%);
            box-shadow: 0 8px 32px 0 rgb(0 0 0 / 37%);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        label {
            color: #64ffda !important;
            font-weight: 600;
        }

        .form-control, .form-select {
            border: 1px solid rgb(100 255 218 / 30%);
            border-radius: 8px;
            background-color: rgb(2 12 27 / 50%);
            color: #fff;
        }

        .form-control:focus, .form-select:focus {
            border-color: #64ffda;
            background-color: rgb(2 12 27 / 70%);
            box-shadow: 0 0 0 0.25rem rgb(100 255 218 / 15%);
            color: #fff;
        }

        .form-select option {
            background-color: #0f172a;
            color: #fff;
        }

        .form-check-input:checked {
            background-color: #00bfa5;
            border-color: #64ffda;
        }

        .text-muted {
            color: #94a3b8 !important;
        }

        .btn-cancel {
            border: 1px solid #0ea5e9;
            border-radius: 8px;
            background: rgb(15 23 42 / 25%);
            color: #7dd3fc;
            font-weight: 600;
        }

        .btn-update-profile {
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #64ffda 0%, #00bfa5 100%);
            box-shadow: 0 10px 15px -3px rgb(100 255 218 / 30%);
            color: #0a192f;
            font-weight: 700;
        }

        @media (max-width: 576px) {
            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <main class="container py-4 py-md-5" style="max-width: 54rem;">
        <div class="mb-4">
            <p class="text-info text-uppercase small fw-semibold mb-1">Student</p>
            <h1 class="mb-1">Update Student Information</h1>
            <p class="text-white mb-0">Change only the fields you want. Leave a field blank to keep its current value.</p>
        </div>

        <section class="glass-card p-4 p-md-5">
            @php($isStudent = Auth::guard('student')->check())
            <form action="{{ route('student.profile.update', $studentlist) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    @if (! $isStudent)
                    <div class="col-md-6">
                        <label class="form-label" for="username">Username</label>
                        <input class="form-control" id="username" type="text" name="username" value="{{ old('username', $studentlist->username) }}">
                        @error('username') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" id="email" type="email" name="email" value="{{ old('email', $studentlist->email) }}">
                        @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    @endif

                    <div class="col-md-6">
                        <label class="form-label" for="password">New password <span class="text-muted">(leave blank to keep current)</span></label>
                        <input class="form-control" id="password" type="password" name="password">
                        @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="password_confirmation">Confirm new password</label>
                        <input class="form-control" id="password_confirmation" type="password" name="password_confirmation">
                    </div>

                    @if (! $isStudent)
                    <div class="col-md-6">
                        <label class="form-label d-block">Gender</label>
                        <div class="d-flex gap-3 pt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Male" id="male" {{ old('gender', $studentlist->gender) == 'Male' ? 'checked' : '' }}>
                                <label class="form-check-label text-white" for="male">Male</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Female" id="female" {{ old('gender', $studentlist->gender) == 'Female' ? 'checked' : '' }}>
                                <label class="form-check-label text-white" for="female">Female</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Other" id="other" {{ old('gender', $studentlist->gender) == 'Other' ? 'checked' : '' }}>
                                <label class="form-check-label text-white" for="other">Other</label>
                            </div>
                        </div>
                        @error('gender') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="designation">Department</label>
                        <select class="form-select" name="designation" id="designation">
                            <option value="Not Selected">Select</option>
                            <option value="SWE" {{ old('designation', $studentlist->department) == 'SWE' ? 'selected' : '' }}>SWE</option>
                            <option value="BA" {{ old('designation', $studentlist->department) == 'BA' ? 'selected' : '' }}>BA</option>
                            <option value="PM" {{ old('designation', $studentlist->department) == 'PM' ? 'selected' : '' }}>PM</option>
                        </select>
                        @error('designation') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                    @endif

                    <div class="col-12">
                        <label class="form-label" for="image">Profile image <span class="text-muted">(JPG, PNG, or GIF)</span></label>
                        @if ($studentlist->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $studentlist->image) }}" class="rounded" style="width: 70px; height: 70px; object-fit: cover; border: 2px solid rgb(100 255 218 / 30%);">
                            </div>
                        @endif
                        <input class="form-control" type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.gif">
                        @error('image') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex flex-column flex-sm-row justify-content-between gap-2 mt-4 pt-2">
                    @if ($isStudent)
                        <a href="{{ route('student.profile', $studentlist->id) }}" class="btn btn-cancel">Cancel</a>
                    @else
                        <a href="{{ route('studentlist', ['sort' => 'department', 'page' => 1]) }}" class="btn btn-cancel">Cancel</a>
                    @endif
                    <button class="btn btn-update-profile" type="submit">Update</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
