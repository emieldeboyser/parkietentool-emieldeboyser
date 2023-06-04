@extends("layouts/main")

@section("styles")
    @vite(['resources/css/app.css'])
@endsection

@section('content')
<div class="login">
<h1>Log je hier in!</h1>
  <form method="POST" action="/login" enctype="multipart/form-data" >
    	@csrf
      <div class="email">
          <label for="email">Emailadres:</label>
          <input type="email" name="email" id="email" placeholder="Emailadres" required autofocus>
      </div>
      <div class="password">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="wachtwoord" required>
      </div>
    <button class="btn btn-primary">Login</button>
  </form>
</div>

@endsection

@section('scripts')
    <script>
        console.log('Page specific script code goes here');
    </script>
@endsection



