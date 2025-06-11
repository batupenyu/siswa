<style>
    .container {
        margin: 0 20px 0 20px;
        /* Top, Right, Bottom, Left */
        margin-top: 0px;
        /* Set top margin to zero */
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

    /* Add this style to justify align for ol li */
    ol li {
        text-align: justify;
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

    .card-body {
        box-shadow: 0 10px 8px rgba(0, 0, 0, 0.1);
    }
</style>
<!-- resources/views/nama_file.blade.php -->

<!-- Section content -->
<div class="container">
    {{-- <div class="header">
        @if($headerIconImage)
        <img src="{{ public_path('storage/header_icons/' . $headerIconImage->filename) }}" alt="Icon">
        @else
        <img src="{{ public_path('images/icon.png') }}" alt="Kop Surat">
        @endif
    </div> --}}
    @if($stPegawai->pegawais->isNotEmpty())
    @php
    $firstPegawai = $stPegawai->pegawais->first();
    $namaParts = explode(' ', $firstPegawai->jabatan);
    $firstName = $namaParts[0];
    $lastName = isset($namaParts[1]) ? $namaParts[1] : '';
    @endphp
    @if ($firstName == 'Kepala')
    <img src="{{ public_path('images/kopcabdin1.png') }}" alt="">
    <h4 style="text-align: center">
        <u>SURAT TUGAS</u> <br>
        Nomor : 421.5/........./ST/CABDINDIK WIL I/{{
        Carbon\Carbon::Parse($stPegawai->tgl_kegiatan)->translatedFormat('Y')
        }}.
    </h4>
    @else
    <div class="header">
        @if($headerIconImage)
        <img src="{{ public_path('storage/header_icons/' . $headerIconImage->filename) }}" alt="Icon">
        @else
        <img src="{{ public_path('images/icon.png') }}" alt="Kop Surat">
        @endif
    </div>
    {{-- <img src="{{ public_path('images/kopsekolah.png') }}" alt=""> --}}
    <h4 style="text-align: center">
        <u>SURAT TUGAS</u> <br>
        Nomor : 094/........./ST/SMKN 1 Kb/Dindik/{{
        Carbon\Carbon::Parse($stPegawai->tgl_kegiatan)->translatedFormat('Y')
        }}.
    </h4>
    @endif
    @else
    -
    @endif
</div>

<table>
    <tr style="vertical-align: top">
        <td>Dasar </td>
        <td>:</td>
        <td>
            <ol style="padding-left: 20px; padding-top: 0px; margin-top: 0px;">
                <li>Undang-Undang Nomor 27 Tahun 2000 tentang Pembentukan
                    Provinsi Kepulauan Bangka. Belitung (Lembaran Negara
                    Republik Indonesia Tahun 2000 Nomor 217, Tambahan
                    Lembaran Negara Republik Indonesia Nomor 4033);
                </li>
                {{-- <li>Peraturan Pemerintah Nomor 38 Tahun 2007 tentang
                    Pembagian Urusan Pemerintahan Antara Pemerintah, Pemerintah Daerah Provinsi, dan
                    Pemerintah Daerah Kabupaten/Kota (Lembaran Negara Republik Indonesia Tahun 2007 Nomor 82,
                    Tambahan Lembaran Negara Republik Indonesia Nomor 4737);
                </li>
                <li>Peraturan Menteri Dalam Negeri Nomor 84 Tahun 2014
                    tentang Pedoman Pengelolaan Keuangan Daerah (Berita Negara Republik Indonesia Tahun 2014 Nomor
                    1944);
                </li>
                <li>Peraturan Menteri Pendidikan dan Kebudayaan Nomor
                    6 Tahun 2018 tentang Organisasi dan Tata Kerja Sekolah Menengah Kejuruan (Berita Negara Republik
                    Indonesia Tahun 2018 Nomor 194);
                </li>
                <li>Peraturan Gubernur Kepulauan Bangka Belitung Nomor
                    2 Tahun 2020 tentang Organisasi Perangkat Daerah Provinsi Kepulauan Bangka Belitung (Berita
                    Daerah Provinsi Kepulauan Bangka Belitung Tahun 2020 Nomor 2);
                </li>
                <li>Peraturan Gubernur Kepulauan Bangka Belitung Nomor
                    3 Tahun 2020 tentang Kedudukan, Susunan Organisasi, Tugas dan Fungsi, serta Tata Kerja Dinas
                    Pendidikan Provinsi Kepulauan Bangka Belitung (Berita Daerah Provinsi Kepulauan Bangka Belitung
                    Tahun 2020 Nomor 3);
                </li>
                <li>Peraturan Gubernur Kepulauan Bangka Belitung Nomor
                    4 Tahun 2020 tentang Organisasi dan Tata Kerja Sekolah Menengah Kejuruan Provinsi Kepulauan
                    Bangka Belitung (Berita Daerah Provinsi Kepulauan Bangka Belitung Tahun 2020 Nomor 4);
                </li> --}}

                <li>{{ $stPegawai->dasar_surat }}</li>
            </ol>
    </tr>
    <tr>
        <td style="text-align: center;padding:20px" colspan="3"><b>MENUGASKAN</b> :</td>
    </tr>
    <tr style="vertical-align: top">
        <td style="width:100px">Kepada</td>
        <td>:</td>
        <td>
            @if ($stPegawai->pegawais->count() <= 1) @include('st_pegawai.lampiran_2') @elseif ($stPegawai->
                pegawais->count() >= 2)
                @include('st_pegawai.lampiran_3')
                @else
                @include('st_pegawai.lampiran_1')
                @endif
        </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        @php
        $diffDay =
        \Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays(\Carbon\Carbon::parse($stPegawai->tgl_akhir))
        + 1;
        $diffDayTerbilang = \App\Helpers\NumberHelper::terbilang($diffDay);
        @endphp
        {{-- <td>Tujuan perjalanan <span style="padding-left: 21px">: </span><span
                style="padding-left: 23px">{{$stPegawai->nama_kegiatan}}
            </span><br>
            Lama perjalanan <span style="padding-left: 30px">: </span><span style="padding-left: 20px">
                {{$diffDay}} ({{ $diffDayTerbilang }}) hari,
                @if ($stPegawai->tgl_awal != $stPegawai->tgl_akhir)
                dari tanggal {{Carbon\carbon::parse($stPegawai->tgl_awal)->translatedFormat('d-m-Y') }} s.d. {{
                Carbon\carbon::parse($stPegawai->tgl_akhir)->translatedFormat('d-m-Y') }} <br>
                @else
                tanggal
                {{Carbon\carbon::parse($stPegawai->tgl_akhir)->translatedFormat('d-m-Y') }} <br>
                @endif
            </span>
        </td> --}}
        <td>
            <table>
                <tr>
                    <td style="vertical-align: top;width:133px">Tujuan Perjalanan</td>
                    <td style="vertical-align: top">:</td>
                    <td style="vertical-align: top; padding-left:25px">{{$stPegawai->nama_kegiatan}}
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam ipsam magni a optio vitae officiis
                        illum quibusdam eum repellendus maxime.
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top">Lama Perjalanan</td>
                    <td style="vertical-align: top">:</td>
                    <td style="vertical-align: top;padding-left:25px">{{$diffDay}} ({{ $diffDayTerbilang }}) hari,
                        @if ($stPegawai->tgl_awal != $stPegawai->tgl_akhir)
                        dari tanggal
                        {{Carbon\carbon::parse($stPegawai->tgl_awal)->translatedFormat('d ') }} s.d.
                        {{Carbon\carbon::parse($stPegawai->tgl_akhir)->translatedFormat('d F') }}
                        Tahun {{Carbon\carbon::parse($stPegawai->tgl_akhir)->translatedFormat('Y') }}
                        <br>
                        {{-- {{Carbon\carbon::parse($stPegawai->tgl_awal)->translatedFormat('d-m-Y') }} s.d. {{
                        Carbon\carbon::parse($stPegawai->tgl_akhir)->translatedFormat('d-m-Y') }} <br> --}}
                        @else
                        tanggal
                        {{Carbon\carbon::parse($stPegawai->tgl_akhir)->translatedFormat('d-m-Y') }} <br> @endif
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <br>
    {{-- <tr style="vertical-align: top">
        <td>Untuk</td>
        <td>:</td>
        <td>
            Dalam rangka melaksanakan {{ $stPegawai->nama_kegiatan }} yang akan dilaksanakan pada :<br><br>
            Hari/tanggal <span>:</span>
            @if ($stPegawai->tgl_kegiatan != $stPegawai->tgl_akhir_kegiatan)
            {{ Carbon\carbon::parse($stPegawai->tgl_kegiatan)->translatedFormat('l') }} - {{
            Carbon\carbon::parse($stPegawai->tgl_akhir_kegiatan)->translatedFormat('l') }}/ {{
            Carbon\carbon::parse($stPegawai->tgl_kegiatan)->translatedFormat('d-m-Y') }} s.d. {{
            Carbon\carbon::parse($stPegawai->tgl_akhir_kegiatan)->translatedFormat('d-m-Y') }} <br>
            @else
            {{ Carbon\carbon::parse($stPegawai->tgl_kegiatan)->translatedFormat('l') }}/ {{
            Carbon\carbon::parse($stPegawai->tgl_akhir_kegiatan)->translatedFormat('d-m-Y') }} <br>
            @endif

            Pukul <span style="padding-left: 43px">:</span> {{ Carbon\Carbon::parse($stPegawai->jam_kegiatan
            )->format('H:i')}} WIB s.d Selesai
            <br>
            Tempat <span style="padding-left: 32px">:</span> {{ $stPegawai->tempat_kegiatan }}
        </td>
    </tr> --}}
    <tr>
        <td style="text-align: justify; vertical-align:top">Untuk</td>
        <td style="text-align: justify; vertical-align:top">:</td>
        <td>
            <table>
                {{-- <tr>
                    <td style="vertical-align: top">
                        1. Dalam rangka melaksanakan {{ $stPegawai->nama_kegiatan }}
                    </td>
                </tr>
                <tr>
                <tr>
                    <td style="vertical-align: top">
                        2. ................................................
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top">
                        3. ................................................
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top">
                        4. Dilaksanakan dengan sebaik-baiknya dan penuh rasa tanggung jawab.
                    </td>
                </tr> --}}
                <tr>
                    <td>
                        <ol style="padding-left: 20px; padding-top: 0px; margin-top: 0px;">
                            <li>Dalam rangka melaksanakan {{ $stPegawai->nama_kegiatan }}</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi officiis
                                necessitatibus dolore eius a inventore, dolores eum exercitationem! In nisi amet
                                temporibus quibusdam beatae rem eum ipsam ullam accusantium harum? Incidunt illum, enim
                                officiis iusto tempora error, quaerat aperiam ab dolores tempore eum? Odit ipsam dolorum
                                cupiditate, numquam corporis mollitia?</li>
                            <li>Dilaksanakan dengan sebaik-baiknya dan penuh rasa tanggung jawab.</li>
                        </ol>
                    </td>
                </tr>
            </table>
        </td>
        {{-- <td style="text-align: justify; vertical-align:top" colspan="3">
            <ol style="padding-left: 20px; text-align">
                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt, magnam?</li>
                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, quam ipsa?</li>
                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis similique dolore sed!</li>
            </ol>
        </td> --}}
    </tr>
</table>
@if($stPegawai->pegawais->isNotEmpty())
@php
$firstPegawai = $stPegawai->pegawais->first();
$namaParts = explode(' ', $firstPegawai->jabatan);
$firstName = $namaParts[0];
$lastName = isset($namaParts[1]) ? $namaParts[1] : '';
@endphp
<p style="text-align: left;padding-left:420px">
    Dikeluarkan di <span>:</span> {{ $stPegawai->tempat_ditetapkan }} <br>
    Pada tanggal <span style="padding-left: 14px">:</span> {{
    Carbon\Carbon::parse($stPegawai->tgl_ditetapkan)->translatedFormat('d F Y') }}
<p>
    @if ($firstName == 'Kepala')
<p style="text-align: center;padding-left:300px">
    {{-- {{ $stPegawai->tempat_ditetapkan }}, {{ Carbon\Carbon::parse($stPegawai->tgl_ditetapkan)->translatedFormat('d F
    Y') }} --}}
    {{ $kpaJabatan }}
    <br>
    <br>
    <br>
    <br>
    {{ $kpaNama}}
    <br>
    NIP. {{ $kpaNip }}
</p>
@else
<p style="text-align: center;padding-left:300px">
    {{-- {{ $stPegawai->tempat_ditetapkan }}, {{ Carbon\Carbon::parse($stPegawai->tgl_ditetapkan)->translatedFormat('d F
    Y') }} --}}
    {{ $atasanJabatan }}
    <br>
    <br>
    <br>
    <br>
    {{ $atasanNama}}
    <br>
    NIP. {{ $atasanNip }}
</p>
@endif
@else
-
@endif