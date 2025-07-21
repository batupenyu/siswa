<style>
    @page {
        size: A4;
        margin: 20mm;
    }

    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        margin: 0;
        padding: 0;
    }

    .receipt-container {
        width: 100%;
        max-width: 700px;
        margin: 0 auto;
        border: 1px solid #000;
        padding: 10px 15px;
        box-sizing: border-box;
    }

    .header,
    .footer {
        text-align: center;
        /* border-bottom: 1px solid #000; */
        /* padding-bottom: 8px; */
        margin-bottom: 20px;
    }

    .header img {
        float: left;
        width: 70px;
        /* height: auto; */
        margin-right: 10px;
    }

    .header .school-info {
        font-weight: bold;
        font-size: 14px;
        /* margin-top: 8px; */
    }

    .header .school-contact {
        font-size: 10px;
        margin-top: 2px;
    }

    .title {
        text-align: center;
        font-weight: bold;
        font-size: 14px;
        border-top: 1px solid #000;
        border-bottom: 1px solid #000;
        padding: 4px 0;
        margin-bottom: 12px;
    }

    .transaction-info {
        width: 100%;
        margin-bottom: 12px;
    }

    .transaction-info td {
        padding: 2px 4px;
        vertical-align: top;
    }

    .transaction-info .label {
        width: 140px;
        font-weight: bold;
    }

    .payment-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 12px;
    }

    .payment-table th,
    .payment-table td {
        border: 1px solid #000;
        padding: 4px;
    }

    .payment-table th {
        text-align: left;
    }

    .payment-table .amount {
        text-align: right;
    }

    .terbilang-section {
        font-style: italic;
        margin-bottom: 12px;
    }

    .grand-total {
        width: 100%;
        margin-bottom: 25px;
    }

    .grand-total .label {
        font-weight: bold;
        border-top: 1px solid #000;
        padding-top: 4px;
    }

    .grand-total .amount {
        text-align: right;
        font-weight: bold;
        border-top: 1px solid #000;
        padding-top: 4px;
    }

    .footer {
        border-top: none;
        /* margin-top: 25px; */
        font-size: 10px;
        text-align: left;
        margin-bottom: 80px;
    }

    .footer .notes {
        margin-top: 15px;
    }

    .signature {
        float: right;
        text-align: center;
        /* margin-top: 35px; */
    }
</style>

<div class="receipt-container">
    <div class="header">
        <!-- <img src="{{ asset('images/kopSekolah.PNG') }}" alt="School Logo"> -->
        <div class="school-info">
            SMK NEGERI 1 KOBA
        </div>
        <div class="school-contact">
            Jalan Raya Koba Km. 42, Desa Penyak, Kecamatan Koba, Kabupaten Bangka Tengah, <br>
            Provinsi Kepulauan Bangka Belitung, 33681 <br>
            Laman: https://www.smknegeri1koba.sch.id/ Pos-el: smk1koba@yahoo.com
        </div>
    </div>

    <div class="title">BUKTI PEMBAYARAN/DONASI SISWA</div>

    <table class="transaction-info">
        <tr>
            <td class="label">NO TRANS</td>
            <td>: {{ $kwitansi->no_trans ?? '' }}</td>
            <td class="label">NIS</td>
            <td>: {{ $kwitansi->nis ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">TANGGAL</td>
            <td>: {{ $kwitansi->tanggal ?? '' }}</td>
            <td class="label">NAMA SISWA</td>
            <td>: {{ $kwitansi->nama_siswa ? str($kwitansi->nama_siswa) : 'Nama siswa tidak tersedia' }}</td>
        </tr>
        <tr>
            <td class="label">TGL DITETAPKAN</td>
            <td>: {{ $kwitansi->tgl_ditetapkan ?? '-' }}</td>
            <td class="label">TEMPAT DITETAPKAN</td>
            <td>: {{ $kwitansi->tempat_ditetapkan ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">JAM CETAK</td>
            <td>: {{ $kwitansi->jam_cetak ?? '' }}</td>
            <td class="label">KELAS</td>
            <td>: {{ $kwitansi->kelas ?? '' }}</td>
        </tr>
    </table>

    <table class="payment-table">
        <thead>
            <tr>
                <th style="width: 5%;">No.</th>
                <th>Keterangan Pembayaran</th>
                <th style="width: 20%; text-align: right;">Jumlah (Rp.)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kwitansi->payments as $index => $payment)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $payment['description'] }}</td>
                <td class="amount">{{ number_format($payment['amount'], 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="terbilang-section">
        Terbilang : <em>{{ $kwitansi->terbilang ?? '' }}</em>
    </div>

    <table class="grand-total">
        <tr>
            <td class="label" style="border-top: none;">Grand Total :</td>
            <td class="amount" style="border-top: none;">{{ number_format($kwitansi->grand_total ?? 0, 2, ',', '.') }}</td>
        </tr>
    </table>

    <div style="clear: both;"></div>
    <div class="footer">
        <div style="float: left; width: 50%;">
            <div>Catatan :</div>
            <div>- Disimpan sebagai bukti pembayaran yang SAH.</div>
            <div>- Uang yang sudah dibayarkan tidak dapat diminta kembali.</div>
        </div>
        <div class="signature" style="width: 45%;">
            <div>{{ $kwitansi->tempat_ditetapkan ?? '-' }}, {{ \Carbon\Carbon::parse($kwitansi->tgl_ditetapkan)->translatedFormat('d F Y') ?? '-' }}</div>
            <div>Yang Menerima,</div>
            <br><br><br>
            <!-- <div><strong>{{ $kwitansi->receiver_name ?? '..........................' }}</strong></div> -->

            @if(!empty($kwitansi->bends) && count($kwitansi->bends) > 0)
            <div>
                @foreach($kwitansi->bends as $bend)
                {{ $bend->pegawai->nama ?? 'Nama Pegawai tidak tersedia' }} <br>
                NIP.{{$bend->pegawai->nip}}
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>