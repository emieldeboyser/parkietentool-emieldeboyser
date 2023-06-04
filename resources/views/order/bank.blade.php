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
                    <p>We gaan de bestelling pas opsturen als we de overschrijving hebben ontvangen.</p>
                    <p>Je schrijft</p>
                    <p><b>€{{$orderTotal}}</b></p>
                    <p>Naar rekeningsnummer:</p>
                    <p><b>BE06 7512 0803 4122</b></p>
                    <p>BIC AXABBE22</p>
                    <p>Met vermelding:</p>
                    <p><b>{{$user_Name}}, #{{$orderNumber}}</b></p>
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