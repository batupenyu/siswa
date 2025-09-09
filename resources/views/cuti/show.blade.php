<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Permintaan dan Pemberian Cuti</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            /* margin-top: 1cm; */
            margin-right: 10px;
            margin-bottom: 10px;
            margin-left: 10px;
            font-size: 12px;
            page-break-after: avoid;
            page-break-before: avoid;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            page-break-after: avoid;
            page-break-before: avoid;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .form-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-number {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            page-break-after: avoid;
            page-break-before: avoid;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 2px;
            text-align: left;
        }

        .section-title {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        .signature {
            text-align: right;
            margin-top: 50px;
        }

        .approval-section {
            margin-top: 15px;
            page-break-after: avoid;
            page-break-before: avoid;
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .approval-options {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .approval-option {
            width: 23%;
            text-align: center;
        }

        .approver-info {
            margin-top: 50px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="form-title">FORMULIR PERMINTAAN DAN PEMBERIAN CUTI</div>
        <div class="form-number">No.853/....../2025</div>
    </div>

    <table>
        <tr class="section-title">
            <td colspan="5">I. DATA PEGAWAI</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>{{ $cuti->pegawai->nama ?? '-' }}</td>
            <td>NIP / Gol.</td>
            <td colspan="2">{{ $cuti->pegawai->nip ?? '-' }} / {{ $cuti->pegawai->pangkat ?? '-' }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>{{ $cuti->pegawai->jabatan ?? '-' }}</td>
            <td>Masa Kerja</td>
            <td colspan="2">{{ $cuti->pegawai->masa_kerja ?? '-' }}</td>
        </tr>
        <tr>
            <td>Unit Kerja</td>
            <td>{{ $cuti->pegawai->unit_kerja ?? '-' }}</td>
            <td colspan="3"></td>
        </tr>
    </table>

    <table>
        <tr class="section-title">
            <td colspan="4">II. JENIS CUTI YANG DIAMBIL</td>
        </tr>
        <tr>
            <td>1. Cuti Tahunan</td>
            <td style="width: 100px; text-align:center">{{ $cuti->jenis_cuti == 'tahunan' ? 'Ya' : '-' }}</td>
            <td>2. Cuti Besar</td>
            <td style="width: 100px; text-align:center">{{ $cuti->jenis_cuti == 'besar' ? 'Ya' : '-' }}</td>
        </tr>
        <tr>
            <td>3. Cuti Sakit</td>
            <td style="text-align: center;">{{ $cuti->jenis_cuti == 'sakit' ? 'Ya' : '-' }}</td>
            <td>4. Cuti Melahirkan</td>
            <td style="text-align: center;">{{ $cuti->jenis_cuti == 'melahirkan' ? 'Ya' : '-' }}</td>
        </tr>
        <tr>
            <td>5. Cuti Karena Alasan Penting</td>
            <td style="text-align: center;">{{ $cuti->jenis_cuti == 'alasan_penting' ? 'Ya' : '-' }}</td>
            <td>6. Cuti di Luar Tanggungan</td>
            <td style="text-align: center;">{{ $cuti->jenis_cuti == 'luar_tanggungan' ? 'Ya' : '-' }}</td>
        </tr>
    </table>

    <table>
        <tr class="section-title">
            <td colspan="5">III. ALASAN CUTI</td>
        </tr>
        <tr>
            <td colspan="5">{{ $cuti->alasan }}</td>
        </tr>
    </table>

    <table>
        <tr class="section-title">
            <td colspan="6">IV. LAMANYA CUTI</td>
        </tr>
        <tr>
            <td>Selama</td>
            <td>{{ $cuti->lama_cuti }} Hari</td>
            <td>Mulai Tanggal</td>
            <td>{{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->translatedFormat('d F Y') }}</td>
            <td>s/d</td>
            <td>{{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->translatedFormat('d F Y') }}</td>
        </tr>
    </table>

    <table>
        <tr class="section-title">
            <td colspan="5">V. CATATAN CUTI</td>
        </tr>
        <tr>
            <td colspan="2">1. CUTI TAHUNAN</td>
            <td>{{ $cuti->jenis_cuti == 'tahunan' ? 'Ya' : '-' }}</td>
            <td>2. CUTI BESAR</td>
            <td style="width: 100px;">-</td>
        </tr>
        <tr>
            <td>Tahun</td>
            <td>Sisa</td>
            <td>Keterangan</td>
            <td>3. CUTI SAKIT</td>
            <td>{{ $cuti->jenis_cuti == 'sakit' ? 'Ya' : '-' }}</td>
        </tr>
        <tr>
            <td>N-2</td>
            <td>{{ $cuti->sisaCuti->sisa_tahun_n_2 ?? 0 }}</td>
            <td>Sisa:</td>
            <td>4. CUTI MELAHIRKAN</td>
            <td>{{ $cuti->jenis_cuti == 'melahirkan' ? 'Ya' : '-' }}</td>
        </tr>
        <tr>
            <td>N-1</td>
            <td>{{ $cuti->sisaCuti->sisa_tahun_n_1 ?? 0 }}</td>
            <td>Sisa:</td>
            <td>5. CUTI KARENA ALASAN PENTING</td>
            <td>{{ $cuti->jenis_cuti == 'alasan_penting' ? 'Ya' : '-' }}</td>
        </tr>
        <tr>
            <td>N</td>
            <td>{{ $cuti->sisaCuti->sisa_tahun_n ?? 0 }}</td>
            <td>Sisa:</td>
            <td>6. CUTI DILUAR TANGGUNGAN NEGARA</td>
            <td>{{ $cuti->jenis_cuti == 'luar_tanggungan' ? 'Ya' : '-' }}</td>
        </tr>
    </table>

    <table>
        <tr class="section-title">
            <td colspan="4">VI. ALAMAT SELAMA MENJALANKAN CUTI</td>
        </tr>
        <tr>
            <td colspan="2">Telepon</td>
            <td colspan="2">{{ $cuti->telepon }}</td>
        </tr>
        <tr>
            <td style="vertical-align: top;" colspan="3" rowspan="3">{{ $cuti->alamat_selama_cuti }}</td>
            <td style="text-align: center;">Hormat Saya
                <br>
                <br>
                <br>
                <br>
                <br>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">{{ $cuti->pegawai->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td style="text-align: center;">NIP : {{ $cuti->pegawai->nip ?? '-' }}</td>
        </tr>
    </table>

    <div class="approval-section">
        <table>
            <tr class="section-title">
                <td colspan="4">VII. PERTIMBANGAN ATASAN LANGSUNG***</td>
            </tr>
            <tr>
                <td class="approval-option" style="width: auto;">{{ $cuti->status_penilai == 'disetujui' ? 'DISETUJUI' : '' }}</td>
                <td class="approval-option">{{ $cuti->status_penilai == 'perubahan' ? 'PERUBAHAN***' : '' }}</td>
                <td class="approval-option">{{ $cuti->status_penilai == 'ditangguhkan' ? 'DITANGGUHKAN****' : '' }}</td>
                <td class="approval-option">{{ $cuti->status_penilai == 'tidak_disetujui' ? 'TIDAK DISETUJUI****' : '' }}</td>
            </tr>
            <tr>
                <td colspan="4" style="height: 16px;"></td>
            </tr>
            <tr>
                <td style="text-align: center; padding-left:355px" colspan="4" class="approver-info">
                    Kepala Cabang Dinas Pendidikan Wilayah I<br><br><br><br>
                    {{ $cuti->penilai->nama ?? '-' }}<br>
                    NIP. {{ $cuti->penilai->nip ?? '-' }}
                </td>
            </tr>
        </table>
    </div>

    <div class="approval-section">
        <table>
            <tr class="section-title">
                <td colspan="4">VIII. KEPUTUSAN PEJABAT YANG BERWENANG MEMBERIKAN CUTI***</td>
            </tr>
            <tr>
                <td class="approval-option" style="width: auto;">{{ $cuti->status_kpa == 'disetujui' ? 'DISETUJUI' : '' }}</td>
                <td class="approval-option">{{ $cuti->status_kpa == 'perubahan' ? 'PERUBAHAN***' : '' }}</td>
                <td class="approval-option">{{ $cuti->status_kpa == 'ditangguhkan' ? 'DITANGGUHKAN****' : '' }}</td>
                <td class="approval-option">{{ $cuti->status_kpa == 'tidak_disetujui' ? 'TIDAK DISETUJUI****' : '' }}</td>
            </tr>
            <tr>
                <td colspan="4" style="height: 16px;"></td>
            </tr>
            <tr>
                <td style="text-align: center; padding-left:355px" colspan="4" class="approver-info">
                    Kepala cabang Wilayah 1 Dinas Pendidikan <br> Provinsi Kep. Bangka Belitung<br><br><br><br>
                    {{ $cuti->kpa->nama ?? '-' }}<br>
                    NIP. {{ $cuti->kpa->nip ?? '-' }}
                </td>
            </tr>
        </table>
    </div>
</body>

</html>