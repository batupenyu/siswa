@extends('layouts.app')
@section('content')

<style>
    @media print {
        body {
            font-size: 12pt;
        }

        .printable-image {
            max-width: 100%;
            height: auto;
        }

        .print-page {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
    }
</style>

<h3>Data Surat Tugas</h3>
{{-- <button class="btn btn-secondary mb-3" onclick="printImages()">Print All Images</button> --}}
<a href="{{ route('surats.create') }}" class="btn btn-primary mb-3">Tambah Data</a>


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<table class="table" style="font-size: 10pt" id="suratTable">
    <thead>
        <tr style="vertical-align: top">
            <th>#</th>
            <th>Nama siswa</th>
            <th>Jumlah <br> Peserta</th>
            <th>Dasar Surat</th>
            <th>Awal <br> Kegiatan</th>
            <th>Akhir <br> Kegiatan</th>
            <th>Lama <br> Kegiatan</th>
            <th>Tempat <br> Kegiatan</th>
            <th>Waktu <br> Kegiatan</th>
            <th>Ditetapkan <br>Tanggal</th>
            <th>Dasar Surat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($surats as $surat)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                @if($surat->siswa->isNotEmpty())
                {{ $surat->siswa->pluck('name')->implode(', ') }}
                @endif
            </td>
            <td>
                <?php 
                        echo (count($surat->siswa));
                        echo ' ('.\App\Helpers\NumberHelper::terbilang(count($surat->siswa)).') org';
                        ?>
            </td>
            <td>{{ $surat->dasar_surat }}</td>
            <td>{{ Carbon\Carbon::parse($surat->tgl_kegiatan)->format('d/m/Y') }}</td>
            <td>{{ Carbon\Carbon::parse($surat->tgl_akhir_kegiatan)->format('d/m/Y') }}</td>
            <td>{{ Carbon\Carbon::parse($surat->tgl_kegiatan)->diffInDays($surat->tgl_akhir_kegiatan) + 1 }} Hari</td>
            <td>{{ $surat->tempat_kegiatan }}</td>
            <td>{{ Carbon\Carbon::parse($surat->jam_kegiatan)->format('H:i') }}</td>
            <td>{{ Carbon\Carbon::parse($surat->tgl_ditetapkan)->format('d/m/Y') }}</td>

            <td>
                @if($surat->file)
                <a href="{{ asset('storage/'.$surat->file) }}" target="_blank">Dasar Surat</a>
                <form action="{{ route('surats.upload', $surat->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file">
                    <button type="submit" class="btn btn-primary btn-sm">Reupload File</button>
                </form>
                @else
                <form action="{{ route('surats.upload', $surat->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file">
                    <button type="submit" class="btn btn-primary btn-sm">Upload File</button>
                </form>
                @endif
            </td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                        id="dropdownMenuButton-{{ $surat->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi-three-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $surat->id }}">
                        <a href="{{ route('gambar_surat.index', $surat->id) }}" class="dropdown-item"><i
                                class="bi-file-pdf"></i> Photo</a>
                        <a href="{{ route('surats.pdf', $surat->id) }}" class="dropdown-item"><i
                                class="bi-file-pdf"></i>
                            Pdf</a>
                        <a href="{{ route('surats.edit', $surat->id) }}" class="dropdown-item"><i
                                class="bi bi-list-check"></i>
                            Edit</a>
                        <form action="{{ route('surats.destroy', $surat->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <i class="bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- JavaScript for printing the table -->
<script>
    function printImages(suratId) {
            const container = document.getElementById(`image-container-${suratId}`);
            if (!container) return alert('No images found');

            const images = container.querySelectorAll('.printable-image');
            if (images.length === 0) return alert('No images found');

            const imageUrls = Array.from(images).map(img => img.src);

            const printWindow = window.open('', '_blank');
            let printContent = `
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Print Images</title>
                    <style>
                        body { margin: 0; padding: 10px; }
                        .print-page { display: flex; flex-wrap: wrap; gap: 10px; }
                        .print-img { width: 200px; height: auto; border: 1px solid #ddd; }
                    </style>
                </head>
                <body>
                    <div class="print-page">
            `;

            imageUrls.forEach(url => {
                printContent += `<img class="print-img" src="${url}">`;
            });

            printContent += `
                    </div>
                </body>
                </html>
            `;

            printWindow.document.open();
            printWindow.document.write(printContent);
            printWindow.document.close();

            setTimeout(() => {
                printWindow.print();
                printWindow.close();
            }, 500);
        }

        // Function to print all images
        function printImages() {
            const images = document.querySelectorAll('.printable-image');
            if (images.length === 0) {
                alert('Tidak ada gambar yang tersedia untuk dicetak.');
                return;
            }

            // Create a new window for printing
            const printWindow = window.open('', '_blank');
            
            // Start building the print document
            let printContent = `
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Cetak Gambar</title>
                    <style>
                        body { margin: 0; padding: 10px; }
                        .print-page { display: flex; flex-wrap: wrap; gap: 10px; }
                        .print-img { width: 200px; height: auto; border: 1px solid #ddd; }
                    </style>
                </head>
                <body>
                    <div class="print-page">
            `;

            // Add all images to the print content
            images.forEach(img => {
                printContent += `<img class="print-img" src="${img.src}">`;
            });

            // Close the HTML structure
            printContent += `
                    </div>
                </body>
                </html>
            `;

            // Write and print the content
            printWindow.document.open();
            printWindow.document.write(printContent);
            printWindow.document.close();
            
            // Wait for images to load before printing
            printWindow.onload = function() {
                setTimeout(() => {
                    printWindow.print();
                    printWindow.close();
                }, 500);
            };
        }

        // Function to print images from a single row
        function printSingleImage(suratId) {
            const container = document.getElementById(`image-container-${suratId}`);
            if (!container) return alert('No images found');

            const images = container.querySelectorAll('.printable-image');
            if (images.length === 0) return alert('No images found');

            const printWindow = window.open('', '_blank');
            let printContent = `<html><head><title>Print Images</title><style>body{margin:0;padding:10px}</style></head><body>`;
            
            // Convert each image to canvas
            Array.from(images).forEach((img, index) => {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                canvas.width = img.naturalWidth;
                canvas.height = img.naturalHeight;
                ctx.drawImage(img, 0, 0);
                
                printContent += `<img src="${canvas.toDataURL('image/jpeg')}" style="max-width:200px;margin:5px;">`;
            });

            printContent += `</body></html>`;
            
            printWindow.document.open();
            printWindow.document.write(printContent);
            printWindow.document.close();
            
            setTimeout(() => {
                printWindow.print();
                printWindow.close();
            }, 1000);
        }
</script>

<style>
    .image-wrapper {
        position: relative;
        display: inline-block;
        margin-right: 5px;
        margin-bottom: 5px;
    }

    .image-wrapper button {
        position: absolute;
        top: -10px;
        right: -10px;
        width: 20px;
        height: 20px;
        padding: 0;
        line-height: 1;
        border-radius: 50%;
        font-size: 12px;
    }
</style>
@endsection