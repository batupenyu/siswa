<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan Untuk Mendapatkan Pembayaran Tunjangan Keluarga</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin-bottom: 5px;
        }
        .divider {
            border-top: 2px solid black;
            margin: 10px 0;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table td {
            /* padding: 5px; */
            vertical-align: top;
        }
        .family-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .family-table, .family-table th, .family-table td {
            border: 1px solid black;
        }
        .family-table th, .family-table td {
            padding: 4px;
            font-size: 10px;
            text-align: center;
        }
        .footer {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }
        .signature {
            text-align: center;
            width: 45%;
        }
        .signature p {
            margin-top: 60px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>SURAT KETERANGAN <br>
            UNTUK MENDAPATKAN PEMBAYARAN TUNJANGAN KELUARGA</h3>
        <div class="divider"></div>
    </div>

    <p>Saya yang bertanda tangan dibawah ini:</p>

    <table class="info-table">
        <tr>
            <td width="30%">1. Nama lengkap</td>
            <td width="5%">:</td>
            <td>{{ $pegawai->nama ?? '' }}</td>
        </tr>
        <tr>
            <td>2. NIP/NRK</td>
            <td>:</td>
            <td>{{ $pegawai->nip ?? '' }}</td>
        </tr>
        <tr>
            <td>3. Tempat/Tanggal Lahir</td>
            <td>:</td>
            <td>{{ $pegawai->tempat_lahir ?? '' }} / {{ \Carbon\Carbon::parse($pegawai->tgl_lahir ?? now())->translatedFormat('d-m-Y') }}</td>
        </tr>
        <tr>
            <td>4. Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $pegawai->jenis_kelamin ?? '' }}</td>
        </tr>
        <tr>
            <td>5. Agama</td>
            <td>:</td>
            <td>{{ $pegawai->agama ?? '' }}</td>
        </tr>
        <tr>
            <td>6. Status Kepegawaian</td>
            <td>:</td>
            <td>{{ $pegawai->status_kepegawaian ?? '' }}</td>
        </tr>
        <tr>
            <td>7. Jabatan</td>
            <td>:</td>
            <td>{{ $pegawai->jabatan ?? '' }}</td>
        </tr>
        <tr>
            <td>8. Pangkat/Golongan</td>
            <td>:</td>
            <td>{{ $pegawai->pangkat ?? '' }}</td>
        </tr>
        <tr>
            <td>9. Pada Unit Kerja</td>
            <td>:</td>
            <td>{{ $pegawai->unit_kerja ?? '' }}</td>
        </tr>
        <tr>
            <td>10. Masa kerja golongan</td>
            <td>:</td>
            <td>{{ $pegawai->masa_kerja_golongan ?? '' }}</td>
        </tr>
        <tr>
            <td>11. Digaji menurut</td>
            <td>:</td>
            <td>{{ $pegawai->digaji_menurut ?? '' }}</td>
        </tr>
        <tr>
            <td>12. Alamat/tempat tinggal</td>
            <td>:</td>
            <td>{{ $pegawai->alamat ?? '' }}</td>
        </tr>
    </table>

    <p style="text-align: justify;">menerangkan dengan sesungguhnya bahwa saya mempunyai susunan keluarga sebagai berikut:</p>

    <table class="family-table">
        <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">NAMA</th>
            <th rowspan="2">TEMPAT LAHIR</th>
            <th colspan="2">TANGGAL</th>
            <th rowspan="2">PEKERJAAN</th>
            <th rowspan="2">KETERANGAN</th>
            <th rowspan="2">MENDAPATKAN TUNJANGAN</th>
        </tr>
        <tr>
            <th>LAHIR</th>
            <th>PERKAWINAN</th>
        </tr>
        @foreach($pegawai->anak as $index => $item)
        <tr>
            <td>{{ (int)$index + 1 }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->tempat_lahir }}</td>
            <td>{{ \Carbon\Carbon::parse($item->tgl_lahir)->translatedFormat('d-m-Y') }}</td>
            <td>{{ $item->status_pernikahan == 'menikah' ? \Carbon\Carbon::parse($item->tgl_pernikahan ?? now())->translatedFormat('d-m-Y') : '' }}</td>
            <td>{{ $item->status_pekerjaan }}</td>
            <td>{{ $item->keterangan ?? '' }}</td>
            <td>
                @php
                    $age = \Carbon\Carbon::parse($item->tgl_lahir)->age;
                @endphp
                {{ $age <= 21 ? 'ya' : 'tidak' }}
            </td>
        </tr>
        @endforeach
    </table>

    <p style="text-align: justify;">Keterangan ini saya buat dengan sesungguhnya dan apabila keterangan ini ternyata tidak benar (palsu), saya bersedia dituntut dimuka pengadilan berdasarkan Undang-undang yang berlaku, dan bersedia mengembalikan semua penghasilan yang telah saya terima yang seharusnya bukan menjadi hak saya.</p>
    <div class="footer" style="display: inline-block; width: 100%; text-align: center;">
        <div class="signature" style="display: inline-block; width: 45%; margin-right: 5%;">
            <p>Mengetahui: <br>
                {{ $penilai->jabatan ?? '-' }}: <br><br><br><br>
                {{ $penilai->nama ?? '-' }} <br>
                NIP. {{ $penilai->nip ?? '-' }}
            </p>
        </div>
        <div class="signature" style="display: inline-block; width: 45%;">
            <p>Pangkalpinang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }} <br>
                <br><br><br><br>
                {{ $pegawai->nama ?? '' }} <br>
                NIP. {{ $pegawai->nip ?? '' }}</p>
        </div>
    </div>
</body>

