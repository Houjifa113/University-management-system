<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Profile</title>

   
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

    <!-- Full Screen Container -->
    <main class="container-fluid min-vh-100 p-0">

        <!-- Full Screen Card -->
        <div class="card border-0 rounded-0 min-vh-100">

            <div class="card-body p-5">

                <!-- Page Title -->
                <h1 class="h3 mb-4">
                    Admin Profile
                </h1>


                <!-- Success Message -->
                @if (session('success'))

                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>

                @endif


                <!-- Profile Information -->
                <dl class="row mb-0">

                    <!-- Name -->
                    <dt class="col-sm-4">
                        Name
                    </dt>

                    <dd class="col-sm-8">
                        {{ $adminProfile->name }}
                    </dd>


                    <!-- Email -->
                    <dt class="col-sm-4">
                        Email
                    </dt>

                    <dd class="col-sm-8">
                        {{ $adminProfile->email }}
                    </dd>


                    <!-- Department -->
                    <dt class="col-sm-4">
                        Department
                    </dt>

                    <dd class="col-sm-8">
                        {{ $adminProfile->department }}
                    </dd>

                </dl>


                <!-- Update Button -->
                <div class="mt-4 text-center">

                    <a
                        href="{{ route('admin.profile.edit') }}"
                        class="btn btn-primary px-4"
                    >
                        Update Profile
                    </a>

                </div>

            </div>

        </div>

    </main>


    <!-- Bootstrap JavaScript -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>

</body>

</html>