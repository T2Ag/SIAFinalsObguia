<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        *{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td{
            border: 1px solid #333;
            padding: 5px;
            text-align: center;
        }
        .qr-code-cell {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Logbooks</h1>
    <hr>
    <table>
        <thead>
            <tr>
                <th>Client Name</th>
                <th>Logbook ID</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>QR Code</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logbooks as $logbook)
                <tr>
                    <td>{{ $logbook->client->first_name }} {{ $logbook->client->last_name }}</td>
                    <td>{{ $logbook->id }}</td>
                    <td>{{ $logbook->created_at }}</td>
                    <td>{{ $logbook->updated_at }}</td>
                    <td class="qr-code-cell"><img src="data:image/png;base64,{{ base64_encode(QrCode::size(100)->generate($logbook->id)) }}" alt="QR Code"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>