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
                <div class="card-header">{{ __('Tambah Data') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('st-pegawai.store') }}">
                        @csrf

                        <!-- Pegawai Field -->
                        <div class="form-group row">
                            <label for="pegawai_id" class="col-md-4 col-form-label text-md-right">{{ __('Pegawai')
                                }}</label>
                            <div class="col-md-6">
                                <select id="pegawai_id" name="pegawai_id[]"
                                    class="form-control select2 @error('pegawai') is-invalid @enderror"
                                    multiple="multiple" required>
                                    <!-- Loop Through Employees -->
                                    @foreach ($pegawais as $pegawai)
                                    <option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
                                    @endforeach
                                </select>

                                <!-- Helper Text -->
                                <small class="form-text text-muted">{{ __('Pilih satu atau lebih pegawai.') }}</small>

                                <!-- Error Handling -->
                                @error('pegawai_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

<<<<<<< HEAD
=======
                        <!-- No Surat Field -->
                        <div class="form-group row">
                            <label for="no_surat" class="col-md-4 col-form-label text-md-right">{{ __('No. Surat')
                                }}</label>
                            <div class="col-md-6">
                                <input id="no_surat" type="text"
                                    class="form-control @error('no_surat') is-invalid @enderror" name="no_surat"
                                    value="{{ old('no_surat') }}" required autocomplete="no_surat" autofocus>
                                @error('no_surat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

>>>>>>> 0da78d7 (commit)
                        <!-- Siswa Field -->

                        <script>
                            $(document).ready(function () {
                                $('#pegawai_id').select2({
                                    placeholder: "Select Pegawai", // Placeholder text
                                    allowClear: true, // Allow clearing the selection
                                });
                            });
                        </script>


                        <!-- Dasar Surat Field -->
                        <div class="form-group row">
                            <label for="dasar_surat" class="col-md-4 col-form-label text-md-right">{{ __('Dasar Surat')
                                }}</label>
                            <div class="col-md-6">
                                <input id="dasar_surat" type="text"
                                    class="form-control @error('dasar_surat') is-invalid @enderror" name="dasar_surat"
                                    value="{{ old('dasar_surat') }}" required autocomplete="dasar_surat" autofocus>
                                @error('dasar_surat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Tanggal Awal Field -->
                        <div class="form-group row">
                            <label for="tgl_awal" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Awal')
                                }}</label>
                            <div class="col-md-6">
                                <input id="tgl_awal" type="date"
                                    class="form-control @error('tgl_awal') is-invalid @enderror" name="tgl_awal"
                                    value="{{ old('tgl_awal') }}" required autocomplete="tgl_awal">
                                @error('tgl_awal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Tanggal Akhir Field -->
                        <div class="form-group row">
                            <label for="tgl_akhir" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Akhir')
                                }}</label>
                            <div class="col-md-6">
                                <input id="tgl_akhir" type="date"
                                    class="form-control @error('tgl_akhir') is-invalid @enderror" name="tgl_akhir"
                                    value="{{ old('tgl_akhir') }}" required autocomplete="tgl_akhir">
                                @error('tgl_akhir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Nama Kegiatan Field -->
                        <div class="form-group row">
                            <label for="nama_kegiatan" class="col-md-4 col-form-label text-md-right">{{ __('Nama
                                Kegiatan') }}</label>
                            <div class="col-md-6">
                                <textarea id="nama_kegiatan" type="text"
                                    class="form-control @error('nama_kegiatan') is-invalid @enderror"
                                    name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" required
                                    autocomplete="nama_kegiatan"></textarea>
                                @error('nama_kegiatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Tanggal Kegiatan Field -->
                        <div class="form-group row">
                            <label for="tgl_kegiatan" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal
                                Kegiatan') }}</label>
                            <div class="col-md-6">
                                <input id="tgl_kegiatan" type="date"
                                    class="form-control @error('tgl_kegiatan') is-invalid @enderror" name="tgl_kegiatan"
                                    value="{{ old('tgl_kegiatan') }}" required autocomplete="tgl_kegiatan">
                                @error('tgl_kegiatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Jam Kegiatan Field -->
                        <div class="form-group row">
                            <label for="jam_kegiatan" class="col-md-4 col-form-label text-md-right">{{ __('Jam
                                Kegiatan') }}</label>
                            <div class="col-md-6">
                                <input id="jam_kegiatan" type="time"
                                    class="form-control @error('jam_kegiatan') is-invalid @enderror" name="jam_kegiatan"
                                    value="{{ old('jam_kegiatan') }}" required autocomplete="jam_kegiatan">
                                @error('jam_kegiatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <!-- Tempat Kegiatan Ditetapkan Field -->
                        <div class="form-group row">
                            <label for="tempat_kegiatan" class="col-md-4 col-form-label text-md-right">{{ __('Tempat
                                Kegiatan') }}</label>
                            <div class="col-md-6">
                                <textarea id="tempat_kegiatan" type="date"
                                    class="form-control @error('tempat_kegiatan') is-invalid @enderror"
                                    name="tempat_kegiatan" value="" required
                                    autocomplete="tempat_kegiatan">{{ old('tempat_kegiatan') }}</textarea>
                                @error('tempat_kegiatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <!-- Tanggal Ditetapkan Field -->
                        <div class="form-group row">
                            <label for="tgl_ditetapkan" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal
                                Ditetapkan') }}</label>
                            <div class="col-md-6">
                                <input id="tgl_ditetapkan" type="date"
                                    class="form-control @error('tgl_ditetapkan') is-invalid @enderror"
                                    name="tgl_ditetapkan" value="{{ old('tgl_ditetapkan') }}" required
                                    autocomplete="tgl_ditetapkan">
                                @error('tgl_ditetapkan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Tempat Ditetapkan Field -->
                        <div class="form-group row">
                            <label for="tempat_ditetapkan" class="col-md-4 col-form-label text-md-right">{{ __('Tempat
                                Ditetapkan') }}</label>
                            <div class="col-md-6">
                                <input id="tempat_ditetapkan" type="text"
                                    class="form-control @error('tempat_ditetapkan') is-invalid @enderror"
                                    name="tempat_ditetapkan" value="{{ old('tempat_ditetapkan') }}" required
                                    autocomplete="tempat_ditetapkan">
                                @error('tempat_ditetapkan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <!-- biaya_transportasi Field -->
                        <div class="form-group row">
                            <label for="biaya_transportasi" class="col-md-4 col-form-label text-md-right">{{ __('Biaya
                                Transportasi') }}</label>
                            <div class="col-md-6">
                                <input id="biaya_transportasi" type="number" step="0.01"
                                    class="form-control @error('biaya_transportasi') is-invalid @enderror"
                                    name="biaya_transportasi" value="{{ old('biaya_transportasi') }}"
                                    autocomplete="biaya_transportasi">
                                @error('biaya_transportasi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- biaya_penginapan Field -->
                        <div class="form-group row">
                            <label for="biaya_penginapan" class="col-md-4 col-form-label text-md-right">{{ __('Biaya
                                Penginapan') }}</label>
                            <div class="col-md-6">
                                <input id="biaya_penginapan" type="number" step="0.01"
                                    class="form-control @error('biaya_penginapan') is-invalid @enderror"
                                    name="biaya_penginapan" value="{{ old('biaya_penginapan') }}"
                                    autocomplete="biaya_penginapan">
                                @error('biaya_penginapan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- biaya_tiket Field -->
                        <div class="form-group row">
                            <label for="biaya_tiket" class="col-md-4 col-form-label text-md-right">{{ __('Biaya Tiket')
                                }}</label>
                            <div class="col-md-6">
                                <input id="biaya_tiket" type="number" step="0.01"
                                    class="form-control @error('biaya_tiket') is-invalid @enderror" name="biaya_tiket"
                                    value="{{ old('biaya_tiket') }}" autocomplete="biaya_tiket">
                                @error('biaya_tiket')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- transport_lokal Field -->
                        <div class="form-group row">
                            <label for="transport_lokal" class="col-md-4 col-form-label text-md-right">{{ __('Transport
                                Lokal') }}</label>
                            <div class="col-md-6">
                                <input id="transport_lokal" type="number" step="0.01"
                                    class="form-control @error('transport_lokal') is-invalid @enderror"
                                    name="transport_lokal" value="{{ old('transport_lokal') }}"
                                    autocomplete="transport_lokal">
                                @error('transport_lokal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- uang_makan Field -->
                        <div class="form-group row">
                            <label for="uang_makan" class="col-md-4 col-form-label text-md-right">{{ __('Uang Makan')
                                }}</label>
                            <div class="col-md-6">
                                <input id="uang_makan" type="number" step="0.01"
                                    class="form-control @error('uang_makan') is-invalid @enderror" name="uang_makan"
                                    value="{{ old('uang_makan') }}" autocomplete="uang_makan">
                                @error('uang_makan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- uang_saku Field -->
                        <div class="form-group row">
                            <label for="uang_saku" class="col-md-4 col-form-label text-md-right">{{ __('Uang Saku')
                                }}</label>
                            <div class="col-md-6">
                                <input id="uang_saku" type="number" step="0.01"
                                    class="form-control @error('uang_saku') is-invalid @enderror" name="uang_saku"
                                    value="{{ old('uang_saku') }}" autocomplete="uang_saku">
                                @error('uang_saku')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- uang_representasi Field -->
                        <div class="form-group row">
                            <label for="uang_representasi" class="col-md-4 col-form-label text-md-right">{{ __('Uang
                                Representasi') }}</label>
                            <div class="col-md-6">
                                <input id="uang_representasi" type="number" step="0.01"
                                    class="form-control @error('uang_representasi') is-invalid @enderror"
                                    name="uang_representasi" value="{{ old('uang_representasi') }}"
                                    autocomplete="uang_representasi">
                                @error('uang_representasi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- uang_kediklatan Field -->
                        <div class="form-group row">
                            <label for="uang_kediklatan" class="col-md-4 col-form-label text-md-right">{{ __('Uang
                                Kediklatan') }}</label>
                            <div class="col-md-6">
                                <input id="uang_kediklatan" type="number" step="0.01"
                                    class="form-control @error('uang_kediklatan') is-invalid @enderror"
                                    name="uang_kediklatan" value="{{ old('uang_kediklatan') }}"
                                    autocomplete="uang_kediklatan">
                                @error('uang_kediklatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- korek Field -->
                        <div class="form-group row">
                            <label for="korek" class="col-md-4 col-form-label text-md-right">{{ __('Korek') }}</label>
                            <div class="col-md-6">
                                <input id="korek" type="text" step="0.01"
                                    class="form-control @error('korek') is-invalid @enderror" name="korek"
                                    value="{{ old('korek') }}" autocomplete="korek">
                                @error('korek')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Maksud Tujuan Field -->
                        <div class="form-group row">
                            <label for="maksud_tujuan" class="col-md-4 col-form-label text-md-right">{{ __('Maksud
                                Tujuan') }}</label>
                            <div class="col-md-6">
                                <textarea id="maksud_tujuan"
                                    class="form-control @error('maksud_tujuan') is-invalid @enderror"
                                    name="maksud_tujuan">{{ old('maksud_tujuan') }}</textarea>
                                @error('maksud_tujuan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Materi Narsum Field -->
                        <div class="form-group row">
                            <label for="materi_narsum" class="col-md-4 col-form-label text-md-right">{{ __('Materi
                                Narsum') }}</label>
                            <div class="col-md-6">
                                <textarea id="materi_narsum"
                                    class="form-control @error('materi_narsum') is-invalid @enderror"
                                    name="materi_narsum">{{ old('materi_narsum') }}</textarea>
                                @error('materi_narsum')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Hasil Field -->
                        <div class="form-group row">
                            <label for="hasil" class="col-md-4 col-form-label text-md-right">{{ __('Hasil') }}</label>
                            <div class="col-md-6">
                                <textarea id="hasil" class="form-control @error('hasil') is-invalid @enderror"
                                    name="hasil">{{ old('hasil') }}</textarea>
                                @error('hasil')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Kesimpulan Field -->
                        <div class="form-group row">
                            <label for="kesimpulan" class="col-md-4 col-form-label text-md-right">{{ __('Kesimpulan')
                                }}</label>
                            <div class="col-md-6">
                                <textarea id="kesimpulan" class="form-control @error('kesimpulan') is-invalid @enderror"
                                    name="kesimpulan">{{ old('kesimpulan') }}</textarea>
                                @error('kesimpulan')
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
                                    {{ __('Submit') }}
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