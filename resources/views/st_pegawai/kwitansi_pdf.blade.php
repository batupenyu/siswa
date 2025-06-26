<style>
    .table-bordered {
        border: 1px solid;
        border-collapse: collapse;
        margin-top: 0 !important;
        /* margin: 20px auto; */
        width: 80%;
    }

    .table-bordered td,
    .table-bordered th {
        border: 1px solid;
        /* padding: 8px; */
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
        line-height: 1;
        padding: 0;
        margin: 0;
    }

    .vertical-line {
        border-left: 1px solid black;
        height: 100%;
        position: absolute;
        left: 50%;
        top: 0;
    }
</style>

<h4>PEMERINTAH PROVINSI<br>
    KEPULAUAN BANGKA BELITUNG <br>
    SKPD CABANG DINAS PENDIDIKAN WILAYAH I <br>
    <u>PROVINSI KEPULAUAN BANGKA BELITUNG</u>
</h4>

<table border="0" style="border-collapse: collapse; font-size:11pt">
    <tr>
        <td style="width: 110px; "></td>
        <td style="width: 120px; ">Tahun Anggaran</td>
        <td style="width: 15px; ">:</td>
        <td style="width: 400px;">{{ Carbon\Carbon::parse($stPegawai->tgl_sppd)->translatedFormat('Y') }}</td>
    </tr>
    <tr>
        <td style=""></td>
        <td style="">Kode Rekening</td>
        <td style="">:</td>
        <td>{{ $stPegawai->korek }}</td>
    </tr>
</table>
<br>
<table style="border-collapse: collapse; font-size:11pt;width:95%" class="table-borderless">
    {{-- <table border="1"> --}}
        <tr>
            <td rowspan="2"
                style="vertical-align: bottom;border-right: 1px solid black;border-top: 1px solid black; padding:5px; width:110px">
                <i>Diperiksa Oleh :</i>
            </td>
            <td style="vertical-align: top;border-top: 1px solid black; padding:5px; width:120px">Sudah terima dari</td>
            <td style="width:15px;border-top: 1px solid black; vertical-align:top;padding:5px">:</td>
            <td colspan="3" style="text-align:justify;border-top: 1px solid black; padding:5px; vertical-align:top">
                Pengguna Anggaran/Kuasa Pengguna Anggaran Bendahara Pengeluaran Pembantu Cabang Dinas Pendidikan Wilayah
                I
                Provinsi Kepulauan Bangka Belitung. Satker Cabang Dinas Pendidikan Wil. I Provinsi Kepulauan Bangka
                Belitung.</td>
        </tr>
        <tr>
            {{-- <td style="border-right: 1px solid black;"></td> --}}
            <td style="padding:5px">Banyaknya Uang</td>
            <td style="padding:5px">:</td>
            @php
            $totalSeluruh = ($stPegawai->biaya_transportasi + $stPegawai->biaya_penginapan + $stPegawai->biaya_tiket +
            $stPegawai->transport_lokal + $stPegawai->uang_makan + $stPegawai->uang_saku + $stPegawai->uang_representasi
            +
            $stPegawai->uang_kediklatan)* $stPegawai->pegawais->count() *
            (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1)
            @endphp
            @if ($totalSeluruh > 0)
            <td colspan="3"><b><i>({{ ucfirst(Riskihajar\Terbilang\Facades\Terbilang::make($totalSeluruh)) }} rupiah)
                    </i></b></td>
            @endif
        </tr>
        <tr>
            <td style="border-right: 1px solid black;"></td>
            <td style="padding:5px">Yaitu untuk</td>
            <td style="padding:5px">:</td>
            <td colspan="3">Pembayaran</td>
        </tr>
        <tr>
            <td style="border-right: 1px solid black;"></td>
            <td></td>
            <td></td>
            <td style="text-align: justify;height:60px; vertical-align:top" colspan="3">Belanja Perjalanan Dinas Biasa
            </td>
        </tr>
        <tr>
            <td style="border-right: 1px solid black;"></td>
            <td></td>
            <td>a.n</td>
            <td colspan="3">
                @if($stPegawai->pegawais->isNotEmpty())
                @php
                $firstPegawai = $stPegawai->pegawais->first();
                $namaParts = explode(' ', $firstPegawai->nama);
                $firstName = $namaParts[0];
                $lastName = isset($namaParts[1]) ? $namaParts[1] : '';
                @endphp
                {{-- {{ $firstName }} {{ $lastName }} --}}
                {{ $firstPegawai->nama }}
                @else
                -
                @endif
            </td>

        </tr>
        <tr>
            <td style="border-right: 1px solid black;"></td>
            <td></td>
            <td></td>
            <td>Berdasarkan :</td>
            <td></td>
            <td></td>
        </tr>
        <tr style="vertical-align: top">
            <td style="border-right: 1px solid black;"></td>
            <td></td>
            <td></td>
            <td style="width:120px">Surat Tugas</td>
            <td>:</td>
            <td style="width: 250px">
                421.5/ ......... /SMKN 1
                Kb/Dindik/{{\Carbon\Carbon::parse($stPegawai->tgl_ditetapkan)->translatedFormat('Y')}}

            </td>
        </tr>
        <tr>
            <td style="border-right: 1px solid black;"></td>
            <td></td>
            <td></td>
            <td>Tanggal</td>
            <td>:</td>
            <td>
                {{\Carbon\Carbon::parse($stPegawai->tgl_ditetapkan)->translatedFormat('d F Y')}}
            </td>
        </tr>
        <tr>
            <td style="border-right: 1px solid black;"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: center">
                <br>
                Koba,
                {{-- {{ Carbon\Carbon::parse($stPegawai->tgl_akhir)->translatedFormat('d F Y')}} --}}

                @if($stPegawai && $stPegawai->tgl_ditetapkan)
                @php
                $date = \Carbon\Carbon::parse($stPegawai->tgl_ditetapkan);
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
            <td style="border-right: 1px solid black;border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td style="border-bottom: 1px solid black;"></td>
            <td colspan="2" style="text-align: center;border-bottom: 1px solid black;">
                <br>
                <br>
                <br>
                <table style="width: 165px" border="0">
                    <tr>
                        <td>
                            <table border="1">
                                <tr>
                                    <td style="width: 20px"><b><i>Rp.</i></b></td>
                                    <td style="width: 100px; text-align:right">
                                        <b><i>{{ number_format($totalSeluruh =
                                                ($stPegawai->biaya_transportasi + $stPegawai->biaya_penginapan +
                                                $stPegawai->biaya_tiket + $stPegawai->transport_lokal +
                                                $stPegawai->uang_makan + $stPegawai->uang_saku +
                                                $stPegawai->uang_representasi + $stPegawai->uang_kediklatan)*
                                                $stPegawai->pegawais->count() *
                                                (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir)
                                                + 1), 0, ',', '.') , 0, ',', '.' }},-</i></b>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="text-align:center;vertical-align:top ;border-bottom: 1px solid black;"> Penerima Uang,
                <br>
                <br>
                <br>
                <br>
                @if($stPegawai->pegawais->isNotEmpty())
                @php
                $firstPegawai = $stPegawai->pegawais->first();
                $namaParts = explode(' ', $firstPegawai->nama);
                $firstName = $namaParts[0];
                $lastName = isset($namaParts[1]) ? $namaParts[1] : '';
                @endphp
                {{-- {{ $firstName }} {{ $lastName }} --}}
                {{ $firstPegawai->nama }}
                @else
                -
                @endif
                <br>
                NIP.
                @if($stPegawai->pegawais->isNotEmpty())
                @php
                $firstPegawai = $stPegawai->pegawais->first();
                $nipParts = explode(' ', $firstPegawai->nip);
                $firstNip = $nipParts[0];
                $lastNip = isset($nipParts[1]) ? $nipParts[1] : '';
                @endphp
                {{ $firstNip }} {{ $lastNip }}
                @else
                -
                @endif
            </td>
        </tr>
    </table>
    <table style="text-align: center;font-size:11pt" border="0">
        <tr>
            <td style="width: 215px">Pengguna Anggaran/ <br>
                Kuasa Pengguna Anggaran</td>
            <td style="width: 215px">Bendahara Pengeluaran Pembantu</td>
            <td style="width: 215px">Pejabat Pelaksana Teknis</td>
        </tr>
        <br>
        <br>
        <br>
        <tr>
            <td>{{ $kpaNama }}
                <br>
                NIP. {{ $kpaNip }}
            </td>
            <td>{{ $bpNama }}
                <br>
                NIP. {{ $bpNip }}
            </td>
            <td>{{ $pptkNama }}
                <br>
                NIP. {{ $pptkNip }}
            </td>
        </tr>
    </table>