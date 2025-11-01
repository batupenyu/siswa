@php
$path = public_path('images/kopSekolah.png');
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
@endphp
<div style="text-align: center;">
    <img src="{{ $base64 }}" style="display: block; margin: 0 auto; width: 100%; height: auto">
</div>
<h3 style="text-align: center"><u>SURAT KETERANGAN</u>
    <br>
    Nomor: 421.5/ .... /SMKl Kb/Dindik/2025
</h3>


<table border="0" style="width: 95%; padding-left: 1.2cm;">
    <tr>
        <td style="text-align:left;padding-bottom:20px;padding-top:20px" colspan="3">Yang bertanda tangan dibawah ini :</td>
    </tr>
    <tr>
        <td style="width:200px">Nama</td>
        <td style="width: 30px">:</td>
        <td>{{ $penilai->nama }}</td>
    </tr>
    <tr>
        <td>NIP</td>
        <td style="width: 30px">:</td>
        <td>{{ $penilai->nip }}</td>
    </tr>
    <tr>
        <td>Pangkat, Gol./Ruang</td>
        <td style="width: 30px">:</td>
        <td>{{ $penilai->jabatan }}</td>
    </tr>
    <tr>
        <td>Jabatan</td>
        <td style="width: 30px">:</td>
        <td>{{ $penilai->jabatan }}</td>
    </tr>
    <tr>
        <td>Unit Kerja</td>
        <td style="width: 30px">:</td>
        <td>{{ $atasanUnitkerja}}</td>
    </tr>
    <tr>
        <td>NPSN</td>
        <td style="width: 30px">:</td>
        <td>10900753</td>
    </tr>
    <tr>
        <td style="text-align:left; padding-top:20px; padding-bottom:20px;" colspan="3">Dengan ini menerangkan :</td>
    </tr>
    <tr>
        <td>Nama</td>
        <td style="width: 30px">:</td>
        <td>{{ $siswa ? $siswa->name : '' }}</td>
    </tr>
    <tr>
        <td>NISN</td>
        <td style="width: 30px">:</td>
        <td>{{ $siswa ? $siswa->nis : '' }}</td>
    </tr>
    <!-- <tr>
        <td>NPSN</td>
        <td style="width: 30px">:</td>
        <td>{{ $siswa ? $siswa->npsn : '' }}</td>
    </tr> -->
    <tr>
        <td>Kelas</td>
        <td style="width: 30px">:</td>
        <td>{{ $siswa && $siswa->kelas ? $siswa->kelas->name : '' }}</td>
    </tr>
    <tr>
        <td colspan="3" style="padding-top:20px; padding-bottom:20px; text-align:justify">
            {{ $suket->description }}
        </td>
    </tr>

    <tr>
        <td colspan="3" style="text-align: justify">
            Demikian Surat Keterangan ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.
        </td>
    </tr>
</table>

<p style="text-align: left; padding-left: 400px; padding-top: 20px">
    {{ $suket->tempat_ditetapkan }},<span style="padding-left: 30px"> {{ \Carbon\Carbon::parse($suket->tgl_ditetapkan)->translatedFormat('d F Y') }} </span><br>
    {{ $penilai->jabatan }} <br><br><br><br>
    <u>{{ $penilai->nama }}</u><br>
    NIP. {{ $penilai->nip }}
</p>