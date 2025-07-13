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
            FOTO KEGIATAN : {{ $surat->nama_kegiatan }} <br> 
            tanggal {{ \Carbon\Carbon::parse($surat->tgl_kegiatan)->format('d/m/Y') }} s.d. {{ \Carbon\Carbon::parse($surat->tgl_akhir_kegiatan)->format('d/m/Y') }}
        </b>
    </p>
    <div class="page-break">
        @foreach ($gambar as $item)
            <div class="image-container">
                <img src="{{ public_path('uploads/' . $item->gambar) }}" alt="Gambar Surat">
            </div>
        @endforeach
    </div>
</body>
</html>
