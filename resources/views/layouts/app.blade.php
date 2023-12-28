<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'My Blog')</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include your custom external CSS -->
    <script src="https://kit.fontawesome.com/e2bed88b0f.js" crossorigin="anonymous"></script>

    <style>
        body{
            background-color: rgb(249 250 251);

        }
    </style>
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img src="{{ asset('images/Logo.jpeg') }}" alt="" height="40" width="40">
            </a>

            @auth
            <p class="text-white mb-0">Welcome {{ auth()->user()->name }}</p>
            @endauth

            <!-- Navbar Toggler Button for Small Screens -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Right-aligned navigation link (e.g., Account) -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/user') }}">Account</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>


    <main style="padding-top: 56px;"> <!-- Add padding to the top to account for the fixed navigation bar -->
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Add your JavaScript scripts or link to external scripts here -->

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
