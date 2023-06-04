@extends("layouts/main")

@section("styles")
    @vite(['resources/css/app.css'])
@endsection

@section('content')
  <h1>Welkom bij de Belgische Vereninging van Parkieten- en Papegaaienliefhebbers vzw</h1>
    @if (Auth::guest())
        <p>Welcome!</p>
    @else
        <p>Welcome, {{ Auth::user()->name }}!</p>
    @endif

  <a href="{{route('order.index')}}">Bestel hier je ringen!</a>
  <a href="{{route('profile.orders')}}">Uw bestellingen</a>
@endsection

@section('scripts')
    <script>
        console.log('Page specific script code goes here');
    </script>
@endsection