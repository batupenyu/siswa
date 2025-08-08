<!DOCTYPE html>
<html>

<head>
    <title>SPMT Details</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 100%;
            max-width: 800px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ public_path('images/kopSekolah.PNG') }}" alt="Kop Sekolah">
    </div>
    <h1>SPMT Details</h1>
    <table>
        <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $spmt->id }}</td>
            </tr>
            <tr>
                <th>Pegawai</th>
                <td>{{ $spmt->pegawai->nama }}</td>
            </tr>
            <tr>
                <th>Dasar Surat</th>
                <td>{{ $spmt->dasar_surat }}</td>
            </tr>
            <tr>
                <th>Nomor Surat</th>
                <td>{{ $spmt->nomor_surat }}</td>
            </tr>
            <tr>
                <th>Tanggal Surat</th>
                <td>{{ $spmt->tgl_surat }}</td>
            </tr>
            <tr>
                <th>Hal Surat</th>
                <td>{{ $spmt->hal_surat }}</td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td>{{ $spmt->keterangan }}</td>
            </tr>
            <tr>
                <th>Tanggal Ditetapkan</th>
                <td>{{ $spmt->tgl_ditetapkan }}</td>
            </tr>
            <tr>
                <th>Tempat Ditetapkan</th>
                <td>{{ $spmt->tempat_ditetapkan }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>