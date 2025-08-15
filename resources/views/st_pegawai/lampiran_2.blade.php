@foreach($stPegawai->pegawais as $pegawai)
<table>
    <tbody>
        <tr>
            <td style="width: 133px">Nama</td>
            <td style="width: 30px">:</td>
            <td>{{ $pegawai->nama }}</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td>{{ $pegawai->nip }}</td>
        </tr>
        <tr>
            <td>Pangkat/Gol</td>
            <td>:</td>
            <td>
                @if ($pegawai->pangkat == 'III/d')
                Penata Tk. I, {{ $pegawai->pangkat }}
                @elseif ($pegawai->pangkat == 'IV/a')
                Pembina, {{ $pegawai->pangkat }}
                @else
                @endif
            </td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $pegawai->jabatan }}</td>
        </tr>
    </tbody>
</table>
@endforeach