@extends("layouts/main")

@section("styles")
    @vite(['resources/css/app.css'])
@endsection

@section('content')
<div class="profilePage">
    <header class="profileActions">
        <a href="/profile/settings" class="btn btn-primary">Profiel aanpassen</a>
        <a href="/profile/orders" class="btn btn-primary">Orders</a>
    </header>
    <h3>Mijn Profiel</h3>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Personal Information</h5>
            <div class="profileDetails">
                <img src="../storage/{{ $user->avatar }}" alt="not loading" class="profilePicture">
                <p class="card-text">Naam: {{$user->name}}</p>
                <p class="card-text">Stamnummer: {{$user->stamnr}}</p>
                <p class="card-text">Email: {{$user->email}}</p>
                <p class="card-text">Adres: {{$user->address_street}} {{$user->address_nr}}, {{$user->address_zipcode}} {{$user->address_city}}</p>
                <p class="card-text">Telefoonnummer: {{$user->phone}}</p>
                <p class="card-text">Geboortedatum: {{$user->birthday}}</p>
            </div>
        </div>
    </div>

    <div class="card">
    <div class="card-body">
        <h5 class="card-title">Lidmaatschap:</h5>
        @if($subscriptionData && $subscriptionData['membership_paid'] == "Betaald")
            <div class="profileDetails">
                <p class="card-text">Lid sinds: {{ $subscriptionData['membership_started'] }}</p>
                <p class="card-text">Lid tot: {{ $subscriptionData['membership_end'] }}</p>

                <p class="card-text">Lidmaatschap:
                    @if ($subscriptionData['membership_end'] < $today)
                        <span style="color: green;">Actief</span>
                    @else
                        <span style="color: red;">Verlopen</span>
                    @endif
                </p>
            </div>
            <br>
            @if ($subscriptionData['membership_end'] > $today)
                <a href="/profile/lidgeld" class="btn btn-primary">Betaal hier voor uw lidmaatschap x</a>
            @endif
        @else
            <p class="card-text">U bent geen lid.</p>
            <a href="/profile/lidgeld" class="btn btn-primary">Betaal hier voor uw lidmaatschap!</a>
        @endif
    </div>
</div>

</div>
@endsection

@section('scripts')
    <script>
        console.log('Page specific script code goes here');
    </script>
@endsection
