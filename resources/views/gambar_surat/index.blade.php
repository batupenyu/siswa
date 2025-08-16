@extends('layouts.app')

@section('content')
    <h4>Foto Kegiatan : {{ $surat->nama_kegiatan ?? '' }} Tanggal {{ \Carbon\Carbon::parse($surat->tgl_kegiatan)->format('d-m-Y') ?? '' }} s.d. {{ \Carbon\Carbon::parse($surat->tgl_akhir_kegiatan)->format('d-m-Y') ?? '' }}</h4>
    @if ($gambar->isEmpty())
        <p>No images found for this surat ID.</p>
    @endif

    <a href="{{ route('gambar_surat.create', $surat_id) }}" class="btn btn-primary">Tambah Gambar</a>
    <a href="{{ route('gambar_surat.printPdf', $surat_id) }}" class="btn btn-secondary ms-2">Print to PDF</a>

    <div class="row mt-4">
    @foreach ($gambar as $item)
        <div class="col-md-3">
            <!-- Display the image -->
            <img src="{{ asset('uploads/' . $item->gambar) }}" class="img-fluid mb-2" alt="Gambar {{ $item->id }}">

            <!-- Delete form -->
            <form action="{{ route('gambar_surat.destroy', ['surat_id' => $surat_id, 'gambar' => $item->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus gambar ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
            </form>
        </div>
    @endforeach
</div>
@endsection