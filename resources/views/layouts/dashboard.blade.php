<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    {{-- link bootstrap cdn --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

    @vite(['resources/css/dashboard.css'])
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Dashboard</h1>
                <nav class="navbar">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.posts.index') }}">Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.categories.index') }}">Categories</a>
                        </li>
                    </ul>
                </nav>
                <hr>

                @yield('content')
            </div>
        </div>
    </div>    
    @vite(['resources/js/dashboard.js'])
</body>
</html>