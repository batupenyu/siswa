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
        <div class="form-group">
            <label for="pegawais_id">Pegawai</label>
            <select name="pegawais_id" id="pegawais_id" class="form-control" required>
                @foreach($pegawais as $pegawai)
                <option value="{{ $pegawai->id }}" {{ $suratIzinPegawai->pegawais_id == $pegawai->id ? 'selected' : ''
                    }}>
                    {{ $pegawai->nama }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $suratIzinPegawai->tanggal }}"
                required>
        </div>

        <div class="form-group">
            <label for="jam">Jam</label>
            <input type="time" name="jam" id="jam" class="form-control" value="{{ $suratIzinPegawai->jam }}" required>
        </div>

        <div class="form-group">
            <label for="keperluan">Keperluan</label>
            <select name="keperluan" id="keperluan" class="form-control" required>
                <option value="Dinas" {{ $suratIzinPegawai->keperluan == 'Dinas' ? 'selected' : '' }}>Dinas</option>
                <option value="Pribadi" {{ $suratIzinPegawai->keperluan == 'Pribadi' ? 'selected' : '' }}>Pribadi
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="keterlambatan" {{ $suratIzinPegawai->status == 'keterlambatan' ? 'selected' : ''
                    }}>Keterlambatan</option>
                <option value="meninggalkan" {{ $suratIzinPegawai->status == 'meninggalkan' ? 'selected' : ''
                    }}>Meninggalkan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" class="form-control"
                value="{{ $suratIzinPegawai->keterangan }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('surat_izin_pegawai.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection