<tr>
    <td style="text-align: center">2.</td>
    <td>AK JF lama</td>
    <td style="text-align: center">
        @if ($baru+$integrasi < $lama) - @else {{ number_format($lama, 3) }} @endif </td>
    <td style="text-align: center">
        @if ($baru+$integrasi < $lama) {{ number_format($baru+$integrasi, 3) }} @else {{
            number_format($baru+$integrasi-$lama, 3) }} @endif </td>
    <td style="text-align: center">
        {{ number_format($baru+$integrasi, 3) }}
    </td>
    <td style="text-align: center"></td>
</tr>