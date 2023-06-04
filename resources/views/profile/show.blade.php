@extends("layouts/main")

@section("styles")
    @vite(['resources/css/app.css'])
@endsection

@section('content')
    <div class="container">
        <h1 class="display-4">Bestelling: #{{$order->reference}}</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>maat</th>
                    <th>code</th>
                    <th>aantal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ring as $index => $ringItem)
                @php
                    $nameParts = explode('-', $ringItem->name);
                    $price = isset($nameParts[1]) ? $nameParts[1] : '';
                @endphp
                <tr>
                    <td>{{ $ringItem->size }} mm</td>
                    <td>{{ $ringItem->name }}</td>
                    <td>{{ number_format(($amountArr[$index])/$price), 0, '', '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        console.log('Page specific script code goes here');
    </script>
@endsection
