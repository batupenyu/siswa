<tr>
    <td style="text-align: center">2.</td>
    <td>AK JF lama</td>
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
            {{ number_format($displayTotalAkKreditValue - $lama, 3) }}
        @endif
    </td>
    <td style="text-align: center">
        @if ($akKredit->pegawai->pangkat == 'III/d')
            {{ number_format($displayTotalAkKreditValue, 3) }}
        @else
            {{ number_format($displayTotalAkKreditValue, 3) }}
        @endif
    </td>
    <td style="text-align: center"></td>
</tr>