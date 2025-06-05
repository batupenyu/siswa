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
        display: flex;
        align-items: center;
    }

    .header img {
        width: 100%;
        height: auto;
        margin-right: 15px;
    }
</style>
<!-- resources/views/nama_file.blade.php -->

<!-- Section content -->
<div class="header">
    {{-- <img src="{{ public_path('images/kopSekolah.png') }}" alt=""> --}}
    @if($headerIconImage)
    <img src="{{ public_path('storage/header_icons/' . $headerIconImage->filename) }}" alt="Icon">
    @else
    <img src="{{ public_path('images/icon.png') }}" alt="Kop Surat">
</div>
<div class="container">
    @endif
    <h3 style="text-align: center">
        SURAT TUGAS <br>
        Nomor : ........ / ..... / {{ Carbon\carbon::parse($surats->tgl_kegiatan)->translatedFormat('Y') }}
    </h3>

    <table>
        <tr style="vertical-align: top">
            <td>Dasar </td>
            <td>:</td>
            <td style="text-align: justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod nulla
                distinctio molestias nisi. Molestias voluptatem iure fuga officiis animi quas, fugiat explicabo nesciunt
                recusandae incidunt laboriosam quia repellendus aliquam ad suscipit provident omnis consequuntur
                blanditiis rem. Velit, quo facere ullam atque cum maiores tempore, itaque nostrum debitis repellendus
                iure dicta explicabo similique non asperiores, numquam soluta quisquam! Fugiat sapiente libero corrupti
                debitis quisquam fuga, beatae sequi. Vitae, tempora nesciunt vel necessitatibus consectetur quod impedit
                omnis ex minus eaque, adipisci repellendus, facilis aspernatur totam quis minima quam rerum laudantium
                harum repudiandae magnam culpa dolorum neque? Odio libero beatae repellendus tempora a.</td>
        </tr>
        <tr style="vertical-align: top">
            <td style="width:100px">Kepada</td>
            <td>:</td>
            <td>

                @if($surats->siswa->count() <= 2) <table style="border: 1px solid" cellpadding="0">
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
        @foreach($surats->siswa as $siswa)
        <tr>
            <td style="padding-left: 10px">{{ $loop->iteration }}.</td>
            <td style="padding-left: 50px">{{ $siswa->name }}</td>
            <td style="text-align: center">{{ $siswa->nis }}</td>
            <td style="text-align: center">{{ $siswa->kelas->name }}</td>
        </tr>
        @endforeach
    </table>
    @else
    <a href="{{ route('tabelPdf', $surats->id) }}" class="btn btn-primary btn-sm"><i>Daftar nama terlampir</i></a>
    @endif
    </td>
    </tr>
    <tr style="vertical-align: top">
        <td>Untuk</td>
        <td>:</td>
        <td>
            Melaksanakan {{ $surats->nama_kegiatan }} <br>
            Hari/tanggal <span>:</span>
            @if ($surats->tgl_kegiatan != $surats->tgl_akhir_kegiatan)
            {{ Carbon\carbon::parse($surats->tgl_kegiatan)->translatedFormat('l') }} - {{
            Carbon\carbon::parse($surats->tgl_akhir_kegiatan)->translatedFormat('l') }}/ {{
            Carbon\carbon::parse($surats->tgl_kegiatan)->translatedFormat('d-m-Y') }} s.d. {{
            Carbon\carbon::parse($surats->tgl_akhir_kegiatan)->translatedFormat('d-m-Y') }} <br>
            @else
            {{ Carbon\carbon::parse($surats->tgl_kegiatan)->translatedFormat('l') }}/ {{
            Carbon\carbon::parse($surats->tgl_akhir_kegiatan)->translatedFormat('d-m-Y') }} <br>
            @endif

            Pukul <span style="padding-left: 43px">:</span> {{ Carbon\Carbon::parse($surats->jam_kegiatan
            )->format('H:i')}} WIB s.d Selesai
            <br>
            Tempat <span style="padding-left: 32px">:</span> {{ $surats->tempat_kegiatan }}
        </td>
    </tr>
    <tr>
        <td style="text-align: justify" colspan="3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veritatis
            libero quidem ipsam quaerat nisi quos nesciunt, tempore voluptatem autem ducimus inventore maiores expedita
            hic quasi velit vel sint in dignissimos placeat, alias nemo dolorum. Nesciunt adipisci eligendi excepturi
            cumque consequuntur velit harum quibusdam rerum voluptatibus provident? Eum harum nesciunt ex?</td>
    </tr>
    </table>

    <p style="text-align: center;padding-left:300px">
        {{ $surats->ditetapkan_di }}, {{ Carbon\Carbon::parse($surats->tgl_ditetapkan)->translatedFormat('d F Y') }}
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