<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form kp4</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0.5cm 20px 20px 20px;
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
            font-size: 10pt;
        }

        p {
            font-size: 10pt;
        }

        .family-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .family-table,
        .family-table th,
        .family-table td {
            border: 1px solid black;
        }

        .family-table th,
        .family-table td {
            padding: 4px;
            font-size: 10px;
            text-align: center;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .signature {
            text-align: center;
            width: 45%;
        }

        .signature p {
            margin-top: 60px;
        }

        .family-table tr:nth-child(2) th {
            width: 10%;
        }
    </style>
</head>

<body>
    <div style="margin-bottom: 20px; text-align: right;font-size: 10pt;">
        <button type="button" onclick="window.scrollTo({ top: 0, behavior: 'smooth' });">FORM.KP4</button>
    </div>

    <div class="header" id="top">
        <h4>SURAT KETERANGAN <br>
            UNTUK MENDAPATKAN PEMBAYARAN TUNJANGAN KELUARGA</h4>
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
            <td>{{ str($pegawai->agama)->title() ?? '' }}</td>
        </tr>
        <tr>
            <td>6. Status Kepegawaian</td>
            <td>:</td>
            <td>{{ $pegawai->status_kepegawaian ?? '' }} Daerah Provinsi Kepulauan Bangka Belitung</td>
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
            <td>{{ $penilai->unitkerja ?? '' }}</td>
        </tr>
        <tr>
            <td>10. Masa kerja golongan</td>
            <td>:</td>
            <td>
                @if($pegawai->tgl_tmt_jabatan)
                {{ \Carbon\Carbon::parse($pegawai->tgl_tmt_jabatan)->diffInYears(\Carbon\Carbon::now()) }} Tahun
                {{ \Carbon\Carbon::parse($pegawai->tgl_tmt_jabatan)->diffInMonths(\Carbon\Carbon::now()) % 12 }} Bulan
                @else
                ''
                @endif
            </td>
        </tr>
        <tr>
            <td>11. Digaji menurut</td>
            <td>:</td>
            <td style="text-align: justify;">
                {{$ppgaji->description ?? ''}}
            </td>
        </tr>
        <tr>
            <td>12. Alamat/tempat tinggal</td>
            <td>:</td>
            <td>{{ $pegawai->alamat ?? '' }}</td>
        </tr>
    </table>

    <p style="text-align: justify;">menerangkan dengan sesungguhnya bahwa saya mempunyai susunan keluarga sebagai berikut:</p>

    @if(isset($pasangan) && $pasangan->get()->whereNotNull('nama')->isNotEmpty())
    @include('anak.tabel_isi')
    @else
    @include('anak.tabel_kosong')
    @endif

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
                NIP. {{ $pegawai->nip ?? '' }}
            </p>
        </div>
    </div>
</body>