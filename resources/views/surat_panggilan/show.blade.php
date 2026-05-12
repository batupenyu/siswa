<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Panggilan Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; line-height: 1.6; }
        .container { width: 90%; margin: auto; font-size: 12px; }
        /* .kop { text-align: center; border-bottom: 3px double #000; padding-bottom: 8px; margin-bottom: 16px; } */
        .kop { margin-bottom: 16px; border-bottom: none; }
        .kop img { display: block; border: none; }
        .kop h2 { margin: 0; font-size: 14px; text-transform: uppercase; }
        .kop p { margin: 0; font-size: 11px; }
        table.info { width: 100%; }
        table.info td { padding: 1px 0; vertical-align: top; }
        table.info td.label { width: 120px; white-space: nowrap; }
        table.info td.colon { width: 10px; padding: 0 6px; }
        .body-text { margin-top: 16px; text-align: justify; }
        .ttd { margin-top: 40px; }
        .ttd table { width: 100%; }
        .ttd td { text-align: center; }
        .ttd .name { margin-top: 60px; font-weight: bold; text-decoration: underline; }
    </style>
</head>
<body>
<div class="container">
    {{-- KOP --}}
    @php
    if ($kop) {
        $imagePath = storage_path('app/' . $kop->path);
    } else {
        $imagePath = public_path('images/kopSekolah.PNG');
    }
    if (file_exists($imagePath)) {
        $type = pathinfo($imagePath, PATHINFO_EXTENSION);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode(file_get_contents($imagePath));
        $imageExists = true;
    } else {
        $imageExists = false;
    }
    @endphp
    <div class="kop">
        @if($imageExists)
            <img src="{{ $base64 }}" alt="Kop Surat" style="width: 100%;">
        @endif
    </div>

    <p style="text-align:right; margin-bottom: 4px;">
        {{ $penilai->kota ?? 'Koba' }}, {{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}
    </p>

    {{-- Header surat --}}
    <table class="info" style="margin-bottom: 12px;">
        <tr>
            <td class="label">Nomor</td>
            <td class="colon">:</td>
            <td>{{ $surat->nomor_surat }}</td>
        </tr>
        <tr>
            <td class="label">Sifat</td>
            <td class="colon">:</td>
            <td>{{ $surat->sifat ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Lampiran</td>
            <td class="colon">:</td>
            <td>{{ $surat->lampiran ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Perihal</td>
            <td class="colon">:</td>
            <td><strong>{{ $surat->perihal }}</strong></td>
        </tr>
    </table>

    {{-- Tujuan --}}
    <p style="margin-bottom: 2px;">Kepada Yth.</p>
    <p style="margin: 0;">Orang Tua / Wali Siswa</p>
    <p style="margin: 0;"><strong>{{ \Illuminate\Support\Str::title($surat->nama_siswa) }}</strong></p>
    <p style="margin: 0;">Di Tempat</p>

    {{-- Pembuka --}}
    <div class="body-text">
        <p>Dengan hormat,</p>
        <p>
            Sehubungan dengan keperluan bimbingan dan konseling, kami mengundang Bapak/Ibu Orang Tua/Wali
            siswa <strong>{{ \Illuminate\Support\Str::title($surat->nama_siswa) }}</strong> untuk hadir pada:
        </p>
    </div>

    {{-- Detail pertemuan --}}
    <table class="info" style="margin: 12px 0 12px 20px;">
        <tr>
            <td class="label">Hari / Tanggal</td>
            <td class="colon">:</td>
            <td>{{ \Carbon\Carbon::parse($surat->hari_tanggal)->translatedFormat('l, d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Tempat</td>
            <td class="colon">:</td>
            <td>{{ $surat->tempat }}</td>
        </tr>
        <tr>
            <td class="label">Agenda</td>
            <td class="colon">:</td>
            <td>{{ $surat->agenda }}</td>
        </tr>
    </table>

    {{-- Penutup --}}
    <div class="body-text">
        @if($surat->paragraf_penutup)
            <p>{{ $surat->paragraf_penutup }}</p>
        @else
            <p>
                Demikian surat panggilan ini kami sampaikan. Atas perhatian dan kehadiran Bapak/Ibu,
                kami ucapkan terima kasih.
            </p>
        @endif
    </div>

    {{-- Tanda tangan --}}
    <div class="ttd">
        <table>
            <tr>
                <td style="width:50%"></td>
                <td>
                    @if($surat->an_guru_bk)
                        a.n. Guru Bimbingan Konseling,
                    @else
                        Guru Bimbingan Konseling,
                    @endif
                    <br><br><br>
                    <!-- <br><br> -->
                    <div class="name">{{ \Illuminate\Support\Str::title($surat->nama_guru_bk) }}</div>
                    @if($surat->pangkat_golongan)
                        <div>{{ $surat->pangkat_golongan }}</div>
                    @endif
                    @if($surat->nip)
                        <div>NIP. {{ $surat->nip }}</div>
                    @endif
                </td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
