<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penetapan AK</title>
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
            border: 1px solid black;
            padding: 2px;
            text-align: left;
        }

        th {
            /* background-color: #b4bab4; */
            background-color: none;
            color: rgb(10, 1, 1);
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
@foreach ($akKredits as $akKredit)
<?php
$startDate = Carbon\Carbon::parse($akKredit->startDate);
$endDate = Carbon\Carbon::parse($akKredit->endDate);
$diffInMonths = $startDate->diffInMonths($endDate) + 1;
$gol = $akKredit->pegawai->pangkat;

if ($akKredit->predikat == 'Sangat Baik') {
    $prosentase = 150;
} else {
    $prosentase = 100;
}

if ($gol == 'IV/a') {
    $lama = 200;
    $koefisien = 37.5;
    $pangkat = 150;
    $jenjang = 450;
    $nextPangkat = 'jenjang Ahli Madya Pangkat/Golongan ruang Pembina TK.I,IV/b';
    $namaPangkat = 'Pembina';
} elseif ($gol == 'III/d') {
    $lama = 100;
    $koefisien = 25;
    $pangkat = 200;
    $jenjang = 200;
    $nextPangkat = 'jenjang Ahli Madya Pangkat/Golongan ruang Pembina,IV/a';
    $namaPangkat = 'Penata TK.I';
} elseif ($gol == 'III/c') {
    $lama = 50;
    $koefisien = 12.5;
    $pangkat = 50;
    $jenjang = 100;
    $nextPangkat = 'jenjang Ahli Muda Pangkat/Golongan ruang Penata TK.I,III/d';
    $namaPangkat = 'Pembina IV/a';
} else {
    null;
}

$value = ($koefisien * $diffInMonths / 12) * $prosentase / 100;
$totalAkKredit += $value; // Add to the total
<<<<<<< HEAD
// $baru = number_format($totalAkKredit + $akKredits_first->pegawai->integrasi,2);
$baru = number_format($totalAkKredit, 3);
// $lama = number_format($totalAkKredit + $akKredits_first->pegawai->integrasi - $akKredits_first->pegawai->integrasi,2);
$integrasi = number_format($akKredits_first->pegawai->integrasi, 3);
$hasilPangkat = number_format($baru - $pangkat, 3);
$hasilJenjang = number_format($baru - $jenjang, 3);
=======
$baru = $totalAkKredit;
$integrasi = (float) $akKredits_first->pegawai->integrasi;
$hasilPangkat = $baru - $pangkat;
$hasilJenjang = $baru - $jenjang;
>>>>>>> 0da78d7 (commit)
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
            PENETAPAN ANGKA KREDIT<br>
            NOMOR : 800/ ...... /......../Dindik/{{ $date->translatedFormat('Y') }}/PAK
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
                <th style="text-align: center; border-bottom: none;" colspan="3">HASIL PENILAIAN ANGKA KREDIT</th>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th style="text-align: center; width:20px; vertical-align: middle;">II.</th>
                <th style="text-align: center; vertical-align: middle;">PENETAPAN ANGKA KREDIT</th>
                <th style="text-align: center; vertical-align: middle;">LAMA</th>
                <th style="text-align: center; vertical-align: middle;">BARU</th>
                <th style="text-align: center; vertical-align: middle;">JUMLAH</th>
                <th style="text-align: center; vertical-align: middle;">KETERANGAN</th>
            </tr>
            <tr>
                <th style="text-align: center">1</th>
                <th style="text-align: center">2</th>
                <th style="text-align: center">3</th>
                <th style="text-align: center">4</th>
                <th style="text-align: center">5</th>
                <th style="text-align: center">6</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center">1.</td>
                <td>AK dasar yang diberikan</td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>

            </tr>
            @php
            $tahun = \Carbon\Carbon::parse($tgl_awal)->format('Y');
            @endphp
            @if ($tahun == 2022)
            @include('pdf.popsi_1')
            @else
            @include('pdf.popsi_2')
            @endif
            <tr>
                <td style="text-align: center">3.</td>
                <td>AK penyesuaian penyetaraan</td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
            </tr>
            <tr>
                <td style="text-align: center">4.</td>
                <td>AK konversi</td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
            </tr>
            <tr>
                <td style="text-align: center">5.</td>
                <td>AK yang diperoleh dari peningkatan pendidikan</td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>
                <td style="text-align: center"></td>

            </tr>
            <tr>
                <td style="text-align: center">6.</td>
                <td>-</td>
                <td style="text-align: center">-</td>
                <td style="text-align: center">-</td>
                <td style="text-align: center">-</td>
                <td style="text-align: center">-</td>
            </tr>
            <tr>
                @if ($tahun == 2022)
                @include('pdf.popsi_a')
                @else
                @include('pdf.popsi_b')
                @endif
            </tr>
        </tbody>
        <thead>
            <tr>
                <th colspan="6" style="text-align: center">KONVERSI PREDIKAT KINERJA KE ANGKA KREDIT</th>
            </tr>
            <tr>
                <th colspan="2" style="text-align: center">Keterangan</th>
                <th colspan="2" style="text-align: center">Pangkat</th>
                <th colspan="2" style="text-align: center">Jenjang Jabatan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2" style="width: 250px">Angka Kredit minimal yang harus dipenuhi untuk
                    kenaikan pangkat / jenjang
                </td>
                <td colspan="2" style="text-align: center">{{ number_format($pangkat,3) }}</td>
                <td colspan="2" style="text-align: center">{{ number_format($jenjang,3) }}</td>
            </tr>
            <tr>
                <td colspan="2">
                    @if (($lama+$baru+$integrasi-$lama)-$pangkat || ($lama+$baru-$lama)-$pangkat > 0)
                    Kelebihan/<del>Kekurangan</del> *) Angka Kredit yang harus dicapai untuk kenaikan pangkat
                    @else
                    <del>Kelebihan</del>/Kekurangan *) Angka Kredit yang harus dicapai untuk kenaikan pangkat
                    @endif
                </td>
                {{-- <td colspan="2" style="text-align: center">{{ $hasilPangkat }}</td> --}}
                <td colspan="2" style="text-align: center">
                    @if ($tahun == 2022)
                    {{ number_format(($lama+$baru+$integrasi-$lama)-$pangkat,3) }}
                    @else
                    {{ number_format(($lama+$baru-$lama)-$pangkat,3) }}
                    @endif
                </td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="2">
                    @if (($lama+$baru+$integrasi-$lama)-$jenjang || ($lama+$baru-$lama)-$jenjang > 0)
                    Kelebihan/<del>Kekurangan</del> *) Angka Kredit yang harus dicapai untuk kenaikan jenjang
                    @else
                    <del>Kelebihan</del>/Kekurangan *) Angka Kredit yang harus dicapai untuk kenaikan jenjang
                    @endif
                </td>
                <td colspan="2"></td>
                {{-- <td colspan="2" style="text-align: center">{{ $hasilJenjang }}</td> --}}
                <td colspan="2" style="text-align: center">
                    @if ($tahun == 2022)
                    {{ number_format(($lama+$baru+$integrasi-$lama)-$jenjang,3) }}
                    @else
                    {{ number_format(($lama+$baru-$lama)-$jenjang,3) }}
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="6" style="text-align: justify">
                    {{-- @if ($akKredit->pegawai->pangkat = $gol && $hasilJenjang > 0) --}}
                    @if (($lama+$baru+$integrasi-$lama)-$pangkat > 0)
                    <b><i>Dapat</i></b>
                    @else
                    <b><i>Tidak dapat</i></b>
                    @endif
                    dipertimbangkan untuk kenaikan Pangkat/Jabatan setingkat lebih tinggi ke
                    <b><i>{{$nextPangkat}}</i></b>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <table>
        <tr>
            <td style="border: none;width:65%">
                ASLI disampaikan dengan hormat kepada: <br>
                Jabatan Fungsional yang bersangkutan. <br><br>
                Tembusan disampaikan kepada: <br>
                1. Pimpinan Unit Kerja; <br>
                2. Pejabat Penilai Kinerja;<br>
                3. Sekretaris Tim Penilai yang bersangkutan; dan <br>
                4. Kepala Biro Kepegawaian dan Organisasi.
            </td>
            <td style="border: none;">
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
            </td>
        </tr>
    </table>
</body>

</html>