@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Cuti</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('cuti.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="pegawais_id">Pegawai</label>
                    <select name="pegawais_id" id="pegawais_id" class="form-control" required>
                        <option value="">Pilih Pegawai</option>
                        @foreach($pegawais as $pegawai)
                        <option value="{{ $pegawai->id }}" {{ old('pegawais_id') == $pegawai->id ? 'selected' : '' }}>{{ $pegawai->nama }}</option>
                        @endforeach
                    </select>
                </div>



                <div class="form-group">
                    <label for="jenis_cuti">Jenis Cuti</label>
                    <select name="jenis_cuti" id="jenis_cuti" class="form-control" required>
                        <option value="">Pilih Jenis Cuti</option>
                        <option value="tahunan" {{ old('jenis_cuti') == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                        <option value="besar" {{ old('jenis_cuti') == 'besar' ? 'selected' : '' }}>Besar</option>
                        <option value="sakit" {{ old('jenis_cuti') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="melahirkan" {{ old('jenis_cuti') == 'melahirkan' ? 'selected' : '' }}>Melahirkan</option>
                        <option value="alasan_penting" {{ old('jenis_cuti') == 'alasan_penting' ? 'selected' : '' }}>Alasan Penting</option>
                        <option value="luar_tanggungan" {{ old('jenis_cuti') == 'luar_tanggungan' ? 'selected' : '' }}>Luar Tanggungan</option>
                    </select>
                </div>

                <!-- Removed sisa_cuti fields -->
                <!-- <div class="form-group row">
                    <label for="sisa_cuti_n" class="col-md-4 col-form-label">Sisa Cuti Tahun n</label>
                    <div class="col-md-8">
                        <input type="number" name="sisa_cuti_n" id="sisa_cuti_n" class="form-control" value="{{ old('sisa_cuti_n') }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sisa_cuti_n_1" class="col-md-4 col-form-label">Sisa Cuti Tahun n-1</label>
                    <div class="col-md-8">
                        <input type="number" name="sisa_cuti_n_1" id="sisa_cuti_n_1" class="form-control" value="{{ old('sisa_cuti_n_1') }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sisa_cuti_n_2" class="col-md-4 col-form-label">Sisa Cuti Tahun n-2</label>
                    <div class="col-md-8">
                        <input type="number" name="sisa_cuti_n_2" id="sisa_cuti_n_2" class="form-control" value="{{ old('sisa_cuti_n_2') }}" readonly>
                    </div>
                </div> -->

                <div class="form-group">
                    <label for="status_penilai">Status Penilai</label>
                    <select name="status_penilai" id="status_penilai" class="form-control">
                        <option value="">Pilih Status Penilai</option>
                        <option value="disetujui" {{ old('status_penilai') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="perubahan" {{ old('status_penilai') == 'perubahan' ? 'selected' : '' }}>Perubahan</option>
                        <option value="ditangguhkan" {{ old('status_penilai') == 'ditangguhkan' ? 'selected' : '' }}>Ditangguhkan</option>
                        <option value="tidak_disetujui" {{ old('status_penilai') == 'tidak_disetujui' ? 'selected' : '' }}>Tidak Disetujui</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status_kpa">Status KPA</label>
                    <select name="status_kpa" id="status_kpa" class="form-control">
                        <option value="">Pilih Status KPA</option>
                        <option value="disetujui" {{ old('status_kpa') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="perubahan" {{ old('status_kpa') == 'perubahan' ? 'selected' : '' }}>Perubahan</option>
                        <option value="ditangguhkan" {{ old('status_kpa') == 'ditangguhkan' ? 'selected' : '' }}>Ditangguhkan</option>
                        <option value="tidak_disetujui" {{ old('status_kpa') == 'tidak_disetujui' ? 'selected' : '' }}>Tidak Disetujui</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">

                <div class="form-group">
                    <label for="alasan">Alasan</label>
                    <textarea name="alasan" id="alasan" class="form-control" required>{{ old('alasan') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="lama_cuti">Lama Cuti (hari)</label>
                    <input type="number" name="lama_cuti" id="lama_cuti" class="form-control" value="{{ old('lama_cuti') }}" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_mulai">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai') }}" required>
                </div>

                <div class="form-group">
                    <label for="tanggal_selesai">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai') }}" required>
                </div>

                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="text" name="telepon" id="telepon" class="form-control" value="{{ old('telepon') }}" required>
                </div>

                <div class="form-group">
                    <label for="alamat_selama_cuti">Alamat Selama Cuti</label>
                    <textarea name="alamat_selama_cuti" id="alamat_selama_cuti" class="form-control" required>{{ old('alamat_selama_cuti') }}</textarea>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        <a href="{{ route('cuti.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
@endsection