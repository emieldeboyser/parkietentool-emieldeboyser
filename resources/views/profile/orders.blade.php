@extends("layouts/main")

@section("styles")
    @vite(['resources/css/app.css'])
@endsection

@section('content')
    <div>
      <h3>Bestellingen</h3>
      <table class="table">
        <thead>
          <tr>
            <th>Bestelling</th>
            <th>Datum</th>
            <th>Bedrag</th>
            <th>Status</th>
            <th>Betaling</th>
          </tr>
        </thead>
        @foreach ($orders as $order)
        <tbody>                  
          <tr>
            <td>
                <a href="{{ route('profile.show', ['reference' => $order->reference]) }}">
                                        # {{ $order->reference }}
                                    </a>
            </td>
            <td># {{$order->reference}}</td>
            <td>{{$order->created_at}}</td>
            <td>€{{$order->total_price}}</td>
            <td>
              @if ($order->status == 1)
                Word voorbereid

              @elseif ($order->status == 2)
                Verzonden
              @else 
                Geannuleerd
              @endif
            </td>
            <td>{{$order->payment_data}}</td>
          </tr>
        </tbody>
        @endforeach
      </table>
    </div>

@endsection

@section('scripts')
    <script>
        console.log('Page specific script code goes here');
    </script>
@endsection
