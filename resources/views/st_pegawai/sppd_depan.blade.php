<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        .table-bordered {
            border: 1px solid;
            border-collapse: collapse;
            /* margin: 20px auto; */
            width: 80%;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid;
            padding: 10px;
        }

        .table-borderless {
            border: none;
            border-collapse: separate;
            /* margin: 20px auto; */
            width: 80%;
        }

        .table-borderless td,
        .table-borderless th {
            border: none;
            /* padding: 8px; */
        }

        tr {
            height: 10pt;
            line-height: 0.9;
            padding: 0;
            margin: 0;
        }
    </style>
</head>

<body>
    <table class="table-borderless" style="width: 30%; margin-left: 400px;">
        <tr>
            <td>Lembar ke </td>
            <td style="width: 300px;">:</td>
            <td style="width: 200px"></td>
        </tr>
        <tr>
            <td>Kode</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Nomor</td>
            <td>: 800/...... /SMKN1 Kb/Dindik/2025</td>
            <td></td>
        </tr>
    </table>
    <br>
    <h3 style="text-align: center;">SURAT PERINTAH PERJALANAN DINAS</h3>
    <br>
    <table class="table-bordered" style="width: 100%">
        <tr>
            <td style="width: 30px; text-align:center">1.</td>
            <td style="width: 300px;">Pejabat yang memberi perintah</td>
            @php
            $jabatanParts = explode(' ', $penilai->jabatan);
            $firstJabatan = $jabatanParts[0];
            @endphp
            <td>
                {{-- {{$penilai->jabatan}} --}}
                {{$firstJabatan}}
                {{$penilai->unitkerja}}
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top; text-align:center">2</td>
            <td>Nama/NIP Pegawai yang melaksanakan perjalanan dinas</td>
            <td>
                @if($stPegawai->pegawais->isNotEmpty())
                @php
                $firstPegawai = $stPegawai->pegawais->first();
                @endphp
                {{ $firstPegawai->nama }} / {{ $firstPegawai->nip }}
                @else
                -
                @endif
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top; text-align:center">3.</td>
            <td>
                a. Pangkat dan Golongan <br>
                b. Jabatan/instansi <br>
                c. Tingkat Biaya Perjalanan Dinas
            </td>
            <td>
                a. {{ $firstPegawai->pangkat }} <br>
                b. {{ $firstPegawai->jabatan }}/{{ $penilai->unitkerja }} <br>
                c. {{ $stPegawai->tingkat_biaya ?? '-' }}
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top; text-align:center">4.</td>
            <td style="vertical-align: top;">Maksud Perjalanan Dinas</td>
            <td style="text-align: justify;"> {{$stPegawai->nama_kegiatan}} </td>
        </tr>
        <tr>
            <td style="vertical-align: top; text-align:center">5.</td>
            <td>Alat angkutan yang dipergunakan</td>
            <td></td>
        </tr>
        <tr>
            <td style="vertical-align: top; text-align:center">6.</td>
            <td>
                a. Tempat kedudukan <br>
                b. Tempat kedudukan lanjutan <br>
                c. Tempat tujuan
            </td>
            <td>
                a. <br>
                b. <br>
                c.
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top; text-align:center">7.</td>
            <td>
                a. Lamanya perjalanan dinas <br>
                b. Tanggal Berangkat <br>
                c. Tanggal harus kembali/tiba di <br>&nbsp;&nbsp;&nbsp; tempat baru
            </td>
            <td style="vertical-align:top">
                a. {{ \Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays(\Carbon\Carbon::parse($stPegawai->tgl_akhir)) + 1 }} ({{ \Riskihajar\Terbilang\Facades\Terbilang::make(\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays(\Carbon\Carbon::parse($stPegawai->tgl_akhir)) + 1) }}) hari<br>
                b. {{Carbon\Carbon::Parse($stPegawai->tgl_awal)->translatedFormat('d F Y')}} <br>
                c.
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top; text-align:center">8.</td>
            <td>Pengikut : Nama</td>
            <td>Tanggal lahir &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Keterangan</td>
        </tr>

        @php
        $pegawaisAfterFirst = $stPegawai->pegawais->skip(1);
        @endphp
        @if($pegawaisAfterFirst->isNotEmpty())
        <tr>
            <td></td>
            <td>
                @foreach($pegawaisAfterFirst as $pegawai)
                {{ $loop->iteration }}. {{ $pegawai->nama }} <br>
                @endforeach
            </td>
            <td></td>
        </tr>
        @endif
        <tr>
            <td style="vertical-align: top; text-align:center">9.</td>
            <td>
                Pembebanan Anggaran <br>
                a. Instansi <br>
                b. Akun
            </td>
            <td>
                a. {{ $penilai->unitkerja }} <br>
                b. {{$stPegawai->korek}} <br>
            </td>
        </tr>
        <tr>
            <td style="vertical-align: top; text-align:center">10.</td>
            <td style="vertical-align: top">Keterangan lain-lain</td>
            <td>Surat Tugas Nomor : 800/........./SMKN 1
                Kb/Dindik/{{Carbon\Carbon::Parse($stPegawai->tgl_kegiatan)->translatedFormat('Y')}}
                tanggal {{Carbon\Carbon::Parse($stPegawai->tgl_kegiatan)->translatedFormat('d F Y')}}
            </td>
        </tr>
    </table>
    <p style="text-align: left;padding-left:470px; font-size: 11pt; margin-top: 20px;">
        Dikeluarkan di : {{$stPegawai->tempat_ditetapkan}} <br>
        tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{Carbon\Carbon::Parse($stPegawai->tgl_ditetapkan)->translatedFormat('d F Y')}} <br>

    </p>
    <p style="text-align: center;padding-left:400px; font-size: 11pt; margin-top: 20px;">
        {{-- {{$penilai->jabatan}} --}}
        {{$firstJabatan}}
        {{$penilai->unitkerja}}
        <br>
        <br>
        <br>
        <br>
        <span style="text-transform: uppercase; font-weight: bold;">{{ $penilai->nama }}</span>
        <br>
        NIP. {{ $penilai->nip }}
    </p>
</body>

</html>