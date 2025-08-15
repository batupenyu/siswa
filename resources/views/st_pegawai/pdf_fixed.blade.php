<style>
    .lorem-span {
        text-indent: 50px;
    }

    .container p {
        margin-right: 37.8px;
        /* 1cm = 37.8px */
    }

    ol li {
        text-align: justify;
        vertical-align: top;
    }

    ol {
        vertical-align: top;
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .header img {
        width: 100%;
        height: auto;
    }

    .container {
        margin-right: 37.8px;
        /* 1cm = 37.8px */
    }
</style>

<div class="container">
    @if($stPegawai->pegawais->isNotEmpty())
    @php
    $firstPegawai = $stPegawai->pegawais->first();
    $namaParts = explode(' ', $firstPegawai->jabatan);
    $firstName = $namaParts[0];
    @endphp

    @if ($firstName == 'Kepala')
    <img src="{{ public_path('images/kopcabdin1.png') }}" alt="">
    <h4 style="text-align: center">
        <u>SURAT TUGAS</u> <br>
        Nomor : 421.5/........./ST/CABDINDIK WIL I/{{ Carbon\Carbon::Parse($stPegawai->tgl_kegiatan)->translatedFormat('Y') }}.
    </h4>
    @else
    <div class="header">
        @if ($stPegawai->pegawais->first()->nip == $penilai->nip)
        <img src="{{ public_path('images/kopcabdin1.png') }}" alt="">
        @else
        @if($headerIconImage)
        <img src="{{ public_path('storage/header_icons/' . $headerIconImage->filename) }}" alt="Icon">
        @else
        <img src="{{ public_path('images/icon.png') }}" alt="Kop Surat">
        @endif
        @endif
    </div>
    <h4 style="text-align: center">
        <u>SURAT TUGAS</u> <br>
        Nomor : 094/........./ST/SMKN 1 Kb/Dindik/{{ Carbon\Carbon::Parse($stPegawai->tgl_kegiatan)->translatedFormat('Y') }}.
    </h4>
    @endif
    @else
    -
    @endif
</div>
<br>
<br>

@if ($stPegawai->dasar_surat == '-')
<div> Yang bertanda tangan dibawah ini :</div>
<br>
<table>
    <tbody>
        <tr style="vertical-align: top">
            <td style="width:50px"></td>
            <td style="width: 50px;"></td>
            <td>
                @include('st_pegawai.lampiran_4')
            </td>
        </tr>
    </tbody>
</table>
@else
<table>
    <tr>
        <td style="vertical-align:top" width="50px">Dasar</td>
        <td style="vertical-align:top">:</td>
        <td style="vertical-align:top">
            <ol style="padding-left: 20px; padding-top: 0px; margin-top: 0px; text-align:justify">
                <li>Undang-Undang Nomor 27 Tahun 2000 tentang Pembentukan Provinsi Kepulauan Bangka Belitung</li>
                <li>Undang-Undang Nomor 17 Tahun 2003 tentang Keuangan Negara</li>
                <li>Undang-Undang Nomor 20 Tahun 2003 tentang Sistem Pendidikan Nasional</li>
                <li>{{ $stPegawai->dasar_surat}}</li>
            </ol>
        </td>
    </tr>
</table>
@endif

<table>
    <tr>
        <td style="text-align: center;padding:20px" colspan="3"><b>MENUGASKAN</b> :</td>
    </tr>
    <tr style="vertical-align: top">
        <td style="width:50px">Kepada</td>
        <td>:</td>
        <td>
            @if ($stPegawai->pegawais->count() <= 1)
                @include('st_pegawai.lampiran_2')
                @elseif ($stPegawai->pegawais->count() >= 2)
                @include('st_pegawai.lampiran_3')
                @else
                @include('st_pegawai.lampiran_1')
                @endif
        </td>
    </tr>
    @php
    $diffDay = \Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays(\Carbon\Carbon::parse($stPegawai->tgl_akhir)) + 1;
    $diffDayTerbilang = \App\Helpers\NumberHelper::terbilang($diffDay);
    @endphp


    <tr>
        <td style="text-align: justify; vertical-align:auto">Untuk</td>
        <td style="text-align: justify; vertical-align:auto">:</td>
        <td style="vertical-align:top">
            <ol style="padding-left: 20px; padding-top: 0px; margin-top: 0px; text-align:justify">
                <li>Dalam rangka melaksanakan {{ $stPegawai->nama_kegiatan }}</li>
                <li>Dilaksanakan dengan sebaik-baiknya dan penuh rasa tanggung jawab.</li>
            </ol>
        </td>
    </tr>

</table>

@if($stPegawai->pegawais->isNotEmpty())
<p style="padding-left:420px">
    Ditetapkan di {{$stPegawai->pegawais->first()->nip != $penilai->nip ? 'Koba' : 'Pangkalpinang'}} <br>
    Pada tanggal, {{ Carbon\Carbon::parse($stPegawai->tgl_awal)->translatedFormat('d F Y') }}. <br><br>
    @if ($stPegawai->pegawais->first()->nip != $penilai->nip)
    {{$penilai->jabatan}} <br><br><br><br>
    {{$penilai->nama}} <br>
    NIP.{{ $penilai->nip }}
    @else
    {{$kpa->jabatan}} {{$kpa->unitkerja}} <br><br><br><br>
    {{$kpa->nama}} <br>
    NIP. {{$kpa->nip }}
    @endif
</p>
@endif