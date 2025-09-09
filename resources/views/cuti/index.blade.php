@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Cuti</h1>
    <a href="{{ route('cuti.create') }}" class="btn btn-primary mb-3">Tambah Cuti</a>

    <form action="{{ route('cuti.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama pegawai..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
    </form>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pegawai</th>
                <th>Jenis Cuti</th>
                <!-- Removed Sisa Cuti N columns -->
                <!-- <th>Sisa Cuti N</th>
            <th>Sisa Cuti N-1</th>
            <th>Sisa Cuti N-2</th> -->
                <th>Status Penilai</th>
                <th>Status KPA</th>
                <th>Lama Cuti</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cuti as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->pegawai->nama ?? 'N/A' }}</td>
                <td>{{ $item->jenis_cuti }}</td>
                <!-- Removed sisa_cuti_n data -->
                <!-- <td>{{ $item->sisa_cuti_n ?? '-' }}</td>
                <td>{{ $item->sisa_cuti_n_1 ?? '-' }}</td>
                <td>{{ $item->sisa_cuti_n_2 ?? '-' }}</td> -->
                <td>{{ $item->status_penilai ?? '-' }}</td>
                <td>{{ $item->status_kpa ?? '-' }}</td>
                <td>{{ $item->lama_cuti }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('cuti.show', $item->id) }}" class="btn btn-info btn-sm" title="Lihat">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="{{ route('cuti.rekap_pegawai', $item->pegawais_id) }}" class="btn btn-secondary btn-sm" title="Rekap Cuti Pegawai">
                        <i class="bi bi-file-pdf"></i>
                    </a>
                    <a href="{{ route('cuti.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('cuti.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus cuti ini?')" title="Hapus">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection