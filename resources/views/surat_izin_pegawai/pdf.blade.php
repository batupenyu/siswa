<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            /* padding-top: 1cm; */
            padding-right: 20px;
            padding-bottom: 20px;
            padding-left: 20px;
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

        .title {
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }

        .underline {
            text-decoration: underline;
        }

        .table-info {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table-info td {
            padding: 5px;
            vertical-align: top;
        }

        .table-detail {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table-detail td {
            padding: 5px;
            /* border: 1px solid #000; */
        }

        .signature {
            margin-top: 50px;
        }

        .signature-table {
            width: 100%;
        }

        .signature-table td {
            width: 50%;
            text-align: center;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            text-align: center;
        }

        /* Watermark styles */
        .watermark-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
            display: flex;
            flex-wrap: wrap;
            align-content: space-around;
            opacity: 0.0;
            overflow: hidden;
        }

        .watermark {
            font-size: 10pt;
            color: rgba(0, 0, 0, 0.3);
            font-weight: 600;
            transform: rotate(-30deg);
            position: relative;
            margin: 2rem 3rem;
            user-select: none;
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <div class="watermark-container">
        @for ($i = 0; $i < 30; $i++) <div class="watermark">{{ $suratIzinPegawai->pegawai->nip ?? '' }}</div>
    @endfor
    </div>
    <div class="header">
        @if($headerIconImage)
        <img src="{{ public_path('storage/header_icons/' . $headerIconImage->filename) }}" alt="Icon">
        @else
        <img src="{{ public_path('images/icon.png') }}" alt="Kop Surat">
        @endif
        {{-- <div>
            <div>PEMERINTAH PROVINSI KEPULAUAN BANGKA BELITUNG</div>
            <div>DINAS PENDIDIKAN</div>
            <div>UNIT PELAKSANA TEKNIS DINAS PENDIDIKAN</div>
            <div>SMK NEGERI 1 KOBA</div>
            <div>Jalan Raya Koba Km. 42, Desa Penyak, Kecamatan Koba, Kabupaten Bangka Tengah,</div>
            <div>Provinsi Kepulauan Bangka Belitung, 33681</div>
            <div>Laman: https://www.smknegeri1koba.sch.id/ Pos-el: smk1koba@yahoo.com</div>
        </div> --}}
    </div>

    {{-- Removed the horizontal line on top of the page as per user request --}}
    {{--
    <hr> --}}

    <div class="title">SURAT KETERANGAN<br>KETERLAMBATAN / MENINGGALKAN SEKOLAH PADA JAM KERJA</div>
    <br>
    <div>&nbsp;Yang bertanda tangan dibawah ini :</div>
    <br>
    <table class="table-info ">
        <tr>
            <td width="30%">Nama</td>
            <td width="5%">:</td>
            <td>{{ $suratIzinPegawai->pegawai->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>:</td>
            <td>{{ $suratIzinPegawai->pegawai->nip ?? '-' }}</td>
        </tr>
        <tr>
            <td>Unit Kerja</td>
            <td>:</td>
            <td>
                {{-- {{ $suratIzinPegawai->pegawai->unit_kerja ?? '-' }} --}}
                {{ $penilai->unitkerja ??'-'}}
            </td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $suratIzinPegawai->pegawai->jabatan ?? '-' }}</td>
        </tr>
    </table>


    <div> menerangkan
        @if($suratIzinPegawai->status == 'keterlambatan')
        keterlambatan/<del>meninggalkan</del> sekolah pada:
        @else
        <del>keterlambatan</del>/meninggalkan sekolah pada:
        @endif
    </div>

    <table class="table-detail">
        <tr>
            <td width="30%">Hari / Tanggal</td>
            <td width="5%">:</td>
            <td>{{ \Carbon\Carbon::parse($suratIzinPegawai->tanggal)->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
            </td>
        </tr>
        <tr>
            <td>Jam</td>
            <td>:</td>
            <td>{{ $suratIzinPegawai->jam }} .WIB</td>
        </tr>
        <tr>
            <td>Keperluan</td>
            <td>:</td>
            <td>
                @if($suratIzinPegawai->keperluan == 'Dinas')
                Dinas/<del>Pribadi</del>
                @else
                <del>Dinas</del>/Pribadi @endif
            </td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td>{{ $suratIzinPegawai->keterangan }}</td>
        </tr>
    </table>

    <div>Demikian surat keterangan ini dibuat, atas perhatian dan persetujuan Bapak/Ibu diucapkan terima kasih.</div>

    <div class="signature">
        <table class="signature-table">
            <tr>
                <td>Mengetahui/Menyetujui,<br>{{$penilai->jabatan ?? ''}}</td>
                <td>Koba, {{ \Carbon\Carbon::parse($suratIzinPegawai->tanggal)->locale('id')->isoFormat('DD MMMM
                    YYYY') }}<br>Yang Bersangkutan,</td>
            </tr>
            <tr>
                <td><br><br><br>{{$penilai->nama ?? ''}}<br>NIP.{{$penilai->nip ?? ''}}</td>
                <td><br><br><br>{{ $suratIzinPegawai->pegawai->nama ?? '-' }}<br>NIP.{{
                    $suratIzinPegawai->pegawai->nip ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <div style="text-align: left" class="footer">*) Coret salah satu</div>
</body>

</html>