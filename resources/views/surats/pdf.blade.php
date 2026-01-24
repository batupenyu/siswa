<style>
    @page {
        margin-top: 0.5cm;
    }

    .container {
        margin: 0 20px 0 20px;
        /* Top, Right, Bottom, Left */

    }

    /* Add this style to set indent for Lorem span */
    .lorem-span {
        text-indent: 50px;
        /* adjust the value as needed */
    }

    /* Add this style to set right margin for paragraph */
    .container p {
        margin-right: 50px;
        /* adjust the value as needed */


    }

    .header {
        text-align: center;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .header img {
        width: 100%;
        height: auto;
        margin-right: 15px;
    }
</style>
<!-- resources/views/nama_file.blade.php -->

<!-- Section content -->
<div class="header">
    {{-- <img src="{{ public_path('images/kopSekolah.png') }}" alt=""> --}}
    @php
    if($headerIconImage) {
    $path = storage_path('app/public/header_icons/' . $headerIconImage->filename);
    } else {
    $path = public_path('images/icon.png');
    }
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    @endphp
    <img src="{{ $base64 }}" alt="Kop Surat" style="width: 100%; max-width: 500px;">
</div>
<div class="container">
    <h3 style="text-align: center">
        SURAT TUGAS <br>
        Nomor : ........ / ..... / {{ Carbon\carbon::parse($surats->tgl_kegiatan)->translatedFormat('Y') }}
    </h3>

    <table>
        <tr style="vertical-align: top">
            <td>Dasar </td>
            <td>:</td>
            <td style="text-align: justify">{{$surats->dasar_surat}}</td>
        </tr>
        <br>
        <tr style="vertical-align: top">
            <td style="width:100px">Kepada</td>
            <td>:</td>
            <td>

                @if($surats->siswa->count() <= 2) <table style="border: 1px solid" cellpadding="0">
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
    @else
    <a href="{{ route('tabelPdf', $surats->id) }}" class="btn btn-primary btn-sm"><i>Daftar nama terlampir</i></a>
    @endif
    </td>
    </tr>
    <tr style="vertical-align: top">
        <td>Untuk</td>
        <td>:</td>
        <td>
            Melaksanakan {{ $surats->nama_kegiatan }} <br><br>
            Hari/tanggal <span>:</span>
            @if ($surats->tgl_kegiatan != $surats->tgl_akhir_kegiatan)
            {{ Carbon\carbon::parse($surats->tgl_kegiatan)->translatedFormat('l') }} - {{
            Carbon\carbon::parse($surats->tgl_akhir_kegiatan)->translatedFormat('l') }}/ {{
            Carbon\carbon::parse($surats->tgl_kegiatan)->translatedFormat('d-m-Y') }} s.d. {{
            Carbon\carbon::parse($surats->tgl_akhir_kegiatan)->translatedFormat('d-m-Y') }} <br>
            @else
            {{ Carbon\carbon::parse($surats->tgl_kegiatan)->translatedFormat('l') }}/ {{
            Carbon\carbon::parse($surats->tgl_akhir_kegiatan)->translatedFormat('d-m-Y') }} <br>
            @endif

            Pukul <span style="padding-left: 43px">:</span> {{ Carbon\Carbon::parse($surats->jam_kegiatan
            )->format('H:i')}} WIB s.d Selesai
            <br>
            Tempat <span style="padding-left: 32px">:</span> {{ $surats->tempat_kegiatan }}
        </td>
    </tr>
    <br>
    <tr>
        <td style="text-align: justify" colspan="3">Demikian surat tugas ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</td>
    </tr>
    </table>
    <br>

    <p style="text-align: center;padding-left:300px">
        {{ $surats->ditetapkan_di }}, {{ Carbon\Carbon::parse($surats->tgl_ditetapkan)->translatedFormat('d F Y') }}
        <br>
        {{ $penilai->jabatan }}
        <br>
        <br>
        <br>
        <br>
        {{ $penilai->nama}}
        <br>
        NIP. {{ $penilai->nip }}
    </p>
</div>