@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Sisa Cuti</h1>

    <form action="{{ route('sisa_cuti.update', $sisaCuti->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <label for="pegawai_id" class="col-md-2 col-form-label">Pegawai</label>
            <div class="col-md-10">
                <select name="pegawai_id" id="pegawai_id" class="form-control" required>
                    <option value="">Pilih Pegawai</option>
                    @foreach ($pegawais as $pegawai)
                    <option value="{{ $pegawai->id }}" {{ $sisaCuti->pegawai_id == $pegawai->id ? 'selected' : '' }}>{{ $pegawai->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="sisa_tahun_n" class="col-md-2 col-form-label">Sisa Tahun N</label>
            <div class="col-md-10">
                <input type="number" name="sisa_tahun_n" id="sisa_tahun_n" class="form-control" value="{{ old('sisa_tahun_n', $sisaCuti->sisa_tahun_n) }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="sisa_tahun_n_1" class="col-md-2 col-form-label">Sisa Tahun N-1</label>
            <div class="col-md-10">
                <input type="number" name="sisa_tahun_n_1" id="sisa_tahun_n_1" class="form-control" value="{{ old('sisa_tahun_n_1', $sisaCuti->sisa_tahun_n_1) }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="sisa_tahun_n_2" class="col-md-2 col-form-label">Sisa Tahun N-2</label>
            <div class="col-md-10">
                <input type="number" name="sisa_tahun_n_2" id="sisa_tahun_n_2" class="form-control" value="{{ old('sisa_tahun_n_2', $sisaCuti->sisa_tahun_n_2) }}" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('sisa_cuti.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection