@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Surat Izin Pegawai</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('surat_izin_pegawai.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="pegawais_id">Pegawai</label>
            <select name="pegawais_id" id="pegawais_id" class="form-control" required>
                <option value="">Pilih Pegawai</option>
                @foreach($pegawais as $pegawai)
                <option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="jam">Jam</label>
            <input type="time" name="jam" id="jam" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="keperluan">Keperluan</label>
            <select name="keperluan" id="keperluan" class="form-control" required>
                <option value="Pribadi">Pribadi</option>
                <option value="Dinas">Dinas</option>
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="keterlambatan">Keterlambatan</option>
                <option value="meninggalkan">Meninggalkan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('surat_izin_pegawai.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection