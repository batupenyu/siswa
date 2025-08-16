@extends('layouts.app')

@section('title', 'Create KPA')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Create KPA</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('kpa.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="pangkat" class="form-label">Pangkat</label>
                        <input type="text" class="form-control" id="pangkat" name="pangkat" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="unitkerja" class="form-label">Unit Kerja</label>
                        <input type="text" class="form-control" id="unitkerja" name="unitkerja" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="instansi" class="form-label">Instansi</label>
                        <input type="text" class="form-control" id="instansi" name="instansi" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('kpa.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection