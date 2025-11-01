<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Perjalanan Dinas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            line-height: 1.5;
            margin-top: 0cm;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .kop-opd {
            /* border-bottom: 3px solid #000; */
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .nomer-dokumen {
            text-align: right;
            font-size: 10pt;
            margin-bottom: 10px;
        }

        .content {
            margin: 0 50px;
        }

        .nota-dinas {
            margin-bottom: 30px;
        }

        .kepada-dari {
            margin-bottom: 15px;
        }

        .tanggal-nomor {
            margin-bottom: 15px;
        }

        .sifat-hal {
            margin-bottom: 15px;
        }

        .section {
            margin-bottom: 15px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 5px;
            padding-right: 20px;
        }

        .section-title>span {
            padding-left: 15px;
        }

        .signature {
            margin-top: 50px;
            width: 100%;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }

        .signature-table td {
            width: 50%;
            vertical-align: top;
            padding-top: 60px;
        }

        .signature-line {
            border-top: 1px solid #000;
            width: 80%;
            margin-top: 5px;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            /* padding: 8px; */
            text-align: left;
            vertical-align: top;
        }

        .custom-hr {
            border: none;
            border-top: 2px solid #000;
            margin: 20px auto;
            width: 100%;
        }

        .label-text {
            display: inline-block;
            text-align: left;
            margin-right: 5px;
            min-width: 70px;
        }

        .label-colon {
            display: inline-block;
            width: 10px;
            text-align: right;
            margin-right: 10px;
        }

        .indented-text {
            display: inline-block;
            text-indent: 2em;
            white-space: pre-wrap;
        }

        .table-borderless,
        .table-borderless th,
        .table-borderless td {
            border: none;
        }

        .section-content-indent {
            padding-left: 1.5em;
            text-indent: -1.5em;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="kop-opd">
            <img src="{{ public_path('images/kopSekolah.png') }}" alt="">
        </div>
    </div>
    <!-- @include('st_pegawai.header') -->

    <div class="content">
        @php
        $stPegawaiItem = $stPegawai->first();
        @endphp

        <div class="nota-dinas">
            <div style="text-align: center; font-weight: bold; font-size: 14pt; margin-bottom: 10px;">
                <strong>NOTA DINAS</strong><br>
            </div>

            <table class="table table-sm table-borderless">
                <tr>
                    <td style="width: 100px">Kepada</td>
                    <td style="width: 20px">:</td>
<<<<<<< HEAD
                    <td>Yth. {{$penilai->jabatan ?? ''}} {{$penilai->unitkerja ?? ''}}</td>
=======
                    <td>Yth. {{$penilai->jabatan}} {{$penilai->unitkerja}}</td>
>>>>>>> 0da78d7 (commit)
                </tr>
                @php
                $firstPegawai = $stPegawaiItem->pegawais->first();
                $namaParts = explode(' ', $firstPegawai->nama);
                $jabatanParts = explode(' ', $firstPegawai->jabatan);
                $nipParts = explode(' ', $firstPegawai->nip);
                $unitParts = explode(' ', $firstPegawai->unitkerja);
                $firstName = $namaParts[0];
                $lastName1 = isset($namaParts[1]) ? $namaParts[1] : '';
                $lastName2 = isset($namaParts[2]) ? $namaParts[2] : '';
                @endphp
                <tr>
                    <td>Dari</td>
                    <td>:</td>
<<<<<<< HEAD
                    <td>{{$jabatanParts[0] ?? ''}} {{$penilai->unitkerja ?? ''}}</td>
=======
                    <td>{{$jabatanParts[0]}} {{$penilai->unitkerja}}</td>
>>>>>>> 0da78d7 (commit)
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td style="text-align: justify">
                        @if($stPegawaiItem && $stPegawaiItem->tgl_ditetapkan)
                        @php
                        $date = \Carbon\Carbon::parse($stPegawaiItem->tgl_ditetapkan);
                        $isWeekday = $date->isWeekday();
                        $isHoliday = \App\Models\Holiday::whereDate('date', $date->toDateString())->exists();

                        if ($isWeekday || $isHoliday) {
                        $date->addDay();
                        }
                        @endphp
                        {{ $date->translatedFormat('d F Y') }}
                        @else
                        -
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Nomor</td>
                    <td>:</td>
                    <td>421.5/ ......... /SMKN 1
                        Kb/Dindik/{{\Carbon\Carbon::parse($stPegawaiItem->tgl_ditetapkan)->translatedFormat('Y')}},
                        tanggal
                        {{\Carbon\Carbon::parse($stPegawaiItem->tgl_ditetapkan)->translatedFormat('d F Y')}}
                    </td>
                </tr>
                <tr>
                    <td>Sifat</td>
                    <td>:</td>
                    <td>Biasa</td>
                </tr>
                <tr>
                    <td>Hal</td>
                    <td>:</td>
<<<<<<< HEAD
                    <td style="text-align: justify">{{$stPegawaiItem->nama_kegiatan}}.</td>
=======
                    <td style="text-align: justify">Laporan {{$stPegawaiItem->nama_kegiatan}}.</td>
>>>>>>> 0da78d7 (commit)
                </tr>
            </table>

            <div class="custom-hr"></div>

            <p style="text-align: justify">Bersama ini disampaikan laporan hasil perjalanan dinas dalam rangka
                {{$stPegawaiItem->nama_kegiatan}} dengan rincian sebagai berikut :
            </p>
        </div>

        <table class="table table-borderless">
<<<<<<< HEAD
            <tr>
                <th style="width: 30px;">I. </th>
                <th>Dasar Pelaksanaan</th>
            </tr>
            <tr>
                <td></td>
                <td style=" text-align: justify;" colspan="2">{{$stPegawaiItem->dasar_surat ?? '-'}}.</td>
            </tr>
            <tr>
                <th>II. </th>
                <th>Maksud dan Tujuan</th>
            </tr>
            <tr>
                <td></td>
                <td style=" text-align: justify;">{{$stPegawaiItem->maksud_tujuan ?? '-'}}.</td>
            </tr>
            <tr>
                <th>III. </th>
                <th>Waktu dan Tempat</th>
            </tr>
            <tr>
                <td></td>
                <td>
                    Melaksanakan {{ $stPegawaiItem->nama_kegiatan }} yang akan dilaksanakan pada : <br>
                    Hari/Tanggal <span style="padding-left: 30px">:</span>
=======
            <!-- <table border="1"> -->
            <tr>
                <th style="width: 30px;">I. </th>
                <th colspan="3">Dasar Pelaksanaan</th>
            </tr>
            <tr>
                <td></td>
                <td style=" text-align: justify;" colspan="3">{{$stPegawaiItem->dasar_surat ?? '-'}}.</td>
            </tr>
            <tr>
                <th>II. </th>
                <th colspan="3">Maksud dan Tujuan</th>
            </tr>
            <tr>
                <td></td>
                <td colspan="3" style=" text-align: justify;">{{$stPegawaiItem->maksud_tujuan ?? '-'}}.</td>
            </tr>
            <tr>
                <th>III. </th>
                <th colspan="3">Waktu dan Tempat</th>
            </tr>
            <tr>
                <td></td>
                <td style="width: 100px;">
                    Hari/Tanggal
                </td>
                <td style="width: 20px;">:</td>
                <td>
>>>>>>> 0da78d7 (commit)
                    {{-- {{Carbon\Carbon::parse($stPegawaiItem->tgl_awal)->translatedFormat('d-m-Y') }} --}}
                    @if ($stPegawaiItem->tgl_awal != $stPegawaiItem->tgl_akhir)
                    {{ Carbon\carbon::parse($stPegawaiItem->tgl_awal)->translatedFormat('l') }} - {{
                    Carbon\carbon::parse($stPegawaiItem->tgl_akhir)->translatedFormat('l') }}/ {{
                    Carbon\carbon::parse($stPegawaiItem->tgl_awal)->translatedFormat('d-m-Y') }} s.d. {{
                    Carbon\carbon::parse($stPegawaiItem->tgl_akhir)->translatedFormat('d-m-Y') }}
                    @else
                    {{ Carbon\carbon::parse($stPegawaiItem->tgl_awal)->translatedFormat('l') }}/
                    {{Carbon\carbon::parse($stPegawaiItem->tgl_akhir)->translatedFormat('d-m-Y') }}
                    @endif
<<<<<<< HEAD
                    <br>
                    Pukul <span style="padding-left: 82px">:</span>
                    {{ Carbon\Carbon::parse($stPegawaiItem->jam_kegiatan)->format('H:i')}} WIB s.d Selesai
                    <br>
                    Tempat <span style="padding-left: 68px">:</span>
                    {{ $stPegawaiItem->tempat_kegiatan }}

                </td>
            </tr>
            <tr>
                <th>IV. </th>
                <th>Materi dan Narasumber (apabila ada)</th>
            </tr>
            <tr>
                <td></td>
                <td style=" text-align: justify;">{{$stPegawaiItem->materi_narsum ?? '-'}}</td>
            </tr>
            <tr>
                <th>V. </th>
                <th>Hasil yang diperoleh</th>
            </tr>
            <tr>
                <td></td>
                <td style=" text-align: justify;">{{$stPegawaiItem->hasil ?? '-'}}</td>
            </tr>
            <tr>
                <th>VI. </th>
                <th>Kesimpulan dan saran</th>
            </tr>
            <tr>
                <td></td>
                <td style=" text-align: justify;">{{$stPegawaiItem->kesimpulan ?? '-'}}</td>
=======
                </td>
            </tr>

            <tr>
                <td></td>
                <td style="width: 100px;">Tempat </td>
                <td>:</td>
                <td style="text-align: justify;">{{ $stPegawaiItem->tempat_kegiatan }}
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="width: 100px;">Pukul</td>
                <td>:</td>
                <td style="text-align: justify;">{{ Carbon\Carbon::parse($stPegawaiItem->jam_kegiatan)->format('H:i')}} WIB s.d Selesai</td>
            </tr>

            <tr>
                <th>IV. </th>
                <th colspan="3">Materi dan Narasumber (apabila ada)</th>
            </tr>
            <tr>
                <td></td>
                <td colspan="3" style="text-align: justify;">
                    {{$stPegawaiItem->materi_narsum ?? '-'}}
                </td>
            </tr>
            <tr>
                <th>V. </th>
                <th colspan="3">Hasil yang diperoleh</th>
            </tr>
            <tr>
                <td></td>
                <td colspan="3" style="text-align: justify;">
                    {{$stPegawaiItem->hasil ?? '-'}}
                </td>
            </tr>
            <tr>
                <th>VI. </th>
                <th colspan="3">Kesimpulan dan saran</th>
            </tr>
            <tr>
                <td></td>
                <td colspan="3" style="text-align: justify;">
                    {{$stPegawaiItem->kesimpulan ?? '-'}}
                </td>
>>>>>>> 0da78d7 (commit)
            </tr>
        </table>

        <p>Demikian laporan ini disampaikan, atas perhatian Bapak/Ibu diucapkan terima kasih.</p>

        <table class="table table-sm table-borderless">
            <tr>
                <td class="center">
<<<<<<< HEAD
                    Mengetahui,<br>
                    {{$penilai->jabatan ?? ''}},<br>
                    <br>
                    <br>
                    {{$penilai->nama ?? ''}}<br>
                    NIP.{{$penilai->nip ?? ''}}
                </td>
                <td class="center">
                    Yang melaporkan,<br>
                    @if($stPegawaiItem && $stPegawaiItem->pegawais->isNotEmpty())
                    @php
                    $firstPegawai = $stPegawaiItem->pegawais->first();
                    $namaParts = explode(' ', $firstPegawai->nama);
                    $jabatanParts = explode(' ', $firstPegawai->jabatan);
                    $nipParts = explode(' ', $firstPegawai->nip);
                    $firstName = $namaParts[0];
                    $lastName1 = isset($namaParts[1]) ? $namaParts[1] : '';
                    $lastName2 = isset($namaParts[2]) ? $namaParts[2] : '';
                    @endphp
                    <br>
                    <br>
                    <br>
                    {{ $firstName }} {{ $lastName1 }} {{ $lastName2 }}<br>
                    NIP.{{ isset($nipParts[0]) ? $nipParts[0] : '' }}{{ isset($nipParts[1]) ? $nipParts[1] : '' }}{{ isset($nipParts[2]) ? $nipParts[2] : '' }}{{ isset($nipParts[3]) ? $nipParts[3] : '' }}
                    @else
                    - @endif
=======
                    <br>
                    <br>
                    Mengetahui,<br>
                    {{$penilai->jabatan }},<br>
                    <br>
                    <br>
                    {{$penilai->nama}}<br>
                    NIP.{{$penilai->nip}}
                </td>

                <td style="width:70px"> </td>

                <td style="vertical-align: top; padding-right: 20px;">
                    Yang melaporkan,<br> <br>
                    @if($stPegawaiItem && $stPegawaiItem->pegawais->isNotEmpty())
                    @foreach($stPegawaiItem->pegawais as $pegawai)
                    @php
                    $namaParts = explode(' ', $pegawai->nama);
                    $firstName = $namaParts[0] ?? '';
                    $lastName1 = $namaParts[1] ?? '';
                    $lastName2 = $namaParts[2] ?? '';
                    $namaLengkap = trim($firstName . ' ' . $lastName1 . ' ' . $lastName2);
                    @endphp

                    {{ $namaLengkap }}<br>
                    NIP. {{ $pegawai->nip }}<br>
                    {{ $pegawai->jabatan ?? '-' }}<br><br>
                    @endforeach
                    @else
                    -
                    @endif
                </td>

                <td class="center" style="vertical-align: top;">
                    <br><br><br><br>
                    @if($stPegawaiItem && $stPegawaiItem->pegawais->isNotEmpty())
                    @foreach($stPegawaiItem->pegawais as $pegawai)
                    ................<br><br><br><br>
                    @endforeach
                    @else
                    -
                    @endif
>>>>>>> 0da78d7 (commit)
                </td>
            </tr>
        </table>

        <div class="custom-hr"></div>

        <p class="right">Tanggal Cetak: {{ date('d-m-Y H:i:s') }}</p>
    </div>
</body>

</html>