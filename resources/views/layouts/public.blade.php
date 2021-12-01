<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CodeWithSadiQ</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Styles -->

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>

    <div class="navbar navbar-expand-lg navbar-dark py-4" style="background:#7158e2">
        <div class="container px-5">
            <a href="" class="navbar-brand">Code with sadiq</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="{{ route('homepage') }}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Placements</a></li>
                    <li class="nav-item"><a href="{{ route('courses') }}" class="nav-link">Courses</a></li>
                    <li class="nav-item"><a href="" class="nav-link">Contact</a></li>
                    <li class="nav-item"><a href="" class="nav-link">WorkShop</a></li>
                    <li class="nav-item"><a href="{{ route('apply') }}" class="btn btn-success">Apply for
                            Admission</a></li>
                </ul>
            </div>
        </div>
    </div>

    @section('content')
    @show()
</body>

</html>
