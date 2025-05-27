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
                <div class="card-header">{{ __('Tambah Data Rincian') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('rincian_surat.store') }}">
                        @csrf 

                        <!-- Pegawai Field -->
                        <div class="form-group row">
                            <label for="st_pegawai_id" class="col-md-4 col-form-label text-md-right">{{ __('Pegawai') }}</label>
                            <div class="col-md-6">
                                <select id="st_pegawai_id" name="st_pegawai_id[]" class="form-control select2 @error('pegawai') is-invalid @enderror" multiple="multiple" required>
                                    <!-- Loop Through Employees -->
                                    @foreach ($stPegawai as $st)
                                        <option value="{{ $st->id }}">{{ $st->nama_kegiatan }}</option>
                                    @endforeach
                                </select>

                                <!-- Helper Text -->
                                <small class="form-text text-muted">{{ __('Pilih satu atau lebih st.') }}</small>

                                <!-- Error Handling -->
                                @error('st_pegawai_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                         <!-- biaya_transportasi Field -->
                        <div class="form-group row">
                            <label for="biaya_transportasi" class="col-md-4 col-form-label text-md-right">{{ __('Biaya Transportasi') }}</label>
                            <div class="col-md-6">
                                <input id="biaya_transportasi" type="number" step="0.01" class="form-control @error('biaya_transportasi') is-invalid @enderror" name="biaya_transportasi" value="{{ old('biaya_transportasi') }}" autocomplete="biaya_transportasi" autofocus>
                                @error('biaya_transportasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- biaya_penginapan Field -->
                        <div class="form-group row">
                            <label for="biaya_penginapan" class="col-md-4 col-form-label text-md-right">{{ __('Biaya Penginapan') }}</label>
                            <div class="col-md-6">
                                <input id="biaya_penginapan" type="number" step="0.01" class="form-control @error('biaya_penginapan') is-invalid @enderror" name="biaya_penginapan" value="{{ old('biaya_penginapan') }}" autocomplete="biaya_penginapan" autofocus>
                                @error('biaya_penginapan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- biaya_tiket Field -->
                        <div class="form-group row">
                            <label for="biaya_tiket" class="col-md-4 col-form-label text-md-right">{{ __('Biaya Tiket') }}</label>
                            <div class="col-md-6">
                                <input id="biaya_tiket" type="number" step="0.01" class="form-control @error('biaya_tiket') is-invalid @enderror" name="biaya_tiket" value="{{ old('biaya_tiket') }}" autocomplete="biaya_tiket" autofocus>
                                @error('biaya_tiket')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- transport_lokal Field -->
                        <div class="form-group row">
                            <label for="transport_lokal" class="col-md-4 col-form-label text-md-right">{{ __('Transport Lokal') }}</label>
                            <div class="col-md-6">
                                <input id="transport_lokal" type="number" step="0.01" class="form-control @error('transport_lokal') is-invalid @enderror" name="transport_lokal" value="{{ old('transport_lokal') }}" autocomplete="transport_lokal" autofocus>
                                @error('transport_lokal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- uang_makan Field -->
                        <div class="form-group row">
                            <label for="uang_makan" class="col-md-4 col-form-label text-md-right">{{ __('Uang Makan') }}</label>
                            <div class="col-md-6">
                                <input id="uang_makan" type="number" step="0.01" class="form-control @error('uang_makan') is-invalid @enderror" name="uang_makan" value="{{ old('uang_makan') }}" autocomplete="uang_makan" autofocus>
                                @error('uang_makan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- uang_saku Field -->
                        <div class="form-group row">
                            <label for="uang_saku" class="col-md-4 col-form-label text-md-right">{{ __('Uang Saku') }}</label>
                            <div class="col-md-6">
                                <input id="uang_saku" type="number" step="0.01" class="form-control @error('uang_saku') is-invalid @enderror" name="uang_saku" value="{{ old('uang_saku') }}" autocomplete="uang_saku" autofocus>
                                @error('uang_saku')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- uang_representasi Field -->
                        <div class="form-group row">
                            <label for="uang_representasi" class="col-md-4 col-form-label text-md-right">{{ __('Uang Representasi') }}</label>
                            <div class="col-md-6">
                                <input id="uang_representasi" type="number" step="0.01" class="form-control @error('uang_representasi') is-invalid @enderror" name="uang_representasi" value="{{ old('uang_representasi') }}" autocomplete="uang_representasi" autofocus>
                                @error('uang_representasi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- uang_kediklatan Field -->
                        <div class="form-group row">
                            <label for="uang_kediklatan" class="col-md-4 col-form-label text-md-right">{{ __('Uang Kediklatan') }}</label>
                            <div class="col-md-6">
                                <input id="uang_kediklatan" type="number" step="0.01" class="form-control @error('uang_kediklatan') is-invalid @enderror" name="uang_kediklatan" value="{{ old('uang_kediklatan') }}" autocomplete="uang_kediklatan" autofocus>
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
                                <input id="korek" type="text" step="0.01" class="form-control @error('korek') is-invalid @enderror" name="korek" value="{{ old('korek') }}" autocomplete="korek" autofocus>
                                @error('korek')
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