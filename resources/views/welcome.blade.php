@extends("layouts/main")

@section("styles")
    @vite(['resources/css/app.css'])
@endsection

@section('content')
    <div class="hero">
        <h1>Welkom bij de Belgische Vereninging van Parkieten- en Papegaaienliefhebbers vzw</h1>
        
        <div class="welcome-message">
            @if (Auth::guest())
            <p>Welcome!</p>
            @else
            <p>Welcome, {{ Auth::user()->name }}!</p>
            @endif
        </div>

    </div>
  
@endsection

@section('scripts')
    <script>
        console.log('Page specific script code goes here');
    </script>
@endsection