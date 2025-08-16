@extends('layouts.app')

@section('title', 'Edit Penilai')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Edit Penilai</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('penilai.update', $penilai->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $penilai->nama }}"
                            required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan"
                            value="{{ $penilai->jabatan }}" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" value="{{ $penilai->nip }}"
                            required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="pangkat" class="form-label">Pangkat</label>
                        <input type="text" class="form-control" id="pangkat" name="pangkat"
                            value="{{ $penilai->pangkat }}" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="unitkerja" class="form-label">Unit Kerja</label>
                        <input type="text" class="form-control" id="unitkerja" name="unitkerja"
                            value="{{ $penilai->unitkerja }}" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="instansi" class="form-label">Instansi</label>
                        <input type="text" class="form-control" id="instansi" name="instansi"
                            value="{{ $penilai->instansi }}" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('penilai.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection