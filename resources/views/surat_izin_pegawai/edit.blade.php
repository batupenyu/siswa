@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Surat Izin Pegawai</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('surat_izin_pegawai.update', $suratIzinPegawai->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group row" style="padding-bottom: 5px;">
            <label for="pegawais_id" class="col-sm-2 col-form-label">Pegawai</label>
            <div class="col-sm-10">
                <select name="pegawais_id" id="pegawais_id" class="form-control" required>
                    @foreach($pegawais as $pegawai)
                    <option value="{{ $pegawai->id }}" {{ $suratIzinPegawai->pegawais_id == $pegawai->id ? 'selected' : '' }}>
                        {{ $pegawai->nama }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row" style="padding-bottom: 5px;">
            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
            <div class="col-sm-10">
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $suratIzinPegawai->tanggal }}" required>
            </div>
        </div>

        <div class="form-group row" style="padding-bottom: 5px;">
            <label for="jam" class="col-sm-2 col-form-label">Jam</label>
            <div class="col-sm-10">
                <input type="time" name="jam" id="jam" class="form-control" value="{{ $suratIzinPegawai->jam }}" required>
            </div>
        </div>

        <div class="form-group row" style="padding-bottom: 5px;">
            <label for="keperluan" class="col-sm-2 col-form-label">Keperluan</label>
            <div class="col-sm-10">
                <select name="keperluan" id="keperluan" class="form-control" required>
                    <option value="Dinas" {{ $suratIzinPegawai->keperluan == 'Dinas' ? 'selected' : '' }}>Dinas</option>
                    <option value="Pribadi" {{ $suratIzinPegawai->keperluan == 'Pribadi' ? 'selected' : '' }}>Pribadi</option>
                </select>
            </div>
        </div>

        <div class="form-group row" style="padding-bottom: 5px;">
            <label for="status" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
                <select name="status" id="status" class="form-control" required>
                    <option value="keterlambatan" {{ $suratIzinPegawai->status == 'keterlambatan' ? 'selected' : '' }}>Keterlambatan</option>
                    <option value="meninggalkan" {{ $suratIzinPegawai->status == 'meninggalkan' ? 'selected' : '' }}>Meninggalkan</option>
                </select>
            </div>
        </div>

        <div class="form-group row" style="padding-bottom: 5px;">
            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
            <div class="col-sm-10">
                <input type="text" name="keterangan" id="keterangan" class="form-control" value="{{ $suratIzinPegawai->keterangan }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('surat_izin_pegawai.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection