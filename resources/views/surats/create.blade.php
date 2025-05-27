@extends('layouts.app')

<!-- In the <head> section of your layout file -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Before the closing </body> tag -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    .select2-multiple {
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 5px;
}

.select2-multiple .form-check {
    margin-bottom: 10px;
}

.select2-multiple .form-check-label {
    font-weight: normal;
}
</style>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Data Surat</div>
    
                    <div class="card-body">
                        <form action="{{ route('surats.store') }}" method="POST">
                            @csrf

                            <!-- Siswa Field -->
                            <div class="form-group row">
                                <label for="siswas_id" class="col-md-4 col-form-label text-md-right">Siswa</label>
                                <div class="col-md-6">
                                    <select id="siswas_id" name="siswas_id[]" class="form-control select2 @error('siswas_id') is-invalid @enderror" multiple="multiple" required>
                                        @foreach ($siswas as $siswa)
                                            <option value="{{ $siswa->id }}" {{ (collect(old('siswas_id'))->contains($siswa->id)) ? 'selected' : '' }}>
                                                {{ $siswa->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('siswas_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <script>
                                $(document).ready(function () {
                                    $('#siswas_id').select2({
                                        placeholder: "Select Pegawai", // Placeholder text
                                        allowClear: true, // Allow clearing the selection
                                    });
                                });
                            </script>

                            <div class="form-group row">
                                <label for="dasar_surat" class="col-md-4 col-form-label text-md-right">Dasar Surat</label>
                                <div class="col-md-6">
                                    <textarea id="dasar_surat" class="form-control @error('dasar_surat') is-invalid @enderror" name="dasar_surat" required>{{ old('dasar_surat') }}</textarea>
                                    @error('dasar_surat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama_kegiatan" class="col-md-4 col-form-label text-md-right">Nama Kegiatan</label>
                                <div class="col-md-6">
                                    <textarea id="nama_kegiatan" class="form-control @error('nama_kegiatan') is-invalid @enderror" name="nama_kegiatan" required>{{ old('nama_kegiatan') }}</textarea>
                                    @error('nama_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tgl_kegiatan" class="col-md-4 col-form-label text-md-right">Tanggal Kegiatan</label>
                                <div class="col-md-6">
                                    <input id="tgl_kegiatan" type="date" class="form-control @error('tgl_kegiatan') is-invalid @enderror" name="tgl_kegiatan" value="{{ old('tgl_kegiatan') }}" required>
                                    @error('tgl_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tgl_akhir_kegiatan" class="col-md-4 col-form-label text-md-right">Tanggal Akhir Kegiatan</label>
                                <div class="col-md-6">
                                    <input id="tgl_akhir_kegiatan" type="date" class="form-control @error('tgl_akhir_kegiatan') is-invalid @enderror" name="tgl_akhir_kegiatan" value="{{ old('tgl_akhir_kegiatan') }}" required>
                                    @error('tgl_akhir_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tempat_kegiatan" class="col-md-4 col-form-label text-md-right">Tempat Kegiatan</label>
                                <div class="col-md-6">
                                    <input id="tempat_kegiatan" type="text" class="form-control @error('tempat_kegiatan') is-invalid @enderror" name="tempat_kegiatan" value="{{ old('tempat_kegiatan') }}" required>
                                    @error('tempat_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Jam Kegiatan Field -->
                            <div class="form-group row">
                                <label for="jam_kegiatan" class="col-md-4 col-form-label text-md-right">Jam Kegiatan</label>
                                <div class="col-md-6">
                                    <input id="jam_kegiatan" type="time" class="form-control @error('jam_kegiatan') is-invalid @enderror" name="jam_kegiatan" value="{{ old('jam_kegiatan') }}" required>
                                    @error('jam_kegiatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tanggal Ditetapkan Field -->
                            <div class="form-group row">
                                <label for="tgl_ditetapkan" class="col-md-4 col-form-label text-md-right">Tanggal Ditetapkan</label>
                                <div class="col-md-6">
                                    <input id="tgl_ditetapkan" type="date" class="form-control @error('tgl_ditetapkan') is-invalid @enderror" name="tgl_ditetapkan" value="{{ old('tgl_ditetapkan') }}" required>
                                    @error('tgl_ditetapkan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tempat Ditetapkan Field -->
                            <div class="form-group row">
                                <label for="ditetapkan_di" class="col-md-4 col-form-label text-md-right">Ditetapkan Di</label>
                                <div class="col-md-6">
                                    <input id="ditetapkan_di" type="text" class="form-control @error('ditetapkan_di') is-invalid @enderror" name="ditetapkan_di" value="{{ old('ditetapkan_di') }}" required>
                                    @error('ditetapkan_di')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group row mt-2 mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

  



@endsection