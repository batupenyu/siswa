@foreach($stPegawai->pegawais as $pegawai)
<table>
    <tr>
        <td style="width: 30px">{{ $loop->iteration}}</td>
        <td style="width: 100px">Nama</td>
        <td style="width: 30px">:</td>
        <td>{{ $pegawai->nama }}</td>
    </tr>
    <tr>
        <td></td>
        <td>NIP</td>
        <td>:</td>
        <td>{{ $pegawai->nip }}</td>
    </tr>
    <tr>
        <td></td>
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
        <td></td>
        <td>Jabatan</td>
        <td>:</td>
        <td>{{ $pegawai->jabatan }}</td>

    </tr>
</table>
@endforeach