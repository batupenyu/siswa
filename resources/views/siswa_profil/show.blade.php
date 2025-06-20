<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Formulir Pendaftaran PPDB SMKN 1 Koba</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }

        .container {
            width: 90%;
            margin: auto;
        }

        h2 {
            text-align: center;
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 5px 0;
        }

        .signature {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }

        .sign-box {
            width: 30%;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>FORMULIR PENDAFTARAN<br>SMK NEGERI 1 KOBA TAHUN PELAJARAN 2025/2026</h2>
        <br>
        <br>
        <h3>A. KETERANGAN PRIBADI</h3>
        <table>
            <tr>
                <td>1. Nama Lengkap (sesuai STTB SD/SMP)</td>
                <td style="width: 350px">: {{ $siswaProfil->siswa->nama ?? '' }}</td>
            </tr>
            <tr>
                <td>2. Tempat dan Tanggal Lahir</td>
                <td>: {{ $siswaProfil->tempat_tanggal_lahir ?? '' }}</td>
            </tr>
            <tr>
                <td>3. Jenis Kelamin</td>
                <td>: {{ $siswaProfil->jenis_kelamin ?? '' }}</td>
            </tr>
            <tr>
                <td>4. Agama / Kepercayaan</td>
                <td>: {{ ucfirst($siswaProfil->agama) ?? '' }}</td>
            </tr>
            <tr>
                <td>5. Kewarganegaraan</td>
                <td>: {{ $siswaProfil->kewarganegaraan ?? '' }}</td>
            </tr>
            <tr>
                <td>6. Anak ke-</td>
                <td>: {{ $siswaProfil->anak_ke_berapa ?? '' }}</td>
            </tr>
            <tr>
                <td>7. Jumlah Saudara</td>
                <td>: a) Kandung : {{ $siswaProfil->jumlah_saudara_kandung ?? '' }} b) Tiri : {{
                    $siswaProfil->jumlah_saudara_tiri ?? '' }} c) Angkat : {{ $siswaProfil->jumlah_saudara_angkat ?? ''
                    }}</td>
            </tr>
            <tr>
                <td>8. Bahasa Sehari-hari di Rumah</td>
                <td>: {{ $siswaProfil->bahasa_sehari_hari_di_rumah ?? '' }}</td>
            </tr>
        </table>

        <h3>B. KETERANGAN TEMPAT TINGGAL</h3>
        <table>
            <tr>
                <td>1. Alamat Lengkap</td>
                <td style="width: 350px">: {{ $siswaProfil->alamat ?? '' }}</td>
            </tr>
            <tr>
                <td>2. Nomor Telp / HP</td>
                <td>: {{ $siswaProfil->nomor_telepon ?? '' }}</td>
            </tr>
            <tr>
                <td>3. Bertempat Tinggal (coret yang tidak perlu)</td>
                <td>: {{ $siswaProfil->tinggal_dengan ?? '' }}</td>
            </tr>
            <tr>
                <td>4. Jarak dari Tempat Tinggal ke Sekolah</td>
                <td>: {{ $siswaProfil->jarak_tempat_tinggal_ke_sekolah ?? '' }}</td>
            </tr>
            <tr>
                <td>5. Alat Transportasi ke Sekolah</td>
                <td>:
                    <!-- No field found for this, keep empty or add if available -->
                </td>
            </tr>
        </table>

        <!-- Add other sections similarly -->
        <!-- C. KETERANGAN KESEHATAN -->
        <h3>C. KETERANGAN KESEHATAN</h3>
        <table>
            <tr>
                <td>1. Berat Badan dan Tinggi Badan</td>
                <td style="width: 350px">: {{ $siswaProfil->tinggi_dan_berat_badan ?? '' }}</td>
            </tr>
            <tr>
                <td>2. Golongan Darah</td>
                <td>: {{ $siswaProfil->golongan_darah ?? '' }}</td>
            </tr>
            <tr>
                <td>3. Penyakit yang Pernah Diderita</td>
                <td>: {{ $siswaProfil->penyakit_yang_pernah_diderita ?? '' }}</td>
            </tr>
            <tr>
                <td>*Program Keahlian yang Dipilih: </td>
                <td>: {{ $siswaProfil->kompetensi_keahlian ?? '' }}</td>
            </tr>
        </table>

        <!-- Continue for D, E, F, etc. -->



        <br>
        <br>

        <table>
            <tr style="text-align: center;">
                <td style="width: 50%;">
                    Orang Tua / Wali,<br><br><br><br>
                    ( ........................................... )
                </td>
                <td>
                    Koba ............................ 2025/2026<br>
                    Calon Peserta Didik,,<br><br><br><br>
                    ( ........................................... )
                </td>
            </tr>
        </table>

        <div style="page-break-after: always;"></div>

        <h3 style="text-align: center;">SURAT PERNYATAAN</h3>
        <br>
        <br>
        <p style="padding-left: 0.75cm">Saya yang bertanda tangan di bawah ini:</p>
        <table style="padding-left: 0.75cm">
            <tr>
                <td>Nama Calon Siswa</td>
                <td>:
                    {{-- {{ $siswaProfil->siswa->nama ?? '' }} --}}
                    {{ $siswaProfil->nama_panggilan ?? '' }}
                </td>
            </tr>
            <tr>
                <td>Tempat dan Tanggal Lahir</td>
                <td>: {{ $siswaProfil->tempat_tanggal_lahir ?? '' }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: {{ $siswaProfil->jenis_kelamin ?? '' }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>: {{ ucfirst($siswaProfil->agama) ?? '' }}</td>
            </tr>
            <tr>
                <td>Asal Sekolah</td>
                <td>: {{ $siswaProfil->dari_sekolah ?? '' }}</td>
            </tr>
            <tr>
                <td>Nama Orang Tua / Wali</td>
                <td>:
                    <!-- No field found for this, keep empty or add if available -->
                </td>
            </tr>
            <tr>
                <td>Alamat Rumah</td>
                <td>: {{ $siswaProfil->alamat ?? '' }}</td>
            </tr>
            <tr>
                <td>Nomor Telp / HP</td>
                <td>: {{ $siswaProfil->nomor_telepon ?? '' }}</td>
            </tr>
        </table>

        <ol style="margin-left: 0px; text-align: justify;">
            <li>Saya dengan sadar dan tanpa paksaan dari pihak manapun bersungguh-sungguh untuk mendaftar sebagai
                Peserta
                Didik SMK Negeri 1 Koba Tahun Pelajaran 2025/2026 serta mengikuti dan mentaati setiap prosedur
                pendaftaran
                sesuai Petunjuk Teknis.</li>
            <li>Setelah dinyatakan diterima, saya akan taati Tata Tertib dan bersedia menerima sanksi atau dikembalikan
                kepada orang tua jika melanggar aturan.</li>
            <li>Orang tua/wali bersedia datang ke sekolah jika diundang.</li>
        </ol>

        <br>
        <br>

        <table>
            <tr style="text-align: center;">
                <td style="width: 50%;">
                    Orang Tua / Wali,<br><br><br><br><br>
                    ( ........................................... )
                </td>
                <td>
                    Calon Siswa yang menyatakan,<br><br><br>
                    <small>Materai 10.000</small><br><br>
                    ( ........................................... )
                </td>
            </tr>
        </table>

    </div>
</body>

</html>