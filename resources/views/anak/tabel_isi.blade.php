<table class="family-table">
    <tr>
        <th rowspan="2" style="width: 20px;">NO</th>
        <th rowspan="2">NAMA</th>
        <th rowspan="2">TEMPAT LAHIR</th>
        <th colspan="2">TANGGAL</th>
        <th rowspan="2">PEKERJAAN</th>
        <th rowspan="2">KETERANGAN</th>
        <th rowspan="2">MENDAPATKAN TUNJANGAN</th>
    </tr>
    <tr>
        <th>LAHIR</th>
        <th>PERKAWINAN</th>
    </tr>
    @if($pegawai->pasangan)
    <tr>
        <td>1</td>
        <td>{{ $pegawai->pasangan->nama }}</td>
        <td>{{ $pegawai->pasangan->tempat_lahir }}</td>
        <td>{{ \Carbon\Carbon::parse($pegawai->pasangan->tgl_lahir)->translatedFormat('d-m-Y') }}</td>
        <td>{{ \Carbon\Carbon::parse($pegawai->pasangan->tgl_perkawinan)->translatedFormat('d-m-Y') }}</td>
        <td>{{ $pegawai->pasangan->pekerjaan }}</td>
        <td>{{ str($pegawai->pasangan->status_pernikahan)->title() }}</td>
        <td>{{ str($pegawai->pasangan->status_tunjangan)->title() }}</td>
    </tr>
    @endif
    @foreach($pegawai->anak as $index => $item)
    <tr>
        <td>{{ (int)$index + 2 }}</td>
        <td>{{ $item->nama }}</td>
        <td>{{ $item->tempat_lahir }}</td>
        <td>{{ \Carbon\Carbon::parse($item->tgl_lahir)->translatedFormat('d-m-Y') }}</td>
        <td>{{ $item->status_pernikahan == 'menikah' ? \Carbon\Carbon::parse($item->tgl_pernikahan ?? now())->translatedFormat('d-m-Y') : '' }}</td>
        <td>{{ str($item->status_pekerjaan)->title() }}</td>
        <td>{{ str($item->keterangan ?? '')->title() }}</td>
        <td>{{ str($item->status_tanggungan)->title() }}</td>
    </tr>
    @endforeach
</table>