@extends('layouts.app')

@section('content')
<h4>Foto Kegiatan :
    @if($st_surat->tgl_awal == $st_surat->tgl_akhir)
    {{ $st_surat->nama_kegiatan ?? '' }} Tanggal {{ \Carbon\Carbon::parse($st_surat->tgl_awal)->format('d-m-Y') ?? '' }}
    @else
    {{ $st_surat->nama_kegiatan ?? '' }} Tanggal {{ \Carbon\Carbon::parse($st_surat->tgl_awal)->format('d-m-Y') ?? '' }} s.d. {{ \Carbon\Carbon::parse($st_surat->tgl_akhir)->format('d-m-Y') ?? '' }}
    @endif
</h4>
@if ($photo->isEmpty())
<p>No images found for this surat ID.</p>
@endif

<a href="{{ route('photo_surat.create', $st_surat_id) }}" class="btn btn-primary">Tambah photo</a>
<a href="{{ route('photo_surat.printPdf', $st_surat_id) }}" class="btn btn-secondary ms-2">Print to PDF</a>

<div class="row mt-4">
    @foreach ($photo as $item)
    <div class="col-md-3">
        <!-- Display the image -->
        <img src="{{ asset('uploads/' . $item->photo) }}" class="img-fluid mb-2" alt="photo {{ $item->id }}">

        <!-- Delete form -->
        <form action="{{ route('photo_surat.destroy', ['st_surat_id' => $st_surat_id, 'photo' => $item->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus photo ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
        </form>
    </div>
    @endforeach
</div>
@endsection