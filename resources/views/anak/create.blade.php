@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Tambah Data Anak</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('anak.store') }}" method="POST">
        @csrf

        <div class="mb-3 row">
            <label for="pegawais_id" class="col-sm-2 col-form-label">Pegawai:</label>
            <div class="col-sm-10">
                <select class="form-select" id="pegawais_id" name="pegawais_id" required>
                    <option value="">-- Pilih Pegawai --</option>
                    @foreach ($pegawais as $pegawai)
                        <option value="{{ $pegawai->id }}" {{ old('pegawais_id') == $pegawai->id ? 'selected' : '' }}>
                            {{ $pegawai->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir:</label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="status_pekerjaan" class="col-sm-2 col-form-label">Status Pekerjaan:</label>
            <div class="col-sm-10">
                <select class="form-select" id="status_pekerjaan" name="status_pekerjaan" required>
                    <option value="bekerja" {{ old('status_pekerjaan') == 'bekerja' ? 'selected' : '' }}>Bekerja</option>
                    <option value="belum bekerja" {{ old('status_pekerjaan') == 'belum bekerja' ? 'selected' : '' }}>Belum Bekerja</option>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="status_pernikahan" class="col-sm-2 col-form-label">Status Pernikahan:</label>
            <div class="col-sm-10">
                <select class="form-select" id="status_pernikahan" name="status_pernikahan" required>
                    <option value="menikah" {{ old('status_pernikahan') == 'menikah' ? 'selected' : '' }}>Menikah</option>
                    <option value="belum menikah" {{ old('status_pernikahan') == 'belum menikah' ? 'selected' : '' }}>Belum Menikah</option>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="status_tanggungan" class="col-sm-2 col-form-label">Status Tanggungan:</label>
            <div class="col-sm-10">
                <select class="form-select" id="status_tanggungan" name="status_tanggungan" required>
                    <option value="ya" {{ old('status_tanggungan') == 'ya' ? 'selected' : '' }}>Ya</option>
                    <option value="tidak" {{ old('status_tanggungan') == 'tidak' ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="pendidikan" class="col-sm-2 col-form-label">Pendidikan:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="pendidikan" name="pendidikan" value="{{ old('pendidikan') }}" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="nama_sekolah" class="col-sm-2 col-form-label">Nama Sekolah:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" value="{{ old('nama_sekolah') }}" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>

    <a href="{{ route('anak.index') }}" class="btn btn-link mt-3">Kembali ke Daftar Anak</a>
</div>
@endsection
