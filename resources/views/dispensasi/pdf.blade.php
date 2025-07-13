<style>
    .container {
        margin: 0 20px 0 20px;
        /* Top, Right, Bottom, Left */

    }

    /* Add this style to set indent for Lorem span */
    .lorem-span {
        text-indent: 50px;
        /* adjust the value as needed */
    }

    /* Add this style to set right margin for paragraph */
    .container p {
        margin-right: 50px;
        /* adjust the value as needed */


    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .kop-opd {
        /* border-bottom: 3px solid #000; */
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
</style>
<!-- resources/views/nama_file.blade.php -->

<!-- Section content -->
<div class="container">
    {{-- <img src="{{ public_path('images/kopSekolah.png') }}" alt=""> --}}
    <div class="header">
        @if($headerIconImage)
        <img src="{{ public_path('storage/header_icons/' . $headerIconImage->filename) }}" alt="Icon">
        @else
        <img src="{{ public_path('images/icon.png') }}" alt="Kop Surat">
        @endif
    </div>
    <h4 style="text-align: center">
        <u>SURAT DISPENSASI </u><br>
        Nomor : ........ / ..... / {{ Carbon\carbon::parse($dispensasi->tgl_kegiatan)->translatedFormat('Y') }}
    </h4>

    <table>
        <tr style="vertical-align: top">
            <td>Dasar </td>
            <td>:</td>
            <td style="text-align: justify">{{ $dispensasi->nama_kegiatan }}</td>
        </tr>
        <tr style="vertical-align: top">
            <td style="width:100px">Kepada</td>
            <td>:</td>
            <td>
                @if($dispensasi->siswa->count() <= 2) <table style="border: 1px solid" cellpadding="0">
        <tr>
            <th style="padding-left: 10px">No.</th>
            <th style="width: 200px">Nama</th>
            <th style="width: 100px">NIS</th>
            <th style="width: 155px">Kelas</th>
        </tr>
        <tr>
            <td colspan="4">
                <hr>
            </td>
        </tr>
        @forelse($dispensasi->siswa as $index => $siswa)
        {{-- @foreach($dispensasi->siswa as $siswa) --}}
        <tr>
            {{-- <td style="padding-left: 10px">{{ $loop->iteration }}.</td> --}}
            <td style="padding-left: 10px">{{ $index + 1 }}.</td>
            <td style="padding-left: 50px">{{ $siswa->name }}</td>
            <td style="text-align: center">{{ $siswa->nis }}</td>
            <td style="text-align: center">{{ $siswa->kelas->name }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2" style="text-align: center;">No siswa found</td>
        </tr>
        @endforelse
    </table>
    @else
    <a href="{{ route('tabeldispensasi', $dispensasi->id) }}" class="btn btn-primary btn-sm"><i>Daftar nama
            terlampir</i></a>
    @endif
    </td>
    </tr>
    <tr style="vertical-align: top">
        <td>Untuk</td>
        <td>:</td>
        <td>
            Melaksanakan {{ $dispensasi->nama_kegiatan }} <br>
            Hari/tanggal <span>:</span>
            @if ($dispensasi->tgl_kegiatan == $dispensasi->tgl_akhir_kegiatan)
            {{ Carbon\carbon::parse($dispensasi->tgl_kegiatan)->translatedFormat('l') }} - {{
            Carbon\carbon::parse($dispensasi->tgl_akhir_kegiatan)->translatedFormat('l') }}/ {{
            Carbon\carbon::parse($dispensasi->tgl_kegiatan)->translatedFormat('d-m-Y') }} s.d. {{
            Carbon\carbon::parse($dispensasi->tgl_akhir_kegiatan)->translatedFormat('d-m-Y') }} <br>
            @else
            {{ Carbon\carbon::parse($dispensasi->tgl_kegiatan)->translatedFormat('l') }}/ {{
            Carbon\carbon::parse($dispensasi->tgl_akhir_kegiatan)->translatedFormat('d-m-Y') }} <br>
            @endif

            Pukul <span style="padding-left: 43px">:</span> {{ Carbon\Carbon::parse($dispensasi->jam_kegiatan
            )->format('H:i')}} WIB s.d Selesai
            <br>
            Tempat <span style="padding-left: 32px">:</span> {{ $dispensasi->tempat_kegiatan }}
        </td>
    </tr>
    <td></td>
    <td></td>
    <td style="text-align: justify; vertical-align:top" colspan="3">
        <ol style="padding-left: 20px; text-align: justify;vertical-align: top">
            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt, magnam?</li>
            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, quam ipsa?</li>
            <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis similique dolore sed!</li>
        </ol>
    </td>
    <tr>
        <td></td>
        <td></td>
        <td style="text-align: justify" colspan="3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veritatis
            libero quidem ipsam quaerat nisi quos nesciunt, tempore voluptatem autem ducimus inventore maiores expedita
            hic quasi velit vel sint in dignissimos placeat, alias nemo dolorum. Nesciunt adipisci eligendi excepturi
            cumque consequuntur velit harum quibusdam rerum voluptatibus provident? Eum harum nesciunt ex?</td>
    </tr>
    </table>

    <p style="text-align: center;padding-left:300px">
        Koba, {{ Carbon\Carbon::parse($dispensasi->tgl_ditetapkan)->translatedFormat('d F Y') }}
        <br>
        {{ $atasanJabatan }}
        <br>
        <br>
        <br>
        <br>
        {{ $atasanNama}}
        <br>
        NIP. {{ $atasanNip }}
    </p>
</div>