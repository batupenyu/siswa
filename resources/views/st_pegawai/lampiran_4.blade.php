<table border="0" style="width: 500px;">
    <tbody>
        <tr>
            <td style="width: 135px">Nama</td>
            <td style="width: 30px">:</td>
            <td>{{ $penilai->nama }}</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td>{{ $penilai->nip }}</td>
        </tr>
        <tr>
            <td>Pangkat/Gol</td>
            <td>:</td>
            <td>
                {{$penilai->pangkat}}
            </td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $penilai->jabatan }}</td>
        </tr>
        <tr>
            <td>Unit Kerja</td>
            <td>:</td>
            <td>{{ $penilai->unitkerja }}</td>
        </tr>
    </tbody>
</table>