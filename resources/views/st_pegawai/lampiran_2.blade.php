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
                @elseif ($pegawai->pangkat == 'III/b')
                Penata Muda, Tk.I, {{ $pegawai->pangkat }}
                @else
                IX
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