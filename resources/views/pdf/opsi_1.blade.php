<tr>
    <td style="text-align: center">2022</td>
    <td style="text-align: center">Ak Integrasi</td>
    <td></td>
    <td></td>
    <td></td>
    <td style="text-align: right; padding-right:60px">{{ number_format((float)$akKredits_first->pegawai->integrasi,3) }}
    </td>
</tr>
@foreach ($akKredits as $akKredit)
<?php 
    if ($akKredit->pegawai->pangkat =='IV/a') {
        $koefisien = 37.5;
        $jenjang = 450;
    } elseif ($akKredit->pegawai->pangkat =='III/d') {
        $koefisien = 25;
        $jenjang = 200;
        $namaPangkat = 'Penata tk';
    } else {

    }

    if ($akKredit->predikat =='Sangat Baik') {
        $prosentase = 150;
    } else {
        $prosentase = 100;
    }
    $startDate = Carbon\Carbon::parse($akKredit->startDate);
    $endDate = Carbon\Carbon::parse($akKredit->endDate);
    $diffInMonths = $startDate->diffInMonths($endDate)+1;
    $value = ($koefisien * $diffInMonths / 12) * $prosentase / 100;
    $totalAkKredit += number_format($value,3); // Add to the total
    ?>
<tr>
    <td style="text-align: center">{{Carbon\Carbon::parse($akKredit->startDate)->translatedFormat('Y')}} </td>
    <td style="text-align: center">{{ $diffInMonths }}</td>
    <td style="text-align: center">{{ $akKredit->predikat }}</td>
    <td style="text-align: center">{{ $prosentase }}</td>
    <td style="text-align: center">{{ $koefisien }}</td>
    <td style="text-align: right; padding-right:60px">{{ number_format((float)$value,3) }}</td>
</tr>
@endforeach
<tr>
    <th style="text-align: center" colspan="5">JUMLAH ANGKA KREDIT YANG DIPEROLEH</th>
    <td style="text-align: right; padding-right:60px">{{ number_format($totalAkKredit +
        (float)$akKredits_first->pegawai->integrasi, 3) }}</td>
</tr>