<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>@yield('title')</title>
    @section('navMovie', 'active')

    <style>
        html, body {
            height: 100%;
        }
        main > .container {
            padding: 60px 15px 0px;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-success">
            <div class="container">
                <a class="navbar-brand" href="#"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link @yield('navMovie')" href="/">MOVIE-DB</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('navhome')" href="/">home</a>
                        </li>
                        @auth
                        <li class="nav-item">
                            <a class="nav-link @yield('navInmov')" href="/movie/create/">Add Movie</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="">{{ Auth::user()->name }}</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link @yield('navLogin')" href="/login">Login</a>
                        </li>
                        @endauth
                    </ul>
                    <form class="d-flex" role="search" method="GET" action="{{ url('/') }}">
                        <input class="form-control me-2" type="search" name="search" placeholder="Search judul..." value="{{ request('search') }}">
                        <button class="btn btn-outline-light" type="submit">Search</button>
                    </form>
                    @auth
                        <div class="ms-3">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-dark">Logout</button>
                            </form>
                        </div>

                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-shrink-0">
        <div class="container">
            @yield('container')
        </div>
    </main>

    <footer class="text-center bg-success text-white mt-auto py-2">
        <p class="mb-0" style="font-size: 14px;">
            &copy; 2025 Company, Inc. &middot; <a href="#" class="text-white text-decoration-underline">Privacy</a> &middot; <a href="#" class="text-white text-decoration-underline">Terms</a>
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>