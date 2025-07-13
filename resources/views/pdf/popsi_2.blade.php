<tr>
    <td style="text-align: center">2.</td>
    <td>AK JF lama</td>
    <td style="text-align: center">
        @if ($baru < $lama)
        -
        @else
        {{ number_format($lama, 3) }}
        @endif
    </td>
    <td style="text-align: center">
        @if ($baru < $lama)
            {{ number_format($baru, 3) }}
        @else
            {{ number_format($baru-$lama, 3) }}
        @endif
    </td>
    <td style="text-align: center">
        {{ number_format($baru, 3) }}
    </td>
    <td style="text-align: center"></td>
</tr>