@extends("layouts/main")

@section("styles")
@vite(['resources/css/app.css'])
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bestelling besteld!</div>

                <div class="card-body">
                    <p>Wij hebben je bestelling goed ontvangen!</p>
                    <p>We gaan de bestelling pas opsturen als we je cash geld hebben ontvangen.</p>

                    <p>Voor de betalling van het cash geld verwachten we dat je €{{$orderTotal}} in een enveloppe steekt. Je schrijft daarna op de enveloppe: <b>{{$user_Name}}, #{{$orderNumber}}</b>.</p>
                    <p>Je stuurt of brengt deze enveloppe naar:</p>
                    <p><b>De Backer Luc</b></p>
                    <p><b>BVP-Ringendienst</b></p>
                    <p><b>Vikingstraat 14</b></p>
                    <p><b>8800 ROESELARE</b></p>
                    <p><a href="{{ route('profile.orders') }}">Ga naar je bestellingen</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    console.log('Page specific script code goes here');
</script>
@endsection