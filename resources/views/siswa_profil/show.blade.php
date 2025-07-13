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
            padding: 0px 0;
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
        <h2>FORMULIR PENDAFTARAN<br><u>SMK NEGERI 1 KOBA TAHUN PELAJARAN 2025/2026</u></h2>
        <br>
        @php
        function tryParseDate($dateStr) {
        if (empty($dateStr) || $dateStr == '-') {
        return '';
        }
        $formats = ['Y-m-d', 'd-m-Y', 'd m Y'];
        foreach ($formats as $format) {
        $date = \DateTime::createFromFormat($format, $dateStr);
        if ($date && $date->format($format) === $dateStr) {
        return \Carbon\Carbon::instance($date)->translatedFormat('d F Y');
        }
        }
        // fallback try parse with Carbon directly
        try {
        return \Carbon\Carbon::parse($dateStr)->translatedFormat('d F Y');
        } catch (\Exception $e) {
        return '';
        }
        }
        @endphp

        <h3>A. KETERANGAN PRIBADI</h3>
        <table>
            <tr>
                <td>1. Nama Lengkap (sesuai STTB SD/SMP)</td>
                <td style="width: 350px">: {{ \Illuminate\Support\Str::title($siswaProfil->nama_lengkap ?? '') }}</td>
            </tr>
            <tr>
                <td>2. Tempat dan Tanggal Lahir</td>
                <td>: {{ \Illuminate\Support\Str::title($siswaProfil->tempat_lahir ?? '') }}/ {{
                    tryParseDate($siswaProfil->tanggal_lahir ?? '') }}</td>
            </tr>
            <tr>
                <td>3. Jenis Kelamin</td>
                <td>:
                    @if ($siswaProfil->jenis_kelamin == 'L')
                    Laki-laki / <del>Perempuan</del>
                    @elseif ($siswaProfil->jenis_kelamin == 'P')
                    <del>Laki-laki</del> / Perempuan
                    @else
                    @endif
                </td>
            </tr>
            <tr>
                <td>4. Agama / Kepercayaan</td>
                <td>: {{ \Illuminate\Support\Str::title($siswaProfil->agama ?? '') }}</td>
            </tr>
            <tr>
                <td>5. Kewarganegaraan</td>
                <td>: {{ \Illuminate\Support\Str::upper($siswaProfil->kewarganegaraan ?? '') }}</td>
            </tr>
            <tr>
                <td>6. Anak ke-</td>
                <td>: {{ isset($siswaProfil->anak_ke_berapa) ? number_format($siswaProfil->anak_ke_berapa, 0, ',', '.')
                    : '' }}</td>
            </tr>
            <tr>
                <td>7. Jumlah Saudara</td>
                <td>: a) Kandung : {{ isset($siswaProfil->jumlah_saudara_kandung) ?
                    number_format($siswaProfil->jumlah_saudara_kandung, 0, ',', '.') : '....' }} b) Tiri : {{
                    isset($siswaProfil->jumlah_saudara_tiri) ? number_format($siswaProfil->jumlah_saudara_tiri, 0, ',',
                    '.') : '....' }} c) Angkat : {{ isset($siswaProfil->jumlah_saudara_angkat) ?
                    number_format($siswaProfil->jumlah_saudara_angkat, 0, ',', '.') : '....' }}</td>
            </tr>
            <tr>
                <td>8. Bahasa Sehari-hari di Rumah</td>
                <td>: {{ \Illuminate\Support\Str::title($siswaProfil->bahasa_sehari_hari_di_rumah ?? '') }}</td>
            </tr>
        </table>

        <h3>B. KETERANGAN TEMPAT TINGGAL</h3>
        <table>
            <tr>
                <td>1. Alamat Lengkap</td>
                <td style="width: 350px">: {{ \Illuminate\Support\Str::title($siswaProfil->alamat ?? '') }}</td>
            </tr>
            <tr>
                <td>2. Nomor Telp / HP</td>
                <td>: {{ $siswaProfil->nomor_telepon ?? '' }}</td>
            </tr>
            <tr>
                <td>3. Bertempat Tinggal (coret yang tidak perlu)</td>
                <td>:
                    @if($siswaProfil->tinggal_dengan == 'orang tua')
                    Pada Orang Tua /<del>Menumpang</del>/ <del>Di Asrama</del>/ <del>Kost</del>
                    @elseif($siswaProfil->tinggal_dengan == 'menumpang')
                    <del>Pada Orang Tua</del>/Menumpang/ <del>Di Asrama</del> / <del>Kost</del>
                    @elseif($siswaProfil->tinggal_dengan == 'di asrama')
                    <del>Pada Orang Tua</del>/ <del>Menumpang</del>/Di Asrama/ <del>Kost</del>
                    @elseif($siswaProfil->tinggal_dengan == 'kost')
                    <del>Pada Orang Tua</del>/ <del>Menumpang</del>/ <del>Di Asrama</del>/Kost
                    @else

                    @endif
                </td>
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
                <td style="width: 350px">: {{ $siswaProfil->berat_badan ?? '...' }} kg, {{$siswaProfil->tinggi_badan ??
                    '...'}} cm</td>
            </tr>
            <tr>
                <td>2. Golongan Darah</td>
                <td>: {{ \Illuminate\Support\Str::title($siswaProfil->golongan_darah ?? '') }}</td>
            </tr>
            <tr>
                <td>3. Penyakit yang Pernah Diderita</td>
                <td>: {{ \Illuminate\Support\Str::title($siswaProfil->penyakit_yang_pernah_diderita ?? '') }}</td>
            </tr>
            <tr>
                <td>*Program Keahlian yang Dipilih: </td>
                <td>: {{ \Illuminate\Support\Str::title($siswaProfil->jurusan ?? '') }}</td>
            </tr>
        </table>

        <!-- D. KETERANGAN PENDIDIKAN SEBELUMNYA -->
        <h3>D. KETERANGAN PENDIDIKAN SEBELUMNYA</h3>
        <table>
            <tr>
                <td>1. Asal Sekolah Dasar</td>
                <td style="width: 350px">: {{ \Illuminate\Support\Str::upper($siswaProfil->asal_SD ?? '') }}</td>
            </tr>
            <tr>
                <td style="padding-left: 12px;">a. Tanggal dan Nomor STTB/Ijazah</td>
                <td>: {{ $siswaProfil->nomor_sttb_SD ?? '' }}/ {{ tryParseDate($siswaProfil->tanggal_sttb_SD ?? '') }}
                </td>
            </tr>
            <tr>
                <td style="padding-left: 12px;">b . Lama Belajar</td>
                <td>: {{ $siswaProfil->lama_belajar_SD ?? '' }}</td>
            </tr>
            <tr>
                <td>2. Asal Sekolah Lanjutan Pertama</td>
                <td>: {{ \Illuminate\Support\Str::upper($siswaProfil->asal_SMP ?? '') }}</td>
            </tr>
            <tr>
                <td style="padding-left: 12px;">a. Tanggal dan Nomor STTB/Ijazah</td>
                <td>: {{ $siswaProfil->nomor_sttb_SMP ?? '' }} / {{ tryParseDate($siswaProfil->tanggal_sttb_SMP ?? '')
                    }}</td>
            </tr>
            <tr>
                <td style="padding-left: 12px;">b. Lama Belajar</td>
                <td>: {{ $siswaProfil->lama_belajar_SMP ?? '' }}</td>
            </tr>
        </table>

        <!-- E. KETERANGAN ORANG TUA / WALI -->
        <h3>E. KETERANGAN ORANG TUA / WALI</h3>
        <table>
            <tr>
                <td>1. Ayah</td>
                <td style="width: 350px"></td>
            </tr>
            <tr>
                <td style="padding-left: 12px;">a. Nama Ayah</td>
                <td>: {{ \Illuminate\Support\Str::title($siswaProfil->nama_ayah ?? '') }}</td>
            </tr>
            <tr>
                <td style="padding-left: 12px;">b. Tempat dan Tanggal Lahir</td>
                <td>: {{ \Illuminate\Support\Str::title($siswaProfil->tempat_lahir_ayah ?? '') }}/ {{
                    \Carbon\Carbon::parse($siswaProfil->tanggal_lahir_ayah ?? '')->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td style="padding-left: 12px;">c. Alamat / Tempat Tinggal</td>
                <td>: {{ \Illuminate\Support\Str::title($siswaProfil->alamat_ayah ?? '') }}</td>
            </tr>
            <tr>
                <td style="padding-left: 12px;">d. Nomor Telp / HP</td>
                <td>: {{ $siswaProfil->nomor_telepon_ayah ?? '' }}</td>
            </tr>
            <tr>
                <td style="padding-left: 12px;">e. Pekerjaan</td>
                <td>: {{ \Illuminate\Support\Str::title($siswaProfil->pekerjaan_ayah ?? '') }}</td>
            </tr>
            <tr>
                <td style="padding-left: 12px;">f. Penghasilan Perbulan</td>
                <td>: {{ isset($siswaProfil->penghasilan_perbulan_ayah) &&
                    is_numeric($siswaProfil->penghasilan_perbulan_ayah) ?
                    number_format($siswaProfil->penghasilan_perbulan_ayah, 0, ',', '.') : '' }}</td>
            </tr>
            <tr>
                <td style="padding-left: 12px;">g. Pendidikan</td>
                <td>: {{ \Illuminate\Support\Str::upper($siswaProfil->pendidikan_ayah ?? '') }}</td>
            </tr>
            <tr>
                <td style="padding-left: 12px;">h. Kewarganegaraan</td>
                <td>: {{ \Illuminate\Support\Str::upper($siswaProfil->kewarganegaraan_ayah ?? '') }}</td>
            </tr>
        </table>
        <div style="page-break-after: always;"></div>
        <br>
        <br>
        <br>
        <table>
            <tr>
                <td>2. Ibu</td>
                <td style="width: 350px"></td>
            </tr>
            <tr>
                <td style="padding-left: 12px">a. Nama Ibu</td>
                <td>: {{ \Illuminate\Support\Str::title($siswaProfil->nama_ibu ?? '') }}</td>
            </tr>
            <tr>
                <td style="padding-left: 12px;">b. Tempat dan Tanggal Lahir</td>
                <td>: {{ \Illuminate\Support\Str::title($siswaProfil->tempat_lahir_ibu ?? '') }}/ {{
                    \Carbon\Carbon::parse($siswaProfil->tanggal_lahir_ibu ?? '')->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td style="padding-left: 12px;">c. Alamat / Tempat Tinggal</td>
                <td>: {{ \Illuminate\Support\Str::title($siswaProfil->alamat_ibu ?? '') }}</td>
            </tr>
            <tr>
                <td style="padding-left: 12px;">d. Nomor Telp / HP</td>
                <td>: {{ $siswaProfil->nomor_telepon_ibu ?? '' }}</td>
            </tr>
            <tr>
                <td style="padding-left: 12px;">e. Pekerjaan</td>
                <td>: {{ \Illuminate\Support\Str::title($siswaProfil->pekerjaan_ibu ?? '') }}</td>
            </tr>
            <tr>
                <td style="padding-left: 12px;">f. Penghasilan Perbulan</td>
                <td>: {{ isset($siswaProfil->penghasilan_perbulan_ibu) &&
                    is_numeric($siswaProfil->penghasilan_perbulan_ibu) ?
                    number_format($siswaProfil->penghasilan_perbulan_ibu, 0, ',', '.') : '' }}</td>
            </tr>
            <tr>
                <td style="padding-left: 12px;">g. Pendidikan</td>
                <td>: {{ \Illuminate\Support\Str::upper($siswaProfil->pendidikan_ibu ?? '') }}</td>
            </tr>
            <tr>
                <td style="padding-left: 12px;">h. Kewarganegaraan</td>
                <td>: {{ \Illuminate\Support\Str::upper($siswaProfil->kewarganegaraan_ibu ?? '') }}</td>
            </tr>

            <tr>
                <td>3. Nama Wali</td>
                <td>: {{ \Illuminate\Support\Str::title($siswaProfil->nama_wali ?? '') }}</td>
            </tr>
            <tr>
                <td>4. Alamat / Tempat Tinggal Wali</td>
            <tr>
                <td>5. Nomor Telp / HP Wali</td>
                <td>: {{ $siswaProfil->nomor_telepon_wali ?? '' }}</td>
            </tr>
        </table>

        <!-- F. KETERANGAN INTEREGENSI DAN KEGEMARAN -->
        <h3>F. KETERANGAN INTEREGENSI DAN KEGEMARAN</h3>
        <table>
            <tr>
                <td>1. Olahraga / Kesenian</td>
                <td style="width: 350px">: {{ \Illuminate\Support\Str::title($siswaProfil->kegemaran_olah_raga ?? '') }}
                </td>
            </tr>
            <tr>
                <td>2. Kemasyarakatan / Organisasi</td>
                <td>: {{ \Illuminate\Support\Str::title($siswaProfil->kegemaran_kemasyarakatan ?? '') }}</td>
            </tr>
            <tr>
                <td>3. Hasta Karya</td>
                <td>: {{ \Illuminate\Support\Str::title($siswaProfil->kegemaran_hasta_karya ?? '') }}</td>
            </tr>
            <br>
            <tr>
                <td>* Jurusan </td>
                <td>: {{ $siswaProfil->jurusan ?? '' }}</td>
            </tr>
        </table>

        <br>
        <br>

        <table>
            <tr style="text-align: center;">
                <td style="width: 50%;">
                    <br>
                    Orang Tua / Wali,<br><br><br><br><br>
                    @if(!empty($siswaProfil->nama_ayah) && $siswaProfil->nama_ayah != '-' &&
                    trim($siswaProfil->nama_ayah) != '')
                    <br>({{ \Illuminate\Support\Str::title($siswaProfil->nama_ayah) }})
                    @elseif((empty($siswaProfil->nama_ayah) || $siswaProfil->nama_ayah == '-' ||
                    trim($siswaProfil->nama_ayah) == '') && !empty($siswaProfil->nama_ibu) && $siswaProfil->nama_ibu !=
                    '-' && trim($siswaProfil->nama_ibu) != '')
                    <br>({{ \Illuminate\Support\Str::title($siswaProfil->nama_ibu) }})
                    @elseif((empty($siswaProfil->nama_ayah) || $siswaProfil->nama_ayah == '-' ||
                    trim($siswaProfil->nama_ayah) == '') && (empty($siswaProfil->nama_ibu) || $siswaProfil->nama_ibu ==
                    '-' || trim($siswaProfil->nama_ibu) == '') && !empty($siswaProfil->nama_wali) &&
                    $siswaProfil->nama_wali != '-' && trim($siswaProfil->nama_wali) != '')
                    <br>({{ \Illuminate\Support\Str::title($siswaProfil->nama_wali) }})
                    @endif
                </td>
                <td>
                    Koba ............................ 2025/2026<br>
                    Calon Peserta Didik,,<br><br><br><br><br><br>
                    ( {{\Illuminate\Support\Str::title($siswaProfil->nama_lengkap)}} )
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
                <td style="width: 350px">:
                    {{ \Illuminate\Support\Str::title($siswaProfil->nama_lengkap ?? '') }}
                </td>
            </tr>
            <tr>
                <td>Tempat dan Tanggal Lahir</td>
                @php
                $ttl = $siswaProfil->tempat_tanggal_lahir ?? '';
                $formattedTtl = $ttl;
                if ($ttl) {
                // Try to split by comma to separate place and date
                $parts = explode(',', $ttl);
                if (count($parts) == 2) {
                $place = trim($parts[0]);
                $dateStr = trim($parts[1]);
                // Try to parse date in yyyy-mm-dd or dd-mm-yyyy format
                $date = \DateTime::createFromFormat('Y-m-d', $dateStr);
                if (!$date) {
                $date = \DateTime::createFromFormat('d-m-Y', $dateStr);
                }
                if ($date) {
                // Indonesian month names
                $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                'Oktober', 'November', 'Desember'];
                $day = $date->format('d');
                $monthNum = (int)$date->format('m');
                $year = $date->format('Y');
                $monthName = $months[$monthNum - 1];
                $formattedDate = $day . ' ' . $monthName . ' ' . $year;
                $formattedTtl = $place . ', ' . $formattedDate;
                }
                }
                }
                @endphp
                <td>: {{ \Illuminate\Support\Str::title($siswaProfil->tempat_lahir ?? '') }}/ {{
                    tryParseDate($siswaProfil->tanggal_lahir ?? '') }}/ {{ $formattedTtl ?? '' }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:
                    @if ($siswaProfil->jenis_kelamin == 'L')
                    Laki-laki / <del>Perempuan</del>
                    @elseif ($siswaProfil->jenis_kelamin == 'P')
                    <del>Laki-laki</del> / Perempuan
                    @else
                    @endif
                </td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>: {{ ucfirst($siswaProfil->agama) ?? '' }}</td>
            </tr>
            <tr>
                <td>Asal Sekolah</td>
                <td>: {{ \Illuminate\Support\Str::upper($siswaProfil->asal_SMP ?? '') }}</td>
            </tr>
            <tr>
                <td>Nama Orang Tua / Wali</td>
                <td>:
                    @if(!empty($siswaProfil->nama_ayah) && $siswaProfil->nama_ayah != '-' &&
                    trim($siswaProfil->nama_ayah) != '')
                    {{ \Illuminate\Support\Str::title($siswaProfil->nama_ayah) }}
                    @elseif((empty($siswaProfil->nama_ayah) || $siswaProfil->nama_ayah == '-' ||
                    trim($siswaProfil->nama_ayah) == '') && !empty($siswaProfil->nama_ibu) && $siswaProfil->nama_ibu !=
                    '-' && trim($siswaProfil->nama_ibu) != '')
                    {{ \Illuminate\Support\Str::title($siswaProfil->nama_ibu) }}
                    @elseif((empty($siswaProfil->nama_ayah) || $siswaProfil->nama_ayah == '-' ||
                    trim($siswaProfil->nama_ayah) == '') && (empty($siswaProfil->nama_ibu) || $siswaProfil->nama_ibu ==
                    '-' || trim($siswaProfil->nama_ibu) == '') && !empty($siswaProfil->nama_wali) &&
                    $siswaProfil->nama_wali != '-' && trim($siswaProfil->nama_wali) != '')
                    {{ \Illuminate\Support\Str::title($siswaProfil->nama_wali) }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Alamat Rumah</td>
                <td>: {{\Illuminate\Support\Str::title( $siswaProfil->alamat ?? '') }}</td>
            </tr>
            <tr>
                <td>Nomor Telp / HP</td>
                <td>: {{ $siswaProfil->nomor_telepon ?? '' }}</td>
            </tr>
        </table>
        <p style="padding-left: 0.75cm; text-align: justify;">
            Dengan ini menyatakan bahwa:
        </p>
        <ol style="margin-left: 0px; text-align: justify;">
            <li>Saya dengan sadar dan tanpa paksaan dari pihak manapun bersungguh-sungguh untuk mendaftar sebagai
                Peserta Didik SMK
                Negeri 1 Koba Tahun Pelajaran 2025/2026 serta mengikuti dan mentaati dengan sungguh-sungguh setiap
                prosedur pendaftaran
                di {{$penilai->unitkerja}} sesuai Petunjuk Teknis Penerimaan Peserta Didik Baru (PPDB).</li>
            <li>Setelah saya dinyatakan diterima sebagai Peserta Didik {{$penilai->unitkerja}} maka saya akan mentaati
                dan
                melaksanakan
                Tata Tertib {{$penilai->unitkerja}} yang berlaku dan bersedia menerima sanksi dan dikembalikan kepada
                Orang
                Tua /dikeluarkan
                apabila saya melanggar Tata Tertib {{$penilai->unitkerja}}.
            </li>
            <li>Orang Tua / Wali saya bersedia datang ke sekolah apabila diundang oleh pihak sekolah.</li>
        </ol>
        <p style="padding-left: 0.75cm; text-align: justify;">
            Demikian Surat Pernyataan ini saya buat dengan sebenarnya secara sadar tanpa paksaan dari pihak manapun dan
            dengan penuh
            rasa tanggungjawab.
        </p>
        <br>
        <br>

        <table>
            <tr style="text-align: center;">
                <td style="width: 50%;">
                    <br>
                    Orang Tua / Wali,<br><br><br><br><br>
                    @if(!empty($siswaProfil->nama_ayah) && $siswaProfil->nama_ayah != '-' &&
                    trim($siswaProfil->nama_ayah) != '')
                    <br>({{ $siswaProfil->nama_ayah }})
                    @elseif((empty($siswaProfil->nama_ayah) || $siswaProfil->nama_ayah == '-' ||
                    trim($siswaProfil->nama_ayah) == '') && !empty($siswaProfil->nama_ibu) && $siswaProfil->nama_ibu !=
                    '-' && trim($siswaProfil->nama_ibu) != '')
                    <br>({{ $siswaProfil->nama_ibu }})
                    @elseif((empty($siswaProfil->nama_ayah) || $siswaProfil->nama_ayah == '-' ||
                    trim($siswaProfil->nama_ayah) == '') && (empty($siswaProfil->nama_ibu) || $siswaProfil->nama_ibu ==
                    '-' || trim($siswaProfil->nama_ibu) == '') && !empty($siswaProfil->nama_wali) &&
                    $siswaProfil->nama_wali != '-' && trim($siswaProfil->nama_wali) != '')
                    <br>({{ $siswaProfil->nama_wali }})
                    @endif
                </td>
                <td>
                    Koba ............................ 2025/2026<br>
                    Calon Peserta Didik,,<br><br><br><br><br><br>
                    ( {{\Illuminate\Support\Str::title($siswaProfil->nama_lengkap)}} )
                </td>
            </tr>
        </table>