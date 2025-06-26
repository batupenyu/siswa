@extends('layouts.app')

@section('content')
    <h1>Tambah Photo untuk Surat ID: {{ $st_surat_id }}</h1>

    <form action="{{ route('photo_surat.store', $st_surat_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="photo">Pilih photo</label>
            <input type="file" name="photo[]" id="photo" multiple class="form-control-file" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
@endsection