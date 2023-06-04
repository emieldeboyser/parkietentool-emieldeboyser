@extends("layouts/main")

@section("styles")
    @vite(['resources/css/app.css'])
@endsection

@section('content')
    <div class="hero">
        <h1>Welkom bij de Belgische Vereninging van Parkieten- en Papegaaienliefhebbers vzw</h1>
        
        <div class="welcome-message">
            @if (Auth::guest())
            <p>Welkom!</p>
            @else
            <p>Welkom, {{ Auth::user()->name }}!</p>
            @endif
        </div>
        <div class="hero-img">
            <img src="../storage/images/birds.png" alt="wa?">
        </div>

    </div>
  
@endsection

@section('scripts')
    <script>
        console.log('Page specific script code goes here');
    </script>
@endsection