@extends('layouts.app')

@section('content')
<h3 style="text-align: center">SURAT IZIN PEGAWAI</h3>
<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('surat_izin_pegawai.create') }}" class="btn btn-success">Tambah Surat Izin</a>
</div>
<div class="container">
    <form method="GET" action="{{ route('surat_izin_pegawai.index') }}" class="row g-3 mb-3">
        <div class="col-auto">
            <label for="nama" class="col-form-label">Nama</label>
        </div>
        <div class="col-auto">
            <input type="text" id="nama" name="nama" class="form-control" value="{{ request('nama') }}"
                placeholder="Cari nama pegawai">
        </div>
        <div class="col-auto">
            <label for="start_date" class="col-form-label">Tanggal Mulai</label>
        </div>
        <div class="col-auto">
            <input type="date" id="start_date" name="start_date" class="form-control"
                value="{{ request('start_date') }}">
        </div>
        <div class="col-auto">
            <label for="end_date" class="col-form-label">Tanggal Akhir</label>
        </div>
        <div class="col-auto">
            <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Filter</button>
            <a href="{{ route('surat_izin_pegawai.index') }}" class="btn btn-secondary mb-3">Reset</a>
        </div>
    </form>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Pegawai</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Status</th>
                <th>Keperluan</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suratIzinPegawais as $surat)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}.</td>
                <td>{{ $surat->pegawai->nama ?? '-' }}<a href="{{ route('pegawais.edit', $surat->pegawai->id ?? 0) }}">
                        <i class="bi-pen-fill"></i></a>
                </td>
                <td>{{ \Carbon\Carbon::parse($surat->tanggal)->locale('id')->translatedFormat('d/m/Y') }}</td>
                <td>{{ $surat->jam }}</td>
                <td>{{ ucfirst($surat->status) }}</td>
                <td>{{ $surat->keperluan }}</td>
                <td>{{ $surat->keterangan }}</td>
                <td>
                    {{-- <a href="{{ route('surat_izin_pegawai.show', $surat->id) }}"
                        class="btn btn-info btn-sm">View</a> --}}
                    <a href="{{ route('surat_izin_pegawai.edit', $surat->id) }}" class="btn btn-warning btn-sm"
                        title="Edit">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <form action="{{ route('surat_izin_pegawai.destroy', $surat->id) }}" method="POST"
                        style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                    <a href="{{ route('surat_izin_pegawai.pdf', $surat->id) }}" class="btn btn-secondary btn-sm"
                        title="View PDF" target="_blank">
                        <i class="bi bi-file-earmark-pdf"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $suratIzinPegawais->links() }}
</div>
@endsection