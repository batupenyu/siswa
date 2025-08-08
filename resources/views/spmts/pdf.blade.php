<!DOCTYPE html>
<html>

<head>
    <title>SPMT Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            /* font-size: small; */
            margin-left: 1cm;
            margin-right: 1cm;
            /* line-height: 1.6; */
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

        th {
            background-color: #f2f2f2;
        }

        .document-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .document-number {
            margin-bottom: 20px;
        }

        .content {
            margin-bottom: 10px;
        }

        .signature {
            margin-left: 300px;
        }

        .tembusan {
            margin-top: 50px;
        }

        .data-field {
            border-bottom: 1px solid black;
            display: inline-block;
            min-width: 300px;
            padding-left: 5px;
        }
    </style>
</head>

<div style="text-align: center;">
    <img src="{{ public_path('images/kopSekolah.PNG') }}" alt="Kop Sekolah" style="width: 100%; height: auto; display: inline-block;">
</div>
<br>

<body>
    <div class="header">
        <div class="document-title"><u>SURAT PERNYATAAN MELAKSANAKAN TUGAS</u> <br>
            Nomor: 800/{{ $spmt->nomor_surat ?? '800/......./....../' }}/ ..... / {{ $spmt->tgl_ditetapkan ? \Carbon\Carbon::parse($spmt->tgl_ditetapkan)->format(' Y') : '...............' }}
        </div>
    </div>

    <div class="content">
        <p>Yang bertandatangan di bawah ini :</p>

        <table>
            <tr>
                <td width="175">Nama</td>
                <td>: <span class="data-field">{{ $penilai->nama ?? '........................................' }}</span></td>
            </tr>
            <tr>
                <td>NIP</td>
                <td>: <span class="data-field">{{ $penilai->nip ?? '........................................' }}</span></td>
            </tr>
            <tr>
                <td>Pangkat/Golongan Ruang</td>
                <td>: <span class="data-field">{{ $penilai->pangkat ?? '........................................' }}</span></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>: <span class="data-field">{{ $penilai->jabatan ?? '........................................' }}</span></td>
            </tr>
        </table>

        <p>Dengan ini menyatakan dengan sesungguhnya bahwa :</p>

        <table>
            <tr>
                <td width="175">Nama</td>
                <td>: <span class="data-field">{{ $spmt->pegawai->nama ?? '........................................' }}</span></td>
            </tr>
            <tr>
                <td>NIP</td>
                <td>: <span class="data-field">{{ $spmt->pegawai->nip ?? '........................................' }}</span></td>
            </tr>
            <tr>
                <td>Pangkat/Golongan Ruang</td>
                <td>: <span class="data-field">{{ $spmt->pegawai->pangkat ?? '........................................' }}</span></td>
            </tr>
            <tr>
                <td>Jabatan Lama</td>
                <td>: <span class="data-field">{{ $spmt->pegawai->jabatan ?? '........................................' }}</span></td>
            </tr>
        </table>

        <p style="text-align: justify;">berdasarkan {{ $spmt->dasar_surat ?? 'Keputusan Gubernur Kepulauan Bangka Belitung Nomor: .......... tanggal ...........' }}, terhitung mulai {{ $spmt->tgl_surat ? \Carbon\Carbon::parse($spmt->tgl_surat)->format('d F Y') : 'tanggal ...........' }} telah nyata menjalankan tugas sebagai {{ $spmt->keterangan ?? 'jabatan baru' }} pada {{ $penilai->unitkerja ?? 'tempat penugasan' }}</p>

        <p style="text-align: justify;">Demikian surat pernyataan melaksanakan tugas ini saya buat dengan sesungguhnya dengan mengingat sumpah jabatan/Pegawai Negeri Sipil dan apabila dikemudian hari isi surat pernyataan ini ternyata tidak benar yang berakibat kerugian bagi Negara, maka saya bersedia menanggung kerugian tersebut.' </p>
    </div>

    <div class="signature">
        <p>Ditetapkan di {{ $spmt->tempat_ditetapkan ?? '............' }}<br>
            pada tanggal {{ $spmt->tgl_ditetapkan ? \Carbon\Carbon::parse($spmt->tgl_ditetapkan)->format('d F Y') : '...............' }}

            <br><br>

            {{ $penilai->jabatan ?? '............' }},

            <br><br><br><br>

            <span>{{ $penilai->nama ?? '........................................' }} <br>
                NIP. {{ $penilai->nip ?? '........................................' }}</span>
        </p>
    </div>

    <div class="tembusan" style="font-size: 10pt;">
        <p>Tembusan disampaikan kepada Yth. <br>
            1. Kepala BKD Provinsi Kepulauan Bangka Belitung <br>
            2. Pegawai yang bersangkutan</p>
    </div>
</body>

</html>