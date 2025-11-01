<!DOCTYPE html>
<html>

<head>
    <title>KARTU KENDALI CUTI PEGAWAI NEGERI SIPIL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 10pt;
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
            padding: 0px 0;
        }

        table.data-cuti {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table.data-cuti th,
        table.data-cuti td {
            border: 1px solid black;
            padding: 2px;
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

        .negative-balance {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <p>KARTU KENDALI CUTI PEGAWAI NEGERI SIPIL</p>
            <p style="text-transform:uppercase;">{{$penilai->unitkerja ?? 'N/A'}}</p>
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
                    <?php
                    $case = ($pegawai->pangkat); // Replace with your actual variable
                    $title = '';

                    switch ($case) {
                        case 'III/a':
                            $title = 'Penata Muda';
                            break;
                        case 'III/b':
                            $title = 'Penata Muda Tingkat I';
                            break;
                        case 'III/c':
                            $title = 'Penata';
                            break;
                        case 'III/d':
                            $title = 'Penata Tingkat I';
                            break;
                        case 'IV/a':
                            $title = 'Pembina';
                            break;
                        case 'IV/b':
                            $title = 'Pembina Tingkat I';
                            break;
                        case 'IV/c':
                            $title = 'Pembina Utama Muda';
                            break;
                        case 'IV/d':
                            $title = 'Pembina Utama Madya';
                            break;
                        case 'IV/e':
                            $title = 'Pembina Utama';
                            break;
                        default:
                            $title = 'Penata Muda';
                    }

                    echo $title;
                    ?>
                    <td>: {{ $title }}, {{ $pegawai->pangkat ?? '' }}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>: {{ $pegawai->jabatan ?? '' }}</td>
                </tr>
                <tr>
                    <td>Unit kerja</td>
                    <td>: {{$penilai->unitkerja ?? ''}}</td>
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
                <!-- Tahun Berjalan (N) -->
                <tr style="background-color: #a1a6a8ff;" class="current-year">
                    <td></td>
                    <td colspan="6"><i><b>{{ date('Y') }}</b></i></td>
                    <td colspan="3" class="sisa-cuti">Sisa {{ ($cutiFirst->sisaCuti->sisa_tahun_n ?? 0) + ($cutiFirst->sisaCuti->sisa_tahun_n_1 ?? 0) + ($cutiFirst->sisaCuti->sisa_tahun_n_2 ?? 0) }} hari </td>
                </tr>

                @php
                $sisa_n = ($cutiFirst->sisaCuti->sisa_tahun_n ?? 0) + ($cutiFirst->sisaCuti->sisa_tahun_n_1 ?? 0) + ($cutiFirst->sisaCuti->sisa_tahun_n_2 ?? 0);
                $currentYear = date('Y');
                $counter_n = 1;
                @endphp

                @foreach($cuti as $item)
                @php
                $tahunCuti = date('Y', strtotime($item->tanggal_mulai));
                @endphp

                @if($tahunCuti == $currentYear)
                @php
                $sisa_sebelumnya = $sisa_n;
                $lama = $item->lama_cuti_working;
                $sisa_n -= $lama;
                $hasil = $sisa_n;
                @endphp

                <tr>
                    <td>{{ $counter_n++ }}</td>
                    <td>{{ $item->no_surat ?? '' }}</td>
                    <td>{{ $item->tgl_surat ? \Carbon\Carbon::parse($item->tgl_surat)->translatedFormat('d-m-Y') : '' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d-m-Y') }}</td>
                    <td>{{ $item->jenis_cuti }}</td>
                    <td></td>
                    <td>{{ $sisa_sebelumnya }} </td>
                    <td class="{{ $sisa_n < 0 ? 'negative-balance' : '' }}">{{ $lama }} </td>
                    <td>{{ $sisa_n }} </td>
                </tr>
                @endif
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
                <p>Kepala {{$penilai->unitkerja ?? ''}}</p>
                <!-- <div class="signature-line"></div> -->
                <br>
                <br>
                <br>
                <p>
                    {{$penilai->nama ?? ''}} <br>
                    NIP : {{$penilai->nip ?? ''}}
                </p>
            </div>
        </div>
    </div>

</body>

</html>