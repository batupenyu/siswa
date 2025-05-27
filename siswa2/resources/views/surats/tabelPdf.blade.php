<table style="font-size: 10pt">
    <tr>
        <td style="padding-left: 300px"><i>Lampiran</i></td>
        <td>:</td>
        <td> <i>Surat Tugas Kepala {{ $atasanUnitkerja }} </i> </td>
    </tr>
    <tr>
        <td style="padding-left: 300px"><i>Nomor</i></td>
        <td>:</td>
        <td></td>
    </tr>
    <tr>
        <td style="padding-left: 300px"><i>Tanggal</i> </td>
        <td>:</td>
        <td></td>
    </tr>
</table>
    
<br><br>

<table style="border: 1px solid; margin-left: auto; margin-right: auto;" cellpadding="0">
    <tr>
        <th style="padding-left: 10px">No.</th>
        <th style="width: 200px">Nama</th>
        <th style="width: 100px">NIS</th>
        <th style="width: 155px">Kelas</th>
    </tr>
    <tr>
        <td colspan="4">
            <hr>
        </td>
    </tr>
    @foreach($surats->siswa as $siswa)
    <tr>
        <td style="padding-left: 10px">{{ $loop->iteration }}.</td>
        <td style="padding-left: 50px">{{ $siswa->name }}</td>
        <td style="text-align: center">{{ $siswa->nis }}</td>
        <td style="text-align: center">{{ $siswa->kelas->name }}</td>
    </tr>
    @endforeach
</table>

<br>
<br>

  
    <p style="text-align: center;padding-left:300px">
        {{ $surats->ditetapkan_di }}, {{ Carbon\Carbon::parse($surats->tgl_ditetapkan)->translatedFormat('d F Y') }}
        <br>
        {{ $atasanJabatan }}
        <br>
        <br>
        <br>
        <br>
        {{ $atasanNama}}
        <br>
        NIP. {{ $atasanNip }}
    </p>