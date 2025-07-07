<div class="container" style="width: calc(100% - 2cm); margin-left: 1cm; margin-right: 1cm;">
    @php
    $path = public_path('images/kopSekolah.png');
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    @endphp
    <div style="text-align: center;">
        <img src="{{ $base64 }}" style="display: block; margin: 0 auto; width: 100%; height: auto">
    </div>
    <br>
    <br>
    <table class="table table-borderless" style="width: 100%; font-family: Arial, sans-serif; font-size: 12pt;">
        <tr>
            <th colspan="3" style="padding: 8px; text-align: center; font-weight: bold;">
                <u>SURAT KETERANGAN PINDAH/MUTASI KELUAR</u> <br>
                Nomor: 421.5/ .... /SMKl Kb/Dindik/{{\Carbon\Carbon::parse(date('Y-m-d'))->locale('id')->isoFormat(' YYYY') }} 
                <br>
                <br>
            </th>
        </tr>
        <tr>
            <td colspan="3" style="padding: 8px;">
                Yang bertanda tangan di bawah ini, menerangkan bahwa:
                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td style="padding: 8px; width:200px">Nama</td>
            <td style="padding: 8px; width: 20px;">:</td>
            <td style="padding: 8px; width:400px">{{ $mutasi->siswa->name ?? '' }}</td>
        </tr>
        <tr>
            <td style="padding: 8px;">Tempat, tanggal lahir</td>
            <td style="padding: 8px; width: 20px;">:</td>
            <td style="padding: 8px;">{{ $mutasi->siswa->tempat_lahir ?? '' }}, {{ $mutasi->siswa->tanggal_lahir ??
                ''
                }}</td>
        </tr>
        <tr>
            <td style="padding: 8px;">Kelas</td>
            <td style="padding: 8px; width: 20px;">:</td>
            <td style="padding: 8px;">{{ $mutasi->siswa->kelas->name ?? '' }}</td>
        </tr>
        <tr>
            <td style="padding: 8px;">NISN</td>
            <td style="padding: 8px; width: 20px;">:</td>
            <td style="padding: 8px;">{{ $mutasi->siswa->nisn ?? '' }}</td>
        </tr>
        <tr>
            <td style="padding: 8px;">Tahun pelajaran</td>
            <td style="padding: 8px; width: 20px;">:</td>
            <td style="padding: 8px;">{{ date('Y') }}</td>
        </tr>
        <tr>
            <td style="padding: 8px;">Nama Orang tua/Wali</td>
            <td style="padding: 8px; width: 20px;">:</td>
            <td style="padding: 8px;">{{ $mutasi->siswa->nama_orang_tua ?? '' }}</td>
        </tr>
        <tr>
            <td style="padding: 8px;">Pekerjaan Orang tua/Wali</td>
            <td style="padding: 8px; width: 20px;">:</td>
            <td style="padding: 8px;">{{ $mutasi->siswa->pekerjaan_orang_tua ?? '' }}</td>
        </tr>
        <tr>
            <td style="padding: 8px;">Alamat</td>
            <td style="padding: 8px; width: 20px;">:</td>
            <td style="padding: 8px;">{{ $mutasi->siswa->alamat ?? '' }}</td>
        </tr>
        <tr>
            <td style="padding: 8px;">Alasan pindah</td>
            <td style="padding: 8px; width: 20px;">:</td>
            <td style="padding: 8px;">{{ $mutasi->alasan_pindah }}</td>
        </tr>
    </table>

    <p style="padding: 8px;font-family: Arial, sans-serif; font-size: 12pt; text-align: justify;">
        Catatan <br>

        1. Menurut pengamatan kami siswa tersebut berkelakuan baik <br>
        2. Siswa yang telah keluar, tidak dapat diterima kembali menjadi siswa xxx <br><br>
        Demikian harap yang berkepentingan mengetahui. <br>
    </p>
    <p style="padding: 8px; text-align: center; padding-left: 400px; font-family: Arial, sans-serif; font-size: 12pt;">
        Koba, {{
        \Carbon\Carbon::parse(date('Y-m-d'))->locale('id')->isoFormat('D MMMM YYYY') }} <br>
        Kepala Sekolah <br>
        <br>
        <br>
        <br>
        <strong>{{ $penilai->nama }}</strong> <br>
        NIP. {{ $penilai->nip }} <br>

    </p>
</div>