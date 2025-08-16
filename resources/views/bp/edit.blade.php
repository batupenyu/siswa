@extends('layouts.app')

@section('title', 'Edit BP')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Edit BP</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('bp.update', $bp->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $bp->nama }}" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $bp->jabatan }}"
                            required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" value="{{ $bp->nip }}" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="pangkat" class="form-label">Pangkat</label>
                        <input type="text" class="form-control" id="pangkat" name="pangkat" value="{{ $bp->pangkat }}"
                            required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="unitkerja" class="form-label">Unit Kerja</label>
                        <input type="text" class="form-control" id="unitkerja" name="unitkerja"
                            value="{{ $bp->unitkerja }}" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="instansi" class="form-label">Instansi</label>
                        <input type="text" class="form-control" id="instansi" name="instansi"
                            value="{{ $bp->instansi }}" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('bp.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection