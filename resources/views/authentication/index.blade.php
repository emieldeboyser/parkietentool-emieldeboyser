@extends("layouts/main")

@section("styles")
    @vite(['resources/css/app.css'])
@endsection

@section('content')
<h1>Log je hier in</h1>
  <form method="POST" action="/login" enctype="multipart/form-data" >
    	@csrf
    <label for="email">Emailadres:</label>
    <input type="email" name="email" id="email" placeholder="emailadres" required autofocus>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" placeholder="wachtwoord" required>
    <button>Login</button>
  </form>
@endsection

@section('scripts')
    <script>
        console.log('Page specific script code goes here');
    </script>
@endsection



