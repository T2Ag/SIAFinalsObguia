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
        }
    </style>
</head>
<body>
    <h1>Clients</h1>

    <hr>

    <table class="table table-bordered table-striped">
        <thead class="table">
            <tr>
                <th>First Name</th>
                <th>First Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Membership</th>
                <th>QR code</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $c)
                <tr>
                    <td>{{ $c->first_name }}</td>
                    <td>{{ $c->last_name }}</td>
                    <td>{{ $c->address }}</td>
                    <td>{{ $c->phone }}</td>
                    <td>{{ $c->membership->type }}</td>
                   <td><img src="data:image/png;base64,{{ base64_encode(QrCode::size(100)->generate($c->id)) }}" alt="QR Code"></td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>