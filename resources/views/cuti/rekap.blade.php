<!DOCTYPE html>
<html>

<head>
    <title>KARTU KENDALI CUTI PEGAWAI NEGERI SIPIL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            margin: auto;
            border: 1px solid black;
            padding: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header p {
            margin: 2px 0;
            font-weight: bold;
        }

        .info-pegawai {
            margin-bottom: 20px;
        }

        .info-pegawai table {
            width: 50%;
            text-align: left;
        }

        .info-pegawai table td {
            padding: 2px 0;
        }

        table.data-cuti {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table.data-cuti th,
        table.data-cuti td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            vertical-align: middle;
        }

        table.data-cuti th {
            background-color: #ADD8E6;
            /* Light Blue */
            font-weight: bold;
        }

        .keterangan-bawah {
            margin-top: 20px;
            display: inline;
        }

        .keterangan-bawah .left {
            width: 50%;
            display: inline-block;
        }

        .keterangan-bawah .right {
            margin-top: 20px;
            width: 40%;
            text-align: right;
            display: inline-block;
        }

        .keterangan-bawah .right p {
            margin: 5px 0;
        }

        .signature-line {
            border-bottom: 1px solid black;
            display: inline-block;
            min-width: 200px;
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <p>KARTU KENDALI CUTI PEGAWAI NEGERI SIPIL</p>
            <p style="text-transform:uppercase;">{{$penilai->unitkerja}}</p>
            <p>CABANG DINAS PENDIDIKAN WILAYAH I</p>
            <p>DINAS PENDIDIKAN PROVINSI KEPULAUAN BANGKA BELITUNG</p>
        </div>

        <div class="info-pegawai">
            <table>
                <tr>
                    <td>Nama</td>
                    <td>: {{ $pegawai->nama ?? '' }}</td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>: {{ $pegawai->nip ?? '' }}</td>
                </tr>
                <tr>
                    <td>Pangkat / Gol</td>
                    <td>: {{ $pegawai->pangkat ?? '' }}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>: {{ $pegawai->jabatan ?? '' }}</td>
                </tr>
                <tr>
                    <td>Unit kerja</td>
                    <td>: {{$penilai->unitkerja}}</td>
                </tr>
            </table>
        </div>

        <table class="data-cuti">
            <thead>
                <tr>
                    <th rowspan="2">No.</th>
                    <th colspan="2">Surat Izin/Surat Keputusan</th>
                    <th colspan="2">lamanya</th>
                    <th rowspan="2">Jenis Cuti</th>
                    <th rowspan="2">Paraf Pegawai <br>Kepegawaian</th>
                    <th colspan="3">Keterangan</th>
                </tr>
                <tr>
                    <th>Nomor</th>
                    <th>Tanggal</th>
                    <th>Dari Tanggal</th>
                    <th>Sampai Tanggal</th>
                    <th>ATB</th>
                    <th>LHC</th>
                    <th>STB</th>
                </tr>
            </thead>
            <tbody>
                @php
                $sisa = $cutiFirst->sisa_cuti_n;
                @endphp
                <td></td>
                <td colspan="6"><i><b>{{ date('Y') }}</b></i></td>
                <td colspan="3">{{ $sisa }}</td>
                </tr>

                @foreach($cuti as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d-m-Y') }}</td>
                    <td>{{ $item->jenis_cuti }}</td>
                    @php
                    $sisa_sebelumnya = $sisa;
                    $sisa -= $item->lama_cuti;
                    @endphp
                    <!-- <td>{{ $sisa_sebelumnya }}</td> -->
                    <td></td>
                    <td>{{ $sisa }}</td>
                    <td>{{ $item->lama_cuti }}</td>
                    <td>{{ $sisa }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="keterangan-bawah">
            <div class="left">
                <p>Keterangan: <br>
                    ATB : Akumulasi Sisa Tahun Berjalan <br>
                    LHC : Lama Hari Cuti <br>
                    STB : Sisa Cuti Tahun Berjalan</p>
            </div>
            <div class="right" style="text-align: center;">
                <p>Kepala {{$penilai->unitkerja}}</p>
                <!-- <div class="signature-line"></div> -->
                <br>
                <br>
                <p>
                    {{$penilai->nama}} <br>
                    NIP : {{$penilai->nip}}
                </p>
            </div>
        </div>
    </div>

</body>

</html>