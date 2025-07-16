@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h1>Tambah Pasangan</h1>
    <form action="{{ route('pasangan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="pegawais_id" class="form-label">Nama Pegawai</label>
            <select name="pegawais_id" id="pegawais_id" class="form-select" required>
                <option value="">Pilih Pegawai</option>
                @foreach ($pegawais as $pegawai)
                    <option value="{{ $pegawai->id }}" {{ old('pegawais_id') == $pegawai->id ? 'selected' : '' }}>{{ $pegawai->nama }}</option>
                @endforeach
            </select>
            @error('pegawais_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pasangan</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
            @error('nama')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}" required>
            @error('tempat_lahir')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" value="{{ old('tgl_lahir') }}" required>
            @error('tgl_lahir')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tgl_perkawinan" class="form-label">Tanggal Perkawinan</label>
            <input type="date" name="tgl_perkawinan" id="tgl_perkawinan" class="form-control" value="{{ old('tgl_perkawinan') }}" required>
            @error('tgl_perkawinan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="pekerjaan" class="form-label">Pekerjaan</label>
            <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" value="{{ old('pekerjaan') }}" required>
            @error('pekerjaan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
            <select name="status_pernikahan" id="status_pernikahan" class="form-select" required>
                <option value="">Pilih Status Pernikahan</option>
                <option value="menikah" {{ old('status_pernikahan') == 'menikah' ? 'selected' : '' }}>Menikah</option>
                <option value="belum menikah" {{ old('status_pernikahan') == 'belum menikah' ? 'selected' : '' }}>Belum Menikah</option>
            </select>
            @error('status_pernikahan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="status_tunjangan" class="form-label">Status Tunjangan</label>
            <select name="status_tunjangan" id="status_tunjangan" class="form-select" required>
                <option value="">Pilih Status Tunjangan</option>
                <option value="ya" {{ old('status_tunjangan') == 'ya' ? 'selected' : '' }}>Ya</option>
                <option value="tidak" {{ old('status_tunjangan') == 'tidak' ? 'selected' : '' }}>Tidak</option>
            </select>
            @error('status_tunjangan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('pasangan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
