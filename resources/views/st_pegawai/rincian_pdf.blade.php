<table style="width: 100%">
    <tr>
        <td style="text-align:center"><b>RINCIAN BIAYA PERJALANAN DINAS</b></td>
    </tr>
</table>
<br>
<br>
<table style="border: none;">
    <tr nobr="true">
        <td></td>
    </tr>
</table>
<table>
    <tr>
        <td>Lampiran</td>
        <td style="width: 20px">:</td>
        <td>2 (Dua)</td>
    </tr>
    <tr>
        <td>SPPD No.</td>
        <td style="width: 20px">:</td>
<<<<<<< HEAD
        <td>800/ ........... /SMKN 1 Kb/DINDIK/{{ Carbon\Carbon::parse($stPegawai->tgl_awal)->translatedFormat('Y') }}
=======
        <td>{{ $stPegawai->no_surat }}{{ Carbon\Carbon::parse($stPegawai->tgl_awal)->translatedFormat('Y') }}
>>>>>>> 0da78d7 (commit)
        </td>
    </tr>
    <tr>
        <td>Tgl. SPPD.</td>
        <td style="width: 20px">:</td>
        <td>{{ Carbon\Carbon::parse($stPegawai->tgl_awal)->translatedFormat('d F Y') }}</td>
    </tr>
</table>
<table style="border: none;">
    <tr nobr="true">
        <td></td>
    </tr>
</table>
<table border="1" style="width: 100%; font-size: 11pt; border-collapse: collapse; border: 1px solid black;"
    cellpadding="3">
    <tr style="text-align: center">
        <th style="width: 30px"><b>NO.</b></th>
        <th style="width: 250px"><b>PERINCIAN BIAYA</b></th>
        <th style="width: 100px"><b>JUMLAH</b></th>
        <th style="width: 160px"><b>KETERANGAN</b></th>
    </tr>
    <tr>
        <td style="text-align: center; vertical-align: top; padding-top: 5px;">
            <table border="0" cellpadding="0">
                <tr>
                    <td style="text-align: center">1.</td>
                </tr>
                <tr>
                    <td style="text-align: center">2.</td>
                </tr>
                <tr>
                    <td style="text-align: center">3.</td>
                </tr>
                <tr>
                    <td style="text-align: center">4.</td>
                </tr>
            </table>
        </td>
        <td>
            <table border="0">
                <tr>
                    <td style="width: 200px; vertical-align: top;">Biaya Transportasi</td>
                    <td style="width: 20px">{{ $stPegawai->biaya_transportasi > 0 ? $stPegawai->pegawais->count():'-' }}
                    </td>
                    <td style="width: 20px">{{ $stPegawai->biaya_transportasi > 0 ? "X" :'-' }}</td>
                    <td style="width: 20px">{{ $stPegawai->biaya_transportasi > 0 ? "OH" :'-' }}</td>
                    <td style="width: 20px">{{ $stPegawai->biaya_transportasi > 0 ? "Rp." :'-' }}</td>
                    <td style="text-align: right; width:60px ">
                        @if ($stPegawai->biaya_transportasi <=0) @else @if ($stPegawai->pegawais->isNotEmpty())
                            {{ number_format($totalTransport = $stPegawai->biaya_transportasi *
                            $stPegawai->pegawais->count() *
                            (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0,
                            ',', '.') }},-
                            @else
                            @endif
                            @endif
                    </td>
                </tr>
                <tr>
                    <td>Biaya Penginapan</td>
                    <td>{{ $stPegawai->biaya_penginapan > 0 ? $stPegawai->pegawais->count():'-' }}</td>
                    <td>{{ $stPegawai->biaya_penginapan > 0 ? "X" :'-' }}</td>
                    <td>{{ $stPegawai->biaya_penginapan > 0 ? "OH" :'-' }}</td>
                    <td>{{ $stPegawai->biaya_penginapan > 0 ? "Rp." :'-' }}</td>
                    <td style="text-align: right">
                        @if ($stPegawai->biaya_penginapan <=0) @else @if ($stPegawai->pegawais->count() !=0)
                            {{ number_format($totalTransport = $stPegawai->biaya_penginapan *
                            $stPegawai->pegawais->count() *
                            (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0,
                            ',', '.') }},-
                            @else
                            @endif
                            @endif
                    </td>
                </tr>
                <tr>
                    <td>Biaya Tiket Pesawat</td>
                    <td>{{ $stPegawai->biaya_tiket > 0 ? $stPegawai->pegawais->count():'-' }}</td>
                    <td>{{ $stPegawai->biaya_tiket > 0 ? "X" :'-' }}</td>
                    <td>{{ $stPegawai->biaya_tiket > 0 ? "OH" :'-' }}</td>
                    <td>{{ $stPegawai->biaya_tiket > 0 ? "Rp." :'-' }}</td>
                    <td style="text-align: right">
                        @if ($stPegawai->biaya_tiket <=0) @else @if ($stPegawai->pegawais->count() !=0)
                            {{ number_format($totalTransport = $stPegawai->biaya_tiket * $stPegawai->pegawais->count() *
                            (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0,
                            ',', '.') }},-
                            @else
                            @endif
                            @endif
                    </td>
                </tr>
                <tr>
                    <td>Biaya Lumpsum :</td>
                </tr>
                <tr>
                    <td>a. Transport Lokal</td>
                    <td>{{ $stPegawai->transport_lokal > 0 ? $stPegawai->pegawais->count():'-' }}</td>
                    <td>{{ $stPegawai->transport_lokal > 0 ? "X" :'-' }}</td>
                    <td>{{ $stPegawai->transport_lokal > 0 ? "OH" :'-' }}</td>
                    <td>{{ $stPegawai->transport_lokal > 0 ? "Rp." :'-' }}</td>
                    <td style="text-align: right">
                        @if ($stPegawai->transport_lokal <=0) @else @if ($stPegawai->pegawais->count() !=0)
                            {{ number_format($totalTransport = $stPegawai->transport_lokal *
                            $stPegawai->pegawais->count() *
                            (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0,
                            ',', '.') }},-
                            @else
                            @endif
                            @endif
                    </td>
                </tr>
                <tr>
                    <td>b. Uang Makan</td>
                    <td>{{ $stPegawai->uang_makan > 0 ? $stPegawai->pegawais->count():'-' }}</td>
                    <td>{{ $stPegawai->uang_makan > 0 ? "X" :'-' }}</td>
                    <td>{{ $stPegawai->uang_makan > 0 ? "OH" :'-' }}</td>
                    <td>{{ $stPegawai->uang_makan > 0 ? "Rp." :'-' }}</td>
                    <td style="text-align: right">
                        @if ($stPegawai->uang_makan <=0) @else @if ($stPegawai->pegawais->count() !=0)
                            {{ number_format($totalTransport = $stPegawai->uang_makan * $stPegawai->pegawais->count() *
                            (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0,
                            ',', '.') }},-
                            @else
                            @endif
                            @endif
                    </td>
                </tr>
                <tr>
                    <td>c. Uang Saku</td>
                    <td>{{ $stPegawai->uang_saku > 0 ? $stPegawai->pegawais->count():'-' }}</td>
                    <td>{{ $stPegawai->uang_saku > 0 ? "X" :'-' }}</td>
                    <td>{{ $stPegawai->uang_saku > 0 ? "OH" :'-' }}</td>
                    <td>{{ $stPegawai->uang_saku > 0 ? "Rp." :'-' }}</td>
                    <td style="text-align: right">
                        @if ($stPegawai->uang_saku <=0) @else @if ($stPegawai->pegawais->count() !=0)
                            {{ number_format($totalTransport = $stPegawai->uang_saku * $stPegawai->pegawais->count() *
                            (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0,
                            ',', '.') }},-
                            @else
                            @endif
                            @endif
                    </td>
                </tr>

                <tr>
                    <td>d. Uang Refresentasi</td>
                    <td>{{ $stPegawai->uang_representasi > 0 ? $stPegawai->pegawais->count():'-' }}</td>
                    <td>{{ $stPegawai->uang_representasi > 0 ? "X" :'-' }}</td>
                    <td>{{ $stPegawai->uang_representasi > 0 ? "OH" :'-' }}</td>
                    <td>{{ $stPegawai->uang_representasi > 0 ? "Rp." :'-' }}</td>
                    <td style="text-align: right">
                        @if ($stPegawai->uang_representasi <=0) @else @if ($stPegawai->pegawais->count() !=0)
                            {{ number_format($totalTransport = $stPegawai->uang_representasi *
                            $stPegawai->pegawais->count() *
                            (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0,
                            ',', '.') }},-
                            @else
                            @endif
                            @endif
                    </td>
                </tr>

                <tr>
                    <td>e. Uang Kediklatan</td>
                    <td>{{ $stPegawai->uang_kediklatan > 0 ? $stPegawai->pegawais->count():'-' }}</td>
                    <td>{{ $stPegawai->uang_kediklatan > 0 ? "X" :'-' }}</td>
                    <td>{{ $stPegawai->uang_kediklatan > 0 ? "OH" :'-' }}</td>
                    <td>{{ $stPegawai->uang_kediklatan > 0 ? "Rp." :'-' }}</td>
                    <td style="text-align: right">
                        @if ($stPegawai->uang_kediklatan <=0) @else @if ($stPegawai->pegawais->count() !=0)
                            {{ number_format($totalTransport = $stPegawai->uang_kediklatan *
                            $stPegawai->pegawais->count() *
                            (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0,
                            ',', '.') }},-
                            @else
                            @endif
                            @endif
                    </td>
                </tr>
            </table>
        </td>
        <td>
            <table border="0">
                <tr>
                    <td style="width:30px; ">{{ $stPegawai->biaya_transportasi > 0 ? 'Rp.' : '-' }}</td>
                    <td style="text-align: right;width:60px">
                        @if ($stPegawai->biaya_transportasi <=0) @else @if ($stPegawai->pegawais->count() !=0)
                            {{ number_format($totalTransport = $stPegawai->biaya_transportasi *
                            $stPegawai->pegawais->count() *
                            (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0,
                            ',', '.') }},-
                            @else
                            @endif
                            @endif
                    </td>
                </tr>
                <tr>
                    <td>{{ $stPegawai->biaya_penginapan > 0 ? 'Rp.' : '-' }}</td>
                    <td style="text-align: right;width:60px">
                        @if ($stPegawai->biaya_penginapan <=0) @else @if ($stPegawai->pegawais->count() !=0)
                            {{ number_format($totalPenginapan = $stPegawai->biaya_penginapan *
                            $stPegawai->pegawais->count() *
                            (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0,
                            ',', '.') }},-
                            @else
                            @endif
                            @endif
                    </td>
                </tr>
                <tr>
                    <td>{{ $stPegawai->biaya_tiket > 0 ? 'Rp.' : '-' }}</td>
                    <td style="text-align: right;width:60px">
                        @if ($stPegawai->biaya_tiket <=0) @else @if ($stPegawai->pegawais->count() !=0)
                            {{ number_format($totalTiket = $stPegawai->biaya_tiket * $stPegawai->pegawais->count() *
                            (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0,
                            ',', '.') }},-
                            @else
                            @endif
                            @endif
                    </td>
                </tr>
                <tr>
                    <td>.</td>
                    <td>.</td>
                </tr>
                <tr>
                    <td>{{ $stPegawai->transport_lokal > 0 ? 'Rp.' : '-' }}</td>
                    <td style="text-align: right;width:60px">
                        @if ($stPegawai->transport_lokal <=0) @else @if ($stPegawai->pegawais->count() !=0)
                            {{ number_format($totalTiket = $stPegawai->transport_lokal * $stPegawai->pegawais->count() *
                            (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0,
                            ',', '.') }},-
                            @else
                            @endif
                            @endif
                    </td>
                </tr>
                <tr>
                    <td>{{ $stPegawai->uang_makan > 0 ? 'Rp.' : '-' }}</td>
                    <td style="text-align: right;width:60px">
                        @if ($stPegawai->uang_makan <=0) @else @if ($stPegawai->pegawais->count() !=0)
                            {{ number_format($totalTiket = $stPegawai->uang_makan * $stPegawai->pegawais->count() *
                            (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0,
                            ',', '.') }},-
                            @else
                            @endif
                            @endif
                    </td>
                </tr>
                <tr>
                    <td>{{ $stPegawai->uang_saku > 0 ? 'Rp.' : '-' }}</td>
                    <td style="text-align: right;width:60px">
                        @if ($stPegawai->uang_saku <=0) @else @if ($stPegawai->pegawais->count() !=0)
                            {{ number_format($totalTiket = $stPegawai->uang_saku * $stPegawai->pegawais->count() *
                            (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0,
                            ',', '.') }},-
                            @else
                            @endif
                            @endif
                    </td>
                </tr>
                <tr>
                    <td>{{ $stPegawai->uang_representasi > 0 ? 'Rp.' : '-' }}</td>
                    <td style="text-align: right;width:60px">
                        @if ($stPegawai->uang_representasi <=0) @else @if ($stPegawai->pegawais->count() !=0)
                            {{ number_format($totalTiket = $stPegawai->uang_representasi * $stPegawai->pegawais->count()
                            * (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0,
                            ',', '.') }},-
                            @else
                            @endif
                            @endif
                    </td>
                </tr>
                <tr>
                    <td>{{ $stPegawai->uang_kediklatan > 0 ? 'Rp.' : '-' }}</td>
                    <td style="text-align: right;width:60px">
                        @if ($stPegawai->uang_kediklatan <=0) @else @if ($stPegawai->pegawais->count() !=0)
                            {{ number_format($totalTiket = $stPegawai->uang_kediklatan * $stPegawai->pegawais->count() *
                            (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0,
                            ',', '.') }},-
                            @else
                            @endif
                            @endif
                    </td>
                </tr>

            </table>
        </td>

        <td style="vertical-align: top">
            <table border="0" style="font-size: 10pt">
                <tr>
                    <td style="vertical-align:top">Lamanya</td>
                    <td style="width: 20px">:</td>
                    <td style="width: 75px; vertical-align:top"> {{
                        \Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1 }}
                        @php
                        $hari = \Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1;
                        @endphp
                        ({{ Riskihajar\Terbilang\Facades\Terbilang::make($hari) }} ) hari
                    </td>
                </tr>
                <tr>
                    <td>Dari Tgl</td>
                    <td>:</td>
                    <td> {{ Carbon\Carbon::parse($stPegawai->tgl_awal)->translatedFormat('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td>s.d Tgl</td>
                    <td>:</td>
                    <td> {{ Carbon\Carbon::parse($stPegawai->tgl_akhir)->translatedFormat('d-m-Y') }}</td>
                </tr>
            </table>
            <br>
            <table style="border: none;">
                <tr nobr="true">
                    <td></td>
                </tr>
            </table>
            <table border="0" cellpadding="3">
                <tr>
                    <td style="text-align:justify">Belanja Perjalanan Dinas Biasa
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>

            <table border="0">
                <tr>
                    <td style="width: 20px">Rp.</td>
                    <td style="text-align: right; width:70px">
                        {{ number_format($totalSeluruh = ($stPegawai->biaya_transportasi + $stPegawai->biaya_penginapan
                        + $stPegawai->biaya_tiket + $stPegawai->transport_lokal + $stPegawai->uang_makan +
                        $stPegawai->uang_saku + $stPegawai->uang_representasi + $stPegawai->uang_kediklatan)*
                        $stPegawai->pegawais->count() *
                        (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0, ',',
                        '.') , 0, ',', '.' }},-
                    </td>
                </tr>
            </table>
        </td>
        <td></td>
    </tr>
    <tr>
        <td style="text-align: right" colspan="2"><b><i>Terbilang</i></b>:</td>
        <td colspan="2" style="text-transform: capitalize"><b><i>
                    ({{ Riskihajar\Terbilang\Facades\Terbilang::make($totalSeluruh) }} rupiah)
                </i></b></td>
    </tr>
</table>
<table style="border: none;">
    <tr nobr="true">
        <td></td>
    </tr>
</table>
<table style="text-align: center">
    <tr>
        <td>Telah dibayar sejumlah</td>
        <td style="width: 200px"></td>
        <td>Telah diterima jumah uang sebesar</td>
    </tr>
    <tr>
        <td>Rp. {{ number_format($totalSeluruh = ($stPegawai->biaya_transportasi + $stPegawai->biaya_penginapan +
            $stPegawai->biaya_tiket + $stPegawai->transport_lokal + $stPegawai->uang_makan + $stPegawai->uang_saku +
            $stPegawai->uang_representasi + $stPegawai->uang_kediklatan)* $stPegawai->pegawais->count() *
            (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0, ',', '.') , 0, ',',
            '.' }},-
        </td>
        <td style="width: 200px"></td>
        <td>Rp. {{ number_format($totalSeluruh = ($stPegawai->biaya_transportasi + $stPegawai->biaya_penginapan +
            $stPegawai->biaya_tiket + $stPegawai->transport_lokal + $stPegawai->uang_makan + $stPegawai->uang_saku +
            $stPegawai->uang_representasi + $stPegawai->uang_kediklatan)* $stPegawai->pegawais->count() *
            (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0, ',', '.') , 0, ',',
            '.' }},-
        </td>
    </tr>
    <tr>
        <td>Bendahara Pengeluaran Pembantu</td>
        <td style="width: 200px"></td>
        <td>Yang Menerima</td>
    </tr>
    <br>
    <br>
    <br>
    <tr>
        <td>{{ $bpNama }}</td>
        <td style="width: 200px"></td>
        <td>
            @if($stPegawai->pegawais->isNotEmpty())
            @php
            $firstPegawai = $stPegawai->pegawais->first();
            $namaParts = explode(' ', $firstPegawai->nama);
            $firstName = $namaParts[0];
            $lastName = isset($namaParts[1]) ? $namaParts[1] : '-';
            @endphp
            {{ $firstName }} {{ $lastName }}
            @else
            -
            @endif
        </td>
    </tr>
    <tr>
        <td>NIP.{{ $bpNip }}</td>
        <td style="width: 200px"></td>
        <td>NIP.
            @if($stPegawai->pegawais->isNotEmpty())
            @php
            $firstPegawai = $stPegawai->pegawais->first();
            $nipParts = explode(' ', $firstPegawai->nip);
            $firstNip = $nipParts[0];
            $midNip = isset($nipParts[1]) ? $nipParts[1] : '-';
            $lastNip = isset($nipParts[2]) ? $nipParts[2] : '-';
            $endNip = isset($nipParts[3]) ? $nipParts[3] : '-';
            @endphp
            {{ $firstNip }} {{ $midNip }} {{ $lastNip }} {{ $endNip }}
            @else
            -
            @endif
        </td>
    </tr>
</table>
<table style="border: none;">
    <tr nobr="true">
        <td></td>
    </tr>
</table>
<br>
<br>
<table>
    <tr>
        <td colspan="4"><u>PERHITUNGAN SPPD RAMPUNG</u></td>
    </tr>
    <tr>
        <td style="width: 300px">Ditetapkan sejumlah</td>
        <td style="width:30px">:</td>
        <td style="width:30px">Rp.</td>
        <td style="text-align: right; width:70px">{{ number_format($totalSeluruh = ($stPegawai->biaya_transportasi +
            $stPegawai->biaya_penginapan + $stPegawai->biaya_tiket + $stPegawai->transport_lokal +
            $stPegawai->uang_makan + $stPegawai->uang_saku + $stPegawai->uang_representasi +
            $stPegawai->uang_kediklatan)* $stPegawai->pegawais->count() *
            (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0, ',', '.') , 0, ',',
            '.' }},- </td>
    </tr>
    <tr>
        <td>Yang telah dibayarkan sejumlah</td>
        <td>:</td>
        <td style="width:30px">Rp.</td>
        <td style="text-align: right; width:70px">{{ number_format($totalSeluruh = ($stPegawai->biaya_transportasi +
            $stPegawai->biaya_penginapan + $stPegawai->biaya_tiket + $stPegawai->transport_lokal +
            $stPegawai->uang_makan + $stPegawai->uang_saku + $stPegawai->uang_representasi +
            $stPegawai->uang_kediklatan)* $stPegawai->pegawais->count() *
            (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0, ',', '.') , 0, ',',
            '.' }},- </td>
    </tr>
    <tr>
        <td>Sisa kurang / lebih</td>
        <td>:</td>
        <td style="width:30px">Rp.</td>
        <td style="text-align: right; width:70px">{{ number_format($totalSeluruh = ($stPegawai->biaya_transportasi +
            $stPegawai->biaya_penginapan + $stPegawai->biaya_tiket + $stPegawai->transport_lokal +
            $stPegawai->uang_makan + $stPegawai->uang_saku + $stPegawai->uang_representasi +
            $stPegawai->uang_kediklatan)* $stPegawai->pegawais->count() *
            (\Carbon\Carbon::parse($stPegawai->tgl_awal)->diffInDays($stPegawai->tgl_akhir) + 1), 0, ',', '.') , 0, ',',
            '.' }},- </td>
    </tr>
</table>
<table style="border: none;">
    <tr nobr="true">
        <td></td>
    </tr>
</table>
<table style="text-align: center;width:100%">
    <tr>
        <td>Pengguna Anggaran/</td>
    </tr>
    <tr>
        <td>Kuasa Pengguna Anggaran</td>
    </tr>
    <br>
    <br>
    <br>
    <tr>
        <td><u>{{ $kpaNama }}</u></td>
    </tr>
    <tr>
        <td>{{ $kpaPangkat }}</td>
    </tr>
    <tr>
        <td>NIP.{{ $kpaNip }} </td>
    </tr>
</table>