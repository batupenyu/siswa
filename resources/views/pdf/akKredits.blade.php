<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akumulasi PDF</title>
    <style>
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
            /* border: 1px solid #8a8585; */
            border: solid 1px black;
            /* Use solid border for better visibility */
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: none;
            color: black;
            /* color: white; */
        }


        tr:nth-child(even) {
            background-color: none;
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

        .left-align {
            text-align: left;
        }

        .right-align {
            text-align: right;
        }
    </style>
</head>
@foreach ($akKredits as $akKredit)
<?php

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
} else {
    $koefisien = 0;
    $pangkat = 0;
    $jenjang = 0;
    $namaPangkat = '-';
}
?>
@endforeach

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
            AKUMULASI ANGKA KREDIT<br>
            NOMOR : 800/ ...... / ...... /Dindik/{{ $date->translatedFormat('Y') }}/PAK
        </b>
    </p>
    <br>
    <br>
    <br>
    <div class="inline-container">
        <div class="left-align">
            Instansi : {{ $atasanInstansi }}
        </div>
        <div class="right-align">
            Periode : {{Carbon\Carbon::parse($akKredits_first->startDate)->translatedFormat('d F ')}} s.d.
            {{Carbon\Carbon::parse($akKredits_first->endDate)->translatedFormat('d F Y')}}
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
                    <span class="value">{{ $akKredits_first->pegawai->nama }}</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">2.</td>
                <td colspan="2">
                    <span class="label">NIP</span>
                    <span class="colon">:</span>
                    <span class="value">{{ $akKredits_first->pegawai->nip }}</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">3.</td>
                <td colspan="2">
                    <span class="label">No. Seri Karpeg</span>
                    <span class="colon">:</span>
                    <span class="value">{{ $akKredits_first->pegawai->no_karpeg }}</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">4.</td>
                <td colspan="2">
                    <span class="label">Tempat Tgl. Lahir</span>
                    <span class="colon">:</span>
                    <span class="value">{{ $akKredits_first->pegawai->tempat_lahir }}, {{
                        Carbon\Carbon::parse($akKredits_first->pegawai->tgl_lahir)->translatedFormat('d F Y') }}</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">5.</td>
                <td colspan="2">
                    <span class="label">Jenis Kelamin</span>
                    <span class="colon">:</span>
                    <span class="value">{{ $akKredits_first->pegawai->jenis_kelamin }}</span>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">6.</td>
                <td colspan="2">
                    <span class="label">Pangkat/Golongan ruang/TMT</span>
                    <span class="colon">:</span>
                    <span class="value">{{ $namaPangkat }}, {{ $akKredit->pegawai->pangkat }} , {{
                        Carbon\Carbon::parse($akKredit->pegawai->tgl_tmt_pangkat)->translatedFormat('d F Y') }}</span>

                </td>
            </tr>
            <tr>
                <td style="text-align: center">7.</td>
                <td colspan="2">
                    <span class="label">Jabatan /TMT</span>
                    <span class="colon">:</span>
                    <span class="value">{{$akKredit->pegawai->jabatan}}/{{
                        Carbon\Carbon::parse($akKredits_first->pegawai->tgl_tmt_jabatan)->translatedFormat('d F Y')
                        }}</span>
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
            </tr>
            @foreach ($akKredits as $akKredit)
            @endforeach
        </tbody>
    </table>

    <table>
        <thead>
            <tr class="baris">
                <th style="vertical-align:middle; text-align:center" colspan="4" class="header-cell">HASIL PENILAIAN
                    KINERJA</th>
                <th style="vertical-align:middle; text-align:center" rowspan="2">KOEFSIEN <br> PER TAHUN</th>
                <th style="vertical-align:middle; text-align:center" rowspan="2">ANGKA KREDIT <br> YANG DI DAPAT</th>
            </tr>
            <tr>
                <th style="vertical-align:middle; text-align:center">TAHUN</th>
                <th style="vertical-align:middle; text-align:center">PERIODIK <br> BULAN</th>
                <th style="vertical-align:middle; text-align:center">PREDIKAT</th>
                <th style="vertical-align:middle; text-align:center">PROSENTASE</th>
            </tr>
        </thead>
        <tbody>
            <?php $totalAkKredit = 0; ?>
            <!-- Initialize total -->
            <tr>
                <th style="vertical-align:middle; text-align:center">1</th>
                <th style="vertical-align:middle; text-align:center">2</th>
                <th style="vertical-align:middle; text-align:center">3</th>
                <th style="vertical-align:middle; text-align:center">4</th>
                <th style="vertical-align:middle; text-align:center">5</th>
                <th style="vertical-align:middle; text-align:center">6</th>
            </tr>
            @php
            $tahun = \Carbon\Carbon::parse($tgl_awal)->format('Y');
            @endphp
            @if ($tahun == 2022)
            @include('pdf.opsi_1')
            @else
            @include('pdf.opsi_2')
            @endif


        </tbody>
    </table>
    <br>
    <br>
    <p style="padding-left:450px">
        Ditetapkan di
        {{$akKredit->pegawai->nip != $penilai->nip ? 'Koba' : 'Pangkalpinang'}} <br>
        {{-- {{Carbon\Carbon::parse($akKredits_first->endDate)->translatedFormat('d F Y')}} <br> --}}
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