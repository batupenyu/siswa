<<<<<<< HEAD

=======
>>>>>>> 0da78d7 (commit)
<div style="text-align: center;">
    <img src="{{ public_path('images/logo_prov.png') }}" style="display: block; margin: 0 auto; width: 60px; height: auto">

</div>
<h3 style="text-align: center">PEMERINTAH PROVINSI<br>
<<<<<<< HEAD
KEPULAUAN BANGKA BELITUNG <br>
SKPD CABANG DINAS PENDIDIKAN WILAYAH I <br>
PROVINSI KEPULAUAN BANGKA BELITUNG
=======
    KEPULAUAN BANGKA BELITUNG <br>
    SKPD CABANG DINAS PENDIDIKAN WILAYAH I <br>
    PROVINSI KEPULAUAN BANGKA BELITUNG
>>>>>>> 0da78d7 (commit)
</h3>

<table style="text-align: center; width:100%" border="0">
    <tr>
<<<<<<< HEAD
        <td ><b><u>SURAT PERINTAH BAYAR</u></b></td>
=======
        <td><b><u>SURAT PERINTAH BAYAR</u></b></td>
>>>>>>> 0da78d7 (commit)
    </tr>
</table>
<div style="height: 10px;"></div>
<table style="width: 100%" border="0">
    <tr>
        <td style="width: 70px"></td>
        <td style="width: 50px">Tanggal </td>
        <td style="width: 20px">:<b></b></td>
        <td style="width: 200px">
            {{ Carbon\Carbon::Parse($stPegawai->tgl_sppd)->translatedFormat('d F Y') }}
        </td>
    </tr>
    <tr>
        <td></td>
        <td>No.SPB</td>
        <td>:<b></b></td>
<<<<<<< HEAD
        <td> ....... /SPB/SMKN 1 Kb/DINDIK/{{ Carbon\Carbon::Parse($stPegawai->tgl_sppd)->translatedFormat('Y') }}</td>
=======
        <td> ....... /SPB/ ...... /DINDIK/{{ Carbon\Carbon::Parse($stPegawai->tgl_sppd)->translatedFormat('Y') }}</td>
>>>>>>> 0da78d7 (commit)
    </tr>
</table>
<br>
<hr>
<div style="height: 10px;"></div>
<table border="0">
    <tr>
        <td style="text-align: justify">Saya yang bertandan tangan dibawah ini selaku PA/KPA Cabang Dinas Pendidikan Wil. I Pangkalpinang dan Bangka Tengah Provinsi Kepulauan Bangka Belitung memerintahkan Bendahara Pengeluaran/Bendahara Pengeluaran Pembantu agar melakukan pembayaran sejumlah :
        </td>
    </tr>
</table>
<div style="height: 10px;"></div>
<table border="1" cellpadding="2">
    <tr>
        <td style="width: 150px">
            <table border="0">
                <tr>
                    <td style="width: 20px">Rp.</td>
                    <td style="width: 120px; text-align:right"><b>
<<<<<<< HEAD
                        {{ number_format($totalSeluruh = ($stPegawai->biaya_transportasi + $stPegawai->biaya_penginapan + $stPegawai->biaya_tiket + $stPegawai->transport_lokal + $stPegawai->uang_makan + $stPegawai->uang_saku + $stPegawai->uang_representasi + $stPegawai->uang_kediklatan)* $stPegawai->pegawais->count() * (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0, ',', '.') , 0, ',', '.' }},-
                    </b></td>
=======
                            {{ number_format($totalSeluruh = ($stPegawai->biaya_transportasi + $stPegawai->biaya_penginapan + $stPegawai->biaya_tiket + $stPegawai->transport_lokal + $stPegawai->uang_makan + $stPegawai->uang_saku + $stPegawai->uang_representasi + $stPegawai->uang_kediklatan)* $stPegawai->pegawais->count() * (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0, ',', '.') , 0, ',', '.' }},-
                        </b></td>
>>>>>>> 0da78d7 (commit)
                </tr>
            </table>
        </td>
    </tr>
</table>
<div style="height: 10px;"></div>

<div style="height: 10px;"></div>
<table border="0">
    <tr>
        <td style="width: 200px"></td>
<<<<<<< HEAD
        <td colspan="2" >
            <table border="1" cellpadding="2">
                <tr>
                    <td><b><i>
                        ({{ Riskihajar\Terbilang\Facades\Terbilang::make($totalSeluruh) }} rupiah)
                    </i></b></td>
=======
        <td colspan="2">
            <table border="1" cellpadding="2">
                <tr>
                    <td><b><i>
                                ({{ Riskihajar\Terbilang\Facades\Terbilang::make($totalSeluruh) }} rupiah)
                            </i></b></td>
>>>>>>> 0da78d7 (commit)
                </tr>
            </table>
            <br>
        </td>
    </tr>
    <tr>
        <td>Kepada</td>
        <td style="width: 20px">:</td>
<<<<<<< HEAD
        
            @if($stPegawai->pegawais->isNotEmpty())
                @php
                    $firstPegawai = $stPegawai->pegawais->first();
                    $namaParts = explode(' ', $firstPegawai->nama);
                    $firstName = $namaParts[0];
                    $lastName = isset($namaParts[1]) ? $namaParts[1] : '';
                @endphp
                <td style="width: 465px"><b>{{ $firstName }} {{ $lastName }}</b></td>
            @else
                - No employees assigned
            @endif
        
=======

        @if($stPegawai->pegawais->isNotEmpty())
        @php
        $firstPegawai = $stPegawai->pegawais->first();
        $namaParts = explode(' ', $firstPegawai->nama);
        $firstName = $namaParts[0];
        $lastName = isset($namaParts[1]) ? $namaParts[1] : '';
        @endphp
        <td style="width: 465px"><b>{{ $firstName }} {{ $lastName }}</b></td>
        @else
        - No employees assigned
        @endif

>>>>>>> 0da78d7 (commit)
    </tr>
    <tr>
        <td>Untuk</td>
        <td>:</td>
        <td style="text-align: justify">Belanja Perjalanan Dinas Biasa ........
        </td>

    </tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="2">Sebanyak : {{ $stPegawai->pegawais->count() }} ({{ Riskihajar\Terbilang\Facades\Terbilang::make($stPegawai->pegawais->count() ) }}) orang</td>
    </tr>
    <tr>
        <td>Atas dasar</td>
    </tr>
    <tr>
        <td>Surat Tugas</td>
        <td>:</td>
<<<<<<< HEAD
        <td>Nomor : {{ $stPegawai->noST }}  Tangggal : {{ Carbon\Carbon::Parse($stPegawai->tglSt)->translatedFormat('d F Y') }}</td>
=======
        <td>Nomor : {{ $stPegawai->no_surat }} {{ Carbon\Carbon::Parse($stPegawai->tglSt)->translatedFormat('Y') }} Tangggal : {{ Carbon\Carbon::Parse($stPegawai->tglSt)->translatedFormat('d F Y') }}</td>
>>>>>>> 0da78d7 (commit)
    </tr>
    <tr>
        <td>(Terlampir)</td>
    </tr>
    <tr>
        <td>Dibebankan pada</td>
    </tr>
    <tr>
        <td>Kegiatan</td>
        <td>:</td>
        <td>{{ $stPegawai->nama_kegiatan }}</td>

    </tr>
    <tr>
        <td>Kode Rekening</td>
        <td>:</td>
        <td>{{ $stPegawai->korek }}</td>
    </tr>
</table>
<br>
<br>
<br>
<table style="width: 100%; text-align:center" border="0">
    <tr>
        <td>Koba, {{ Carbon\Carbon::Parse($stPegawai->tglSpb)->translatedFormat('d F Y') }} </td>
    </tr>
    <tr>
        <td>Pengguna Anggaran/</td>
    </tr>
    <tr>
        <td>Kuasa Pengguna Anggaran</td>
    </tr>
<<<<<<< HEAD
<br>
<br>
<br>
=======
    <br>
    <br>
    <br>
>>>>>>> 0da78d7 (commit)
    <tr>
        <td><b>{{ $kpaNama }}</b></td>
    </tr>
    <tr>
        <td>NIP. {{ $kpaNip }}</td>
    </tr>
<<<<<<< HEAD
</table>
=======
</table>
>>>>>>> 0da78d7 (commit)
