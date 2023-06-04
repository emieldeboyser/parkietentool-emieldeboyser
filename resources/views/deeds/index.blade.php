@extends("layouts/main")

@section("styles")
    @vite(['resources/css/app.css'])
@endsection

@section('content')
<div>
  <h1>Eigendoms bewijzen genereren</h1>
</div>
<div class="card">
  <div class="card-body">
    <p class="card-text">Hieronder vind je een lijst van alle eigendoms bewijzen die je kan genereren.</p> 
    <p class="card-text">Hier kan je eigendoms bewijzen genereren.</p>
  </div>
</div>
<table class="table">
        <thead>
          <tr>
            <th>Bestelling</th>
            <th>Datum</th>
            <th>Bedrag</th>
            <th>Status</th>
            <th>Betaling</th>
            <th>Actie</th> <!-- Added a new column for the button -->
          </tr>
        </thead>
        @foreach ($orders as $order)
        <tbody>
            <tr>
                <td>
                    <a href="{{ route('deeds.show', ['reference' => $order->reference]) }}">
                            # {{ $order->reference }}
                        </a>
                </td>
                <td>{{ $order->created_at }}</td>
                <td>€{{ $order->total_price }}</td>
                <td>
                    @if ($order->status == 1) Word voorbereid @elseif ($order->status == 2) Verzonden @else Geannuleerd @endif
                </td>
                <td>{{ $order->payment_data }}</td>
                <td>
                    <a href="{{ route('deeds.pdf', ['reference' => $order->reference]) }}" class="btn btn-primary">Maak bewijs</a> <!-- Updated the button route -->
                </td>
            </tr>
        </tbody>
        @endforeach
      </table>
@endsection

@section('scripts')
    <script>
        console.log('Page specific script code goes here');
    </script>
@endsection
