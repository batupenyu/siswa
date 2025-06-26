<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AkKredits PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>AkKredits Report</h1>

    @if ($akKredits->isEmpty())
        <p>No records found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pegawai</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($akKredits as $akKredit)
                    <tr>
                        <td>{{ $akKredit->id }}</td>
                        <td>{{ $akKredit->pegawai->nama }}</td>
                        <td>{{ $akKredit->details }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>