<td colspan="2" style="text-align: center"><b>TOTAL ANGKA KREDIT</b></td>
<td style="text-align: center">
    @if ($akKredit->pegawai->pangkat == 'III/d')
        {{ number_format(100, 3) }}
    @else
        {{ number_format($lama, 3) }}
    @endif
</td>
<td style="text-align: center">
    @if ($akKredit->pegawai->pangkat == 'III/d')
        {{ number_format($finalBaruValue, 3) }}
    @else
        {{ number_format($displayTotalAkKreditValue-$lama, 3) }}
    @endif
</td>
<td style="text-align: center">
    @if ($akKredit->pegawai->pangkat == 'III/d')
        {{ number_format($displayTotalAkKreditValue, 3) }}
    @else
        {{ number_format($displayTotalAkKreditValue, 3) }}
    @endif
</td>
<td style="text-align: center">-</td>