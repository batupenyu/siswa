<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AkKredit Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 4px;
            text-align: left;
        }

        th {
            background-color: none;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            /* Set the global font size to 10pt */
            margin: 0;
            /* Ensure no default margin on body */
            padding: 0;
            /* Ensure no default padding on body */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0;
            /* Remove top margin of the table */
            margin-bottom: 0;
            /* Remove bottom margin of the table */
        }

        th,
        td {
            /* border: 1px solid rgb(143, 98, 98); */
            border: 1px solid #0e0101;
            /* Use a light gray border for better visibility */
            padding: 2px;
            text-align: left;
        }

        th {
            /* background-color: #b4bab4; */
            background-color: none;
            color: black;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* New styles for aligning labels */
        .label {
            display: inline-block;
            width: 200px;
            /* Fixed width for alignment */
            text-align: left;
            /* Align text to the left */
        }

        .colon {
            margin-left: 5px;
            /* Add some spacing before the colon */
            margin-right: 5px;
            /* Add some spacing after the colon */
        }

        .value {
            display: inline-block;
        }

        .inline-container {
            white-space: nowrap;
            /* Prevents wrapping of inline elements */
            margin: 0;
            /* Ensure no margin around the container */
            padding: 0;
            /* Ensure no padding around the container */
        }

        .left-align,
        .right-align {
            display: inline-block;
            /* Makes elements behave like inline elements */
            width: 49%;
            /* Adjust width to fit both elements in one line */
            margin: 0;
            /* Remove margin */
            padding: 0;
            /* Remove padding */
        }

        .kiri,
        .kanan {
            display: inline-block;
            /* Makes elements behave like inline elements */
            width: 49%;
            /* Adjust width to fit both elements in one line */
            margin: 0;
            /* Remove margin */
            padding: 0;
            /* Remove padding */
        }


        .left-align {
            text-align: left;
        }

        .right-align {
            text-align: right;
        }
    </style>
</head>
<?php $totalAkKredit = 0; ?>
<!-- Initialize total -->
<?php
$startDate = Carbon\Carbon::parse($akKredit->startDate);
$endDate = Carbon\Carbon::parse($akKredit->endDate);
$diffInMonths = $startDate->diffInMonths($endDate) + 1;

if ($akKredit->predikat == 'Sangat Baik') {
    $prosentase = 150;
} else {
    $prosentase = 100;
}

if ($akKredit->pegawai->pangkat == 'IV/a') {
    $koefisien = 37.5;
    $pangkat = 150;
    $jenjang = 450;
    $namaPangkat = 'Pembina';
} elseif ($akKredit->pegawai->pangkat == 'III/d') {
    $koefisien = 25;
    $pangkat = 100;
    $jenjang = 200;
    $namaPangkat = 'Penata TK. I';
} elseif ($akKredit->pegawai->pangkat == 'III/c') {
    $koefisien = 12.5;
    $pangkat = 50;
    $jenjang = 100;
    $namaPangkat = 'Penata';
} else {
    $koefisien = 0;
    $pangkat = 0;
    $jenjang = 0;
    $namaPangkat = '-';
}

$value = ($koefisien * $diffInMonths / 12) * $prosentase / 100;
$totalAkKredit += $value; // Add to the total

?>

<body>
    <?php

    use App\Models\Holiday;

    $date = \Carbon\Carbon::parse($akKredit->endDate)->addDay();

    // Fetch holiday dates from the database
    $holidays = Holiday::pluck('date')->map(function ($d) {
        return \Carbon\Carbon::parse($d)->format('Y-m-d');
    })->toArray();

    // If weekend or holiday, add days until weekday and not holiday
    while ($date->isWeekend() || in_array($date->format('Y-m-d'), $holidays)) {
        $date->addDay();
    }
    ?>
    <p style="text-align: center; margin: 0; padding: 0;">
        <b>
            KONVERSI PREDIKAT KINERJA KE ANGKA KREDIT<br>
            NOMOR : 800/ ...... / ...... /Dindik/{{ \Carbon\Carbon::parse($akKredit->endDate)->format('Y') }}/PAK
        </b>
    </p>
    <br>
    <br>
    <br>
    <div class="inline-container">
        <div class="left-align">
            Instansi : {{ $penilai->instansi }}
        </div>
        <div class="right-align">
            Periode : {{Carbon\Carbon::parse($akKredit->startDate)->translatedFormat('d F ')}} s.d.
            {{Carbon\Carbon::parse($akKredit->endDate)->translatedFormat('d F Y')}}
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th style="text-align: center">I.</th>
                <th colspan="2">KETERANGAN PERORANGAN</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 20px; text-align: center">1.</td>
                <td colspan="2">
                    <span class="label">Nama</span>
                    <span class="colon">:</span>
                    <span class="value">{{ $akKredit->pegawai->nama }}</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">2.</td>
                <td colspan="2">
                    <span class="label">NIP</span>
                    <span class="colon">:</span>
                    <span class="value">{{ $akKredit->pegawai->nip }}</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">3.</td>
                <td colspan="2">
                    <span class="label">No. Seri Karpeg</span>
                    <span class="colon">:</span>
                    <span class="value">{{ $akKredit->pegawai->no_karpeg }}</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">4.</td>
                <td colspan="2">
                    <span class="label">Tempat Tgl. Lahir</span>
                    <span class="colon">:</span>
                    <span class="value">{{ $akKredit->pegawai->tempat_lahir }}, {{
                        Carbon\Carbon::parse($akKredit->pegawai->tgl_lahir)->translatedFormat('d F Y') }}</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">5.</td>
                <td colspan="2">
                    <span class="label">Jenis Kelamin</span>
                    <span class="colon">:</span>
                    <span class="value">{{ $akKredit->pegawai->jenis_kelamin }}</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">6.</td>
                <td colspan="2">
                    <span class="label">Pangkat/Golongan ruang/TMT</span>
                    <span class="colon">:</span>
                    <span class="value">{{ $namaPangkat }}, {{ $akKredit->pegawai->pangkat }}, {{
                        Carbon\Carbon::parse($akKredit->pegawai->tgl_tmt_pangkat)->translatedFormat('d F Y') }}</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">7.</td>
                <td colspan="2">
                    <span class="label">Jabatan /TMT</span>
                    <span class="colon">:</span>
                    <span class="value">{{$akKredit->pegawai->jabatan}}/{{
                        Carbon\Carbon::parse($akKredit->pegawai->tgl_tmt_jabatan)->translatedFormat('d F Y') }}</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">8.</td>
                <td colspan="2">
                    <span class="label">Unit Kerja</span>
                    <span class="colon">:</span>
                    <span class="value">{{ $penilai->unitkerja }}</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">9.</td>
                <td colspan="2">
                    <span class="label">Instansi</span>
                    <span class="colon">:</span>
                    <span class="value">{{ $penilai->instansi }}</span>
                </td>
            </tr>
            <tr>
                <th style="text-align: center; border-bottom: none;" colspan="3">KONVERSI PREDIKAT KINERJA KE ANGKA
                    KREDIT</th>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th style="text-align: center" colspan="2">HASIL PENILAIAN KINERJA</th>
                <th style="text-align: center" rowspan="2">KOEFISIEN <br>PER TAHUN</th>
                <th style="text-align: center">ANGKA KREDIT <br>YANG DI DAPAT</th>
            </tr>
            <tr>
                <th style="text-align: center">PREDIKAT</th>
                <th style="text-align: center">PROSENTASE</th>
                <th style="text-align: center">(KOLOM 2 X KOLOM 2)</th>
            </tr>
            <tr>
                <th style="text-align: center">1</th>
                <th style="text-align: center">2</th>
                <th style="text-align: center">3</th>
                <th style="text-align: center">4</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center">{{ $akKredit->predikat }}</td>
                <td style="text-align: center">{{ $prosentase }}</td>
                <td style="text-align: center">{{ $koefisien }}</td>
                <td style="text-align: center">{{ $totalAkKredit }}</td>
            </tr>

        </tbody>
    </table>


    <br>
    <br>
    <p style="padding-left:450px">
        Ditetapkan di
        {{$akKredit->pegawai->nip != $penilai->nip ? 'Koba' : 'Pangkalpinang'}} <br>
        {{-- {{Carbon\Carbon::parse($akKredit->endDate)->translatedFormat('d F Y')}} <br> --}}
        {{-- 2 Januari {{ \Carbon\Carbon::parse($akKredit->endDate)->format('Y')+1 }}<br> --}}

        Pada tanggal, {{ $date->translatedFormat('d F Y') }}. <br><br>
        Pejabat Penilai Kinerja <br><br><br><br>
        @if ($akKredit->pegawai->nip != $penilai->nip)
        {{$penilai->nama}} <br>
        NIP.{{ $penilai->nip }}`
        @else
        {{$kpa->nama}} <br>
        NIP. {{$kpa->nip }}
        @endif
    </p>
    <br><br>
    <p>
        Tembusan disampaikan kepada: <br>
        1. Jabatan Fungsional yang bersangkutan <br>
        2. Ketua/atasan unit kerja <br>
        3. Kepala Biro Kepegawaian dan Organisasi <br>
        4. Pejabat lain yang dianggap perlu.
    </p>
</body>

</html>