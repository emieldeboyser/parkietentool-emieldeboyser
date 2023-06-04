@extends("layouts/main")

@section("styles")
    @vite(['resources/css/app.css'])
@endsection

@section('content')
  <div class="profilePage">
    <h3>Mijn Profiel</h3>
    <a href="/logout">Uitloggen</a>
    <div>
      <img src="../storage/{{ $user->avatar }}" alt="not loading" class="profilePicture">
      {{-- change the emailadress --}}
      <form action="/profile/settings/picture" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="avatar">Kies een nieuwe profielfoto:</label>
        <input type="file" name="avatar" id="avatar">
        <button type="submit" class="btn btn-primary">Verander</button>
      </form>
      <form action="/profile/settings" method="POST" enctype="multipart/form-data" class="edit">
        @csrf

        <label for="name">Verander je voornaam:</label>
        <input type="text" name="firstname" id="firstname" value="{{$user->firstname}}">
        <label for="name">Verander je achternaam:</label>
        <input type="text" name="lastname" id="lastname" value="{{$user->lastname}}">

        <label for="stamnr">Verander je stamnummer:</label>
        <input type="text" name="stamnr" id="stamnr" value="{{$user->stamnr}}">

        <label for="email">Verander je emailadres:</label>
        <input type="email" name="email" id="email" value="{{$user->email}}">

        <label for="password">Verander je wachtwoord:</label>
        <input type="password" name="password" id="password">

        <label for="adress_street">Straatnaam:</label>
        <input type="text" name="address_street" id="address_street" value="{{$user->address_street}}">
        <label for="adress_nr">Straatnummer:</label>
        <input type="text" name="address_nr" id="address_nr" value="{{$user->address_nr}}">
        <label for="adress_zip">ZIPCode:</label>
        <input type="number" name="address_zipcode" id="adrdess_zipcode" value="{{$user->address_zipcode}}">
        <label for="adress_city">Stad:</label>
        <input type="text" name="address_city" id="address_city" value="{{$user->address_city}}">

        <label for="phone">Verander je telefoonnummer:</label>
        <input type="text" name="phone" id="phone" value="{{$user->phone}}">

        <label for="birthday">Verander je geboortedatum:</label>
        <input type="date" name="birthday" id="birthday" value="{{$user->birthday}}">
        <button type="submit" class="btn btn-primary">Verander</button>
      </form>
    </div>
  </div>
@endsection

@section('scripts')
    <script>
        console.log('Page specific script code goes here');
    </script>
@endsection
