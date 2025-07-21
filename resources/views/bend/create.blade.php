@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Bend Baru</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('bends.store') }}" method="POST">
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
            <label for="bendahara">Bendahara</label>
            <select name="bendahara" id="bendahara" class="form-control" required>
                <option value="">Pilih Bendahara</option>
                <option value="ipp">IPP</option>
                <option value="apbn">APBN</option>
                <option value="apbd">APBD</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('bends.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection