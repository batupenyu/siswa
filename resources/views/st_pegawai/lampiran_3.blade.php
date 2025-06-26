<table style="border: 1px solid" cellpadding="0">
    <tr>
        <th style="padding-left: 10px">No.</th>
        <th style="width: 200px">Nama/Jabatan</th>
        <th style="width: 150px">NIP</th>
        <th style="width: 150px">Pangkat/Gol.</th>
    </tr>
    <tr>
        <td colspan="4">
            <hr>
        </td>
    </tr>
    @foreach($stPegawai->pegawais as $pegawai)
    <tr style="vertical-align: top; font-size:10pt">
        <td style="padding-left: 10px">{{ $loop->iteration }}.</td>
        <td style="padding-left: 20px">{{ $pegawai->nama }}/{{ $pegawai->jabatan }}
            <br>
        </td>
        <td style="text-align: center">{{ $pegawai->nip }}</td>
        <td style="text-align: center">
            @if ($pegawai->pangkat == 'III/d')
            Penata Tk. I, {{ $pegawai->pangkat }}
            @elseif ($pegawai->pangkat == 'IV/a')
            Pembina, {{ $pegawai->pangkat }}
            @else
            @endif
        </td>
    </tr>
    @endforeach
</table>