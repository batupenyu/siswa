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
            {{-- <img src="{{ public_path('images/kopcabdin1.png') }}" alt=""> --}}
            <img src="{{ public_path('images/kopSekolah.png') }}" alt="">
        </div>
    </div>

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
                </tr>
                <tr>
                    <td>Dari</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td>Nomor</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td>Sifat</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td>Hal</td>
                    <td>:</td>
                    <td style="text-align: justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus
                        officiis, ipsum nam magni
                        odit possimus expedita labore numquam dolor alias.</td>
                </tr>
            </table>

            <div class="custom-hr"></div>

            <p style="text-align: justify">Bersama ini disampaikan laporan hasil perjalanan dinas dalam rangka .. Lorem
                ipsum dolor sit amet
                consectetur adipisicing elit. Dolores libero amet placeat qui minima et accusamus possimus quidem.
                Culpa, reiciendis..... dengan rincian sebagai berikut :</p>
        </div>

        <table class="table table-borderless">
            <tr>
                <th style="width: 30px;">I. </th>
                <th>Dasar Pelaksanaan</th>
            </tr>
            <tr>
                <td></td>
                <td style=" text-align: justify;" colspan="2">{{$stPegawaiItem->dasar_surat ?? '-'}}</td>
            </tr>
            <tr>
                <th>II. </th>
                <th>Maksud dan Tujuan</th>
            </tr>
            <tr>
                <td></td>
                <td style=" text-align: justify;">{{$stPegawaiItem->maksud_tujuan ?? '-'}}</td>
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
                    @if ($stPegawaiItem->tgl_kegiatan != $stPegawaiItem->tgl_akhir_kegiatan)
                    {{ Carbon\carbon::parse($stPegawaiItem->tgl_kegiatan)->translatedFormat('l') }} - {{
                    Carbon\carbon::parse($stPegawaiItem->tgl_akhir_kegiatan)->translatedFormat('l') }}/ {{
                    Carbon\carbon::parse($stPegawaiItem->tgl_kegiatan)->translatedFormat('d-m-Y') }} s.d. {{
                    Carbon\carbon::parse($stPegawaiItem->tgl_akhir_kegiatan)->translatedFormat('d-m-Y') }}
                    @else
                    {{ Carbon\carbon::parse($stPegawaiItem->tgl_kegiatan)->translatedFormat('l') }}/ {{
                    Carbon\carbon::parse($stPegawaiItem->tgl_akhir_kegiatan)->translatedFormat('d-m-Y') }}
                    @endif
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
            </tr>
        </table>

        <p>Demikian laporan ini disampaikan, atas perhatian Bapak/Ibu diucapkan terima kasih.</p>

        <table class="table table-sm table-borderless">
            <tr>
                <td class="center">
                    Mengetahui,<br>
                    {{$penilai->jabatan }},<br>
                    <br>
                    <br>
                    {{$penilai->nama}}<br>
                    NIP.{{$penilai->nip}}
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
                    {{-- {{ $jabatanParts[0] }},<br> --}}
                    <br>
                    <br>
                    <br>
                    {{ $firstName }} {{ $lastName1 }} {{ $lastName2 }}<br>
                    NIP.{{ $nipParts[0] }} {{ isset($nipParts[1]) ? $nipParts[1] : '' }}
                    @else
                    - @endif
                </td>
            </tr>
        </table>

        <div class="custom-hr"></div>

        <p class="right">Tanggal Cetak: {{ date('d-m-Y H:i:s') }}</p>
    </div>
</body>

</html>