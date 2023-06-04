<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Parkieten ringen</title>
        <script src="https://kit.fontawesome.com/3ab5c64d34.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


        @yield('styles')
    </head>
    <body>
<body>
    {{-- include header --}}
    @include('partials.header')
 
    {{-- include content --}}
    @yield('content')

    {{-- include footer --}}
    @include('partials.footer')

    @yield('scripts') 
{{-- 
    @vite([
        'resources/js/common.js',
        'resources/js/app.js'
    ]) --}}
    </body>
</html>