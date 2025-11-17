@extends('layouts.app')

@section('content')
<style>
    label.col-form-label {
        text-align: left !important;
        display: block;
        font-weight: bold;
    }
</style>
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
                        <div class="mb-3 row align-items-center">
                            <label for="nama" class="col-md-4 col-form-label">Nama</label>
                            <div class="col-md-8">
                                <input type="text" name="nama" id="nama"
                                    class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
                                @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="nip" class="col-md-4 col-form-label">NIP</label>
                            <div class="col-md-8">
                                <input type="text" name="nip" id="nip"
                                    class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}">
                                @error('nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row align-items-center">
                            <label for="nip" class="col-md-4 col-form-label">Jabatan</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ old('jabatan', $pegawai->jabatan ?? '') }}" required>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="pangkat" class="col-md-4 col-form-label">Pangkat</label>
                            <div class="col-md-8">
                                <select name="pangkat" id="pangkat"
                                    class="form-select @error('pangkat') is-invalid @enderror">
                                    <option value="">-- Pilih Pangkat --</option>
                                    <option value="IX" {{ old('pangkat')=='IX' ? 'selected' : '' }}>IX</option>
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
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="status_kepegawaian" class="col-md-4 col-form-label">Status Kepegawaian</label>
                            <div class="col-md-8">
                                <select name="status_kepegawaian" id="status_kepegawaian" class="form-select @error('status_kepegawaian') is-invalid @enderror">
                                    <option value="">-- Pilih Status Kepegawaian --</option>
                                    <option value="PNS" {{ old('status_kepegawaian') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                    <option value="PPPK" {{ old('status_kepegawaian') == 'PPPK' ? 'selected' : '' }}>PPPK</option>
                                    <option value="Honor" {{ old('status_kepegawaian') == 'Honor' ? 'selected' : '' }}>Honor</option>
                                    <option value="-" {{ old('status_kepegawaian') == '-' ? 'selected' : '' }}>-</option>
                                </select>
                                @error('status_kepegawaian')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="integrasi" class="col-md-4 col-form-label">Ak Integrasi</label>
                            <div class="col-md-8">
                                <input type="text" name="integrasi" id="integrasi"
                                    class="form-control @error('integrasi') is-invalid @enderror"
                                    value="{{ old('integrasi') }}">
                                @error('integrasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="no_karpeg" class="col-md-4 col-form-label">No Karpeg</label>
                            <div class="col-md-8">
                                <input type="text" name="no_karpeg" id="no_karpeg"
                                    class="form-control @error('no_karpeg') is-invalid @enderror"
                                    value="{{ old('no_karpeg') }}">
                                @error('no_karpeg')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="alamat" class="col-md-4 col-form-label">Alamat</label>
                            <div class="col-md-8">
                                <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="mb-3 row align-items-center">
                            <label for="jenis_kelamin" class="col-md-4 col-form-label">Jenis Kelamin</label>
                            <div class="col-md-8">
                                <select name="jenis_kelamin" id="jenis_kelamin"
                                    class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin')=='Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki
                                    </option>
                                    <option value="Perempuan" {{ old('jenis_kelamin')=='Perempuan' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>
                                </select>
                                @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="tgl_lahir" class="col-md-4 col-form-label">Tanggal Lahir</label>
                            <div class="col-md-8">
                                <input type="date" name="tgl_lahir" id="tgl_lahir"
                                    class="form-control @error('tgl_lahir') is-invalid @enderror"
                                    value="{{ old('tgl_lahir') }}">
                                @error('tgl_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="tempat_lahir" class="col-md-4 col-form-label">Tempat Lahir</label>
                            <div class="col-md-8">
                                <input type="text" name="tempat_lahir" id="tempat_lahir"
                                    class="form-control @error('tempat_lahir') is-invalid @enderror"
                                    value="{{ old('tempat_lahir') }}">
                                @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="tgl_tmt_jabatan" class="col-md-4 col-form-label">TMT Jabatan</label>
                            <div class="col-md-8">
                                <input type="date" name="tgl_tmt_jabatan" id="tgl_tmt_jabatan"
                                    class="form-control @error('tgl_tmt_jabatan') is-invalid @enderror"
                                    value="{{ old('tgl_tmt_jabatan') }}">
                                @error('tgl_tmt_jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="tgl_tmt_pangkat" class="col-md-4 col-form-label">TMT Pangkat</label>
                            <div class="col-md-8">
                                <input type="date" name="tgl_tmt_pangkat" id="tgl_tmt_pangkat"
                                    class="form-control @error('tgl_tmt_pangkat') is-invalid @enderror"
                                    value="{{ old('tgl_tmt_pangkat') }}">
                                @error('tgl_tmt_pangkat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="tgl_tmt_cpns" class="col-md-4 col-form-label">TMT CPNS</label>
                            <div class="col-md-8">
                                <input type="date" name="tgl_tmt_cpns" id="tgl_tmt_cpns" class="form-control @error('tgl_tmt_cpns') is-invalid @enderror" value="{{ old('tgl_tmt_cpns') }}">
                                @error('tgl_tmt_cpns')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="agama" class="col-md-4 col-form-label">Agama</label>
                            <div class="col-md-8">
                                <select name="agama" id="agama" class="form-select @error('agama') is-invalid @enderror">
                                    <option value="">-- Pilih Agama --</option>
                                    <option value="islam" {{ old('agama')=='islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="kristen" {{ old('agama')=='kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="protestan" {{ old('agama')=='protestan' ? 'selected' : '' }}>Protestan</option>
                                    <option value="hindu" {{ old('agama')=='hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="budha" {{ old('agama')=='budha' ? 'selected' : '' }}>Budha</option>
                                    <option value="konghucu" {{ old('agama')=='konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                                @error('agama')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
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