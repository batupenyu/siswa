<table border="0" style="font-size: 10pt">
    <tr>
        <td style="padding-left: 300px;width:75px"><i>Lampiran</i></td>
    </tr>
    <tr>
        <td colspan="3" style="padding-left: 300px"> <i>Surat Dispensasi Kepala {{ $atasanUnitkerja }} </i> </td>
    </tr>
    <tr>
        <td style="padding-left: 300px"><i>Nomor</i></td>
        <td style="width: 30px">:</td>
        <td style="width: 200px"></td>
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
    @foreach($dispensasi->siswa as $siswa)
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
        Koba, {{ Carbon\Carbon::parse($dispensasi->tgl_ditetapkan)->translatedFormat('d F Y') }}
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