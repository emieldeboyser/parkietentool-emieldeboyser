<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eigendomsbewijs</title>
    <script src="https://kit.fontawesome.com/3ab5c64d34.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="display-4">Eigendomsbewijs kweekringen BVP seizoen 2023</h1>
        <h4 class="mb-4">De volgende ringen behoren toe aan Mr/Mevr</h4>
        <h4 class="mb-3">Naam: {{ $user_Name }}</h4>
        <h4 class="mb-3">Stamnummer: {{ $stamnummer }}</h4>

        <table class="table">
            <thead>
                <tr>
                    <th>stamnr:</th>
                    <th>maat</th>
                    <th>code</th>
                    <th>aantal</th>
                    <th>beginnr:</th>
                    <th>eindnr:</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ring as $index => $ringItem)
                @php
                    $nameParts = explode('-', $ringItem->name);
                    $price = isset($nameParts[1]) ? $nameParts[1] : '';
                @endphp
                <tr>
                    <td>{{ $stamnummer }}</td>
                    <td>{{ $ringItem->size }} mm</td>
                    <td>{{ $ringItem->name }}</td>
                    <td>{{ number_format(($amountArr[$index])/$price), 0, '', '' }}</td>
                    <td>01</td>
                    <td>0{{ number_format(($amountArr[$index])/$price), 0, '', '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p>Uitgereikt door de ringendienst BVP, volgens het reglement goedgekeurd door BVP Nationaal.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
