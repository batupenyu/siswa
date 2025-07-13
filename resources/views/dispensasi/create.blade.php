@extends('layouts.app')


<!-- In the <head> section of your layout file -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Before the closing </body> tag -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@section('title', 'Create Dispensasi')

@section('content')
<div class="container mt-4">
    <div class="card" style="max-width: 600px; margin: auto;">
        <div class="card-header">
            <h4>Create Dispensasi</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('dispensasi.store') }}" method="POST">
                @csrf

                <div class="form-group row mb-3">
                    <label for="siswas_id" class="col-form-label col-6" style="width: 50%;">Siswa ID</label>
                    <div class="col-6" style="width: 50%;">
                        <select name="siswas_id[]" id="siswas_id" class="form-control select2" multiple="multiple" style="width: 100%;">
                            @foreach(App\Models\Siswa::all() as $siswa)
                                <option value="{{ $siswa->id }}" {{ (collect(old('siswas_id'))->contains($siswa->id)) ? 'selected' : '' }}>{{ $siswa->name ?? $siswa->id }}</option>
                            @endforeach
                        </select>
                        @error('siswas_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>


                <script>
                    $(document).ready(function () {
                        $('#siswas_id').select2({
                            placeholder: "Select Siswa", // Placeholder text
                            allowClear: true, // Allow clearing the selection
                        });
                    });
                </script>

                <div class="form-group row mb-3">
                    <label for="nama_kegiatan" class="col-form-label col-6" style="width: 50%;">Nama Kegiatan</label>
                    <div class="col-6" style="width: 50%;">
                        <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" value="{{ old('nama_kegiatan') }}">
                        @error('nama_kegiatan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="tgl_kegiatan" class="col-form-label col-6" style="width: 50%;">Tanggal Kegiatan</label>
                    <div class="col-6" style="width: 50%;">
                        <input type="date" name="tgl_kegiatan" id="tgl_kegiatan" class="form-control" value="{{ old('tgl_kegiatan') }}">
                        @error('tgl_kegiatan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="waktu_kegiatan" class="col-form-label col-6" style="width: 50%;">Waktu Kegiatan</label>
                    <div class="col-6" style="width: 50%;">
                        <input type="time" name="waktu_kegiatan" id="waktu_kegiatan" class="form-control" value="{{ old('waktu_kegiatan') }}">
                        @error('waktu_kegiatan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="tgl_ditetapkan" class="col-form-label col-6" style="width: 50%;">Tanggal Ditetapkan</label>
                    <div class="col-6" style="width: 50%;">
                        <input type="date" name="tgl_ditetapkan" id="tgl_ditetapkan" class="form-control" value="{{ old('tgl_ditetapkan') }}">
                        @error('tgl_ditetapkan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('dispensasi.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
