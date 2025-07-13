<!DOCTYPE html>
<html>

<head>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        .page-break {
            page-break-after: always;
        }

        .image-container {
            display: inline-block;
            width: 48%;
            box-sizing: border-box;
            padding: 5px;
            page-break-inside: avoid;
            vertical-align: top;
        }

        .image-container img {
            width: 300px;
            height: 400px;
            display: inline-block;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <p style="text-transform: uppercase;text-align:center">
        <b>
            FOTO KEGIATAN : {{ $st_surat->nama_kegiatan }} <br>
            tanggal :
            @if ($st_surat->tgl_awal == $st_surat->tgl_akhir)
            {{ \Carbon\Carbon::parse($st_surat->tgl_awal)->translatedFormat('l/ d-m-Y') }}
            @else
            {{ \Carbon\Carbon::parse($st_surat->tgl_awal)->format('d/m/Y') }} s.d. {{
            \Carbon\Carbon::parse($st_surat->tgl_akhir)->format('d/m/Y') }}
            @endif
        </b>
    </p>
    <div class="page-break">
        @foreach ($photo as $item)
        <div class="image-container">
            <img src="{{ public_path('uploads/' . $item->photo) }}" alt="photo st_surat">
        </div>
        @endforeach
    </div>
</body>

</html>