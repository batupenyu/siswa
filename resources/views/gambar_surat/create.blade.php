@extends('layouts.app')

@section('content')
    <h1>Tambah Gambar untuk Surat ID: {{ $surat_id }}</h1>

    <form action="{{ route('gambar_surat.store', $surat_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="gambar">Pilih Gambar</label>
            <input type="file" name="gambar[]" id="gambar" multiple class="form-control-file" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
@endsection