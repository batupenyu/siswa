@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Cuti</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('cuti.update', $cuti->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="pegawais_id">Pegawai</label>
                    <select name="pegawais_id" id="pegawais_id" class="form-control" required>
                        <option value="">Pilih Pegawai</option>
                        @foreach($pegawais as $pegawai)
                        <option value="{{ $pegawai->id }}" {{ old('pegawais_id', $cuti->pegawais_id) == $pegawai->id ? 'selected' : '' }}>{{ $pegawai->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="penilai_id">Penilai</label>
                    <select name="penilai_id" id="penilai_id" class="form-control" required>
                        <option value="">Pilih Penilai</option>
                        @foreach($penilais as $penilai)
                        <option value="{{ $penilai->id }}" {{ old('penilai_id', $cuti->penilai_id) == $penilai->id ? 'selected' : '' }}>{{ $penilai->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="kpa_id">KPA</label>
                    <select name="kpa_id" id="kpa_id" class="form-control" required>
                        <option value="">Pilih KPA</option>
                        @foreach($kpas as $kpa)
                        <option value="{{ $kpa->id }}" {{ old('kpa_id', $cuti->kpa_id) == $kpa->id ? 'selected' : '' }}>{{ $kpa->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="jenis_cuti">Jenis Cuti</label>
                    <select name="jenis_cuti" id="jenis_cuti" class="form-control" required>
                        <option value="">Pilih Jenis Cuti</option>
                        <option value="tahunan" {{ old('jenis_cuti', $cuti->jenis_cuti) == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                        <option value="besar" {{ old('jenis_cuti', $cuti->jenis_cuti) == 'besar' ? 'selected' : '' }}>Besar</option>
                        <option value="sakit" {{ old('jenis_cuti', $cuti->jenis_cuti) == 'sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="melahirkan" {{ old('jenis_cuti', $cuti->jenis_cuti) == 'melahirkan' ? 'selected' : '' }}>Melahirkan</option>
                        <option value="alasan_penting" {{ old('jenis_cuti', $cuti->jenis_cuti) == 'alasan_penting' ? 'selected' : '' }}>Alasan Penting</option>
                        <option value="luar_tanggungan" {{ old('jenis_cuti', $cuti->jenis_cuti) == 'luar_tanggungan' ? 'selected' : '' }}>Luar Tanggungan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="sisa_cuti_n">Sisa Cuti Tahun n</label>
                    <input type="number" name="sisa_cuti_n" id="sisa_cuti_n" class="form-control" value="{{ old('sisa_cuti_n', $cuti->sisa_cuti_n) }}">
                </div>

                <div class="form-group">
                    <label for="sisa_cuti_n_1">Sisa Cuti Tahun n-1</label>
                    <input type="number" name="sisa_cuti_n_1" id="sisa_cuti_n_1" class="form-control" value="{{ old('sisa_cuti_n_1', $cuti->sisa_cuti_n_1) }}">
                </div>

                <div class="form-group">
                    <label for="sisa_cuti_n_2">Sisa Cuti Tahun n-2</label>
                    <input type="number" name="sisa_cuti_n_2" id="sisa_cuti_n_2" class="form-control" value="{{ old('sisa_cuti_n_2', $cuti->sisa_cuti_n_2) }}">
                </div>

                <div class="form-group">
                    <label for="status_penilai">Status Penilai</label>
                    <select name="status_penilai" id="status_penilai" class="form-control">
                        <option value="">Pilih Status Penilai</option>
                        <option value="disetujui" {{ old('status_penilai', $cuti->status_penilai) == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="perubahan" {{ old('status_penilai', $cuti->status_penilai) == 'perubahan' ? 'selected' : '' }}>Perubahan</option>
                        <option value="ditangguhkan" {{ old('status_penilai', $cuti->status_penilai) == 'ditangguhkan' ? 'selected' : '' }}>Ditangguhkan</option>
                        <option value="tidak_disetujui" {{ old('status_penilai', $cuti->status_penilai) == 'tidak_disetujui' ? 'selected' : '' }}>Tidak Disetujui</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="status_kpa">Status KPA</label>
                    <select name="status_kpa" id="status_kpa" class="form-control">
                        <option value="">Pilih Status KPA</option>
                        <option value="disetujui" {{ old('status_kpa', $cuti->status_kpa) == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="perubahan" {{ old('status_kpa', $cuti->status_kpa) == 'perubahan' ? 'selected' : '' }}>Perubahan</option>
                        <option value="ditangguhkan" {{ old('status_kpa', $cuti->status_kpa) == 'ditangguhkan' ? 'selected' : '' }}>Ditangguhkan</option>
                        <option value="tidak_disetujui" {{ old('status_kpa', $cuti->status_kpa) == 'tidak_disetujui' ? 'selected' : '' }}>Tidak Disetujui</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="alasan">Alasan</label>
                    <textarea name="alasan" id="alasan" class="form-control" required>{{ old('alasan', $cuti->alasan) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="lama_cuti">Lama Cuti (hari)</label>
                    <input type="number" name="lama_cuti" id="lama_cuti" class="form-control" value="{{ old('lama_cuti', $cuti->lama_cuti) }}" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_mulai">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $cuti->tanggal_mulai) }}" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_selesai">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $cuti->tanggal_selesai) }}" required>
                </div>

                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="text" name="telepon" id="telepon" class="form-control" value="{{ old('telepon', $cuti->telepon) }}" required>
                </div>

                <div class="form-group">
                    <label for="alamat_selama_cuti">Alamat Selama Cuti</label>
                    <textarea name="alamat_selama_cuti" id="alamat_selama_cuti" class="form-control" required>{{ old('alamat_selama_cuti', $cuti->alamat_selama_cuti) }}</textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('cuti.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
@endsection