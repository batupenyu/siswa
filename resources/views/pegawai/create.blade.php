@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Tambah Pegawai</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('pegawais.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" id="nama"
                                class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" name="nip" id="nip"
                                class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}">
                            @error('nip')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan"
                                class="form-control @error('jabatan') is-invalid @enderror"
                                value="{{ old('jabatan') }}">
                            @error('jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pangkat" class="form-label">Pangkat</label>
                            <select name="pangkat" id="pangkat"
                                class="form-select @error('pangkat') is-invalid @enderror">
                                <option value="">-- Pilih Pangkat --</option>
                                <option value="III/a" {{ old('pangkat')=='III/a' ? 'selected' : '' }}>III/a</option>
                                <option value="III/b" {{ old('pangkat')=='III/b' ? 'selected' : '' }}>III/b</option>
                                <option value="III/c" {{ old('pangkat')=='III/c' ? 'selected' : '' }}>III/c</option>
                                <option value="III/d" {{ old('pangkat')=='III/d' ? 'selected' : '' }}>III/d</option>
                                <option value="IV/a" {{ old('pangkat')=='IV/a' ? 'selected' : '' }}>IV/a</option>
                                <option value="IV/b" {{ old('pangkat')=='IV/b' ? 'selected' : '' }}>IV/b</option>
                                <option value="IV/c" {{ old('pangkat')=='IV/c' ? 'selected' : '' }}>IV/c</option>
                            </select>
                            @error('pangkat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="integrasi" class="form-label">Ak Integrasi</label>
                            <input type="text" name="integrasi" id="integrasi"
                                class="form-control @error('integrasi') is-invalid @enderror"
                                value="{{ old('integrasi') }}">
                            @error('integrasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_karpeg" class="form-label">No Karpeg</label>
                            <input type="text" name="no_karpeg" id="no_karpeg"
                                class="form-control @error('no_karpeg') is-invalid @enderror"
                                value="{{ old('no_karpeg') }}">
                            @error('no_karpeg')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin"
                                class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="L" {{ old('jenis_kelamin')=='L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin')=='P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" id="tgl_lahir"
                                class="form-control @error('tgl_lahir') is-invalid @enderror"
                                value="{{ old('tgl_lahir') }}">
                            @error('tgl_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir"
                                class="form-control @error('tempat_lahir') is-invalid @enderror"
                                value="{{ old('tempat_lahir') }}">
                            @error('tempat_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tgl_tmt_jabatan" class="form-label">TMT Jabatan</label>
                            <input type="date" name="tgl_tmt_jabatan" id="tgl_tmt_jabatan"
                                class="form-control @error('tgl_tmt_jabatan') is-invalid @enderror"
                                value="{{ old('tgl_tmt_jabatan') }}">
                            @error('tgl_tmt_jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tgl_tmt_pangkat" class="form-label">TMT Pangkat</label>
                            <input type="date" name="tgl_tmt_pangkat" id="tgl_tmt_pangkat"
                                class="form-control @error('tgl_tmt_pangkat') is-invalid @enderror"
                                value="{{ old('tgl_tmt_pangkat') }}">
                            @error('tgl_tmt_pangkat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                    <a href="{{ route('pegawais.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection