<style>
    .container {
        margin: 0 20px 0 20px; /* Top, Right, Bottom, Left */
        margin-top: 0px; /* Set top margin to zero */
    }
    /* Add this style to set indent for Lorem span */
    .lorem-span {
        text-indent: 50px; /* adjust the value as needed */
    }

    /* Add this style to set right margin for paragraph */
    .container p {
        margin-right: 50px; /* adjust the value as needed */


    }

</style>
<!-- resources/views/nama_file.blade.php -->

<!-- Section content -->
<div class="container">
    @if($stPegawai->pegawais->isNotEmpty())
        @php
            $firstPegawai = $stPegawai->pegawais->first();
            $namaParts = explode(' ', $firstPegawai->jabatan);
            $firstName = $namaParts[0];
            $lastName = isset($namaParts[1]) ? $namaParts[1] : '';
        @endphp
        {{-- {{ $firstName }}  --}}
        {{-- {{ $lastName }} --}}
        @if ($firstName == 'Kepala')
        <img src="{{ public_path('images/kopcabdin1.png') }}" alt="">
        <h4 style="text-align: center">
            <u>SURAT TUGAS</u> <br>
            Nomor : 421.5/........./CABDINDIK WIL I/{{ Carbon\Carbon::Parse($stPegawai->tgl_kegiatan)->translatedFormat('Y') }}.
        </h4>
        @else
        <img src="{{ public_path('images/kopSekolah.png') }}" alt="">
        <h4 style="text-align: center">
            <u>SURAT TUGAS</u> <br>
            Nomor : 094/........./SMKN 1 Kb/Dindik/{{ Carbon\Carbon::Parse($stPegawai->tgl_kegiatan)->translatedFormat('Y') }}.
        </h4>
        @endif
    @else
        - 
    @endif

    <table>
        <tr style="vertical-align: top">
            <td>Dasar </td>
            <td>:</td>
            <td style="text-align: justify">
                {{ $stPegawai->dasar_surat }} <br>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;padding:20px" colspan="3"><b>MENUGASKAN</b> :</td>
        </tr>
        <tr style="vertical-align: top">
            <td style="width:100px">Kepada</td>
            <td>:</td>
            <td>
                @if ($stPegawai->pegawais->count() <= 1)
                @include('st_pegawai.lampiran_2')

                @elseif ($stPegawai->pegawais->count() >= 4)
                @include('st_pegawai.lampiran_3')

                @else
                @include('st_pegawai.lampiran_1')

                @endif
            </td>
        </tr>
        <br>
        <tr style="vertical-align: top">
            <td>Untuk</td>
            <td>:</td>
            <td>
                Melaksanakan {{ $stPegawai->nama_kegiatan }} yang akan dilaksanakan pada :<br><br>
                Hari/tanggal <span>:</span>
                @if ($stPegawai->tgl_kegiatan != $stPegawai->tgl_akhir_kegiatan)
                    {{ Carbon\carbon::parse($stPegawai->tgl_kegiatan)->translatedFormat('l') }} - {{ Carbon\carbon::parse($stPegawai->tgl_akhir_kegiatan)->translatedFormat('l') }}/ {{ Carbon\carbon::parse($stPegawai->tgl_kegiatan)->translatedFormat('d-m-Y') }} s.d. {{ Carbon\carbon::parse($stPegawai->tgl_akhir_kegiatan)->translatedFormat('d-m-Y') }} <br>
                @else
                    {{ Carbon\carbon::parse($stPegawai->tgl_kegiatan)->translatedFormat('l') }}/  {{ Carbon\carbon::parse($stPegawai->tgl_akhir_kegiatan)->translatedFormat('d-m-Y') }} <br>
                @endif
                
                Pukul <span style="padding-left: 43px">:</span> {{ Carbon\Carbon::parse($stPegawai->jam_kegiatan )->format('H:i')}} WIB s.d Selesai
                <br>
                Tempat <span style="padding-left: 32px">:</span> {{ $stPegawai->tempat_kegiatan }}
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td style="text-align: justify; vertical-align:top" colspan="3">
                <ol style="padding-left: 20px; text-align: justify;vertical-align: top">
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt, magnam?</li>
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, quam ipsa?</li>
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis similique dolore sed!</li>
                </ol>
            </td>
        </tr>
    </table>
    @if($stPegawai->pegawais->isNotEmpty())
        @php
            $firstPegawai = $stPegawai->pegawais->first();
            $namaParts = explode(' ', $firstPegawai->jabatan);
            $firstName = $namaParts[0];
            $lastName = isset($namaParts[1]) ? $namaParts[1] : '';
        @endphp
        {{-- {{ $firstName }}  --}}
        {{-- {{ $lastName }} --}}
        @if ($firstName == 'Kepala')
        <p style="text-align: center;padding-left:300px">
            {{ $stPegawai->tempat_ditetapkan }}, {{ Carbon\Carbon::parse($stPegawai->tgl_ditetapkan)->translatedFormat('d F Y') }}
            <br>
            {{ $kpaJabatan }}
            <br>
            <br>
            <br>
            <br>
            {{ $kpaNama}}
            <br>
            NIP. {{ $kpaNip }}
        </p>
        @else
        <p style="text-align: center;padding-left:300px">
            {{ $stPegawai->tempat_ditetapkan }}, {{ Carbon\Carbon::parse($stPegawai->tgl_ditetapkan)->translatedFormat('d F Y') }}
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
        @endif
    @else
        - 
    @endif
    
</div>