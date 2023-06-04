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
                    <p><a href="{{ route('profile.orders') }}">Go to your orders page</a></p>
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