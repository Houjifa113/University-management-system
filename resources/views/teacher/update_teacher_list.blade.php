<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Teacher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-5">
                <h1>Update Teacher</h1>
                <p>Change only the fields you want. Leave a field blank if you don't want to change it.</p>
                @php($isTeacher = Auth::guard('web')->check())
                <form action="{{ $profileEdit ? route('teacher.profile.update', $teacherlist) : route('teacherlist.update', $teacherlist) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if (! $isTeacher)
                    <div class="input-form">
                        <input type="text" placeholder="Name" name="name" value="{{ old('name', $teacherlist->name) }}">
                        @error('name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    @endif

                    @if (! $isTeacher)
                    <div class="input-form">
                        <input type="text" placeholder="Email" name="email" value="{{ old('email', $teacherlist->email) }}">
                        @error('email')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    @endif

                    <div class="input-form">
                        <input type="password" placeholder="Password" name="password">
                        <input type="password" placeholder="Confirm password" name="password_confirmation">
                        @error('password')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    @if (! $isTeacher)
                    <div class="input-form">
                        <input type="text" placeholder="Department" name="department" value="{{ old('department', $teacherlist->department) }}">
                        @error('department')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    @endif

                    <div class="input-form">
                        <label for="image">Profile image (JPG, PNG, or GIF — maximum 3 MB)</label>
                        <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/gif">
                        @error('image')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-form">
                        <button type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
