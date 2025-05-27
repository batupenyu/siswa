@extends('layouts.app')

@section('title', 'Daftar Dispensasi')

@section('content')
<div class="container mt-4">
    <div class="card" style="max-width: 900px; margin: auto;">
        <div class="card-header">
            <h4>Daftar Dispensasi</h4>
            <a href="{{ route('dispensasi.create') }}" class="btn btn-primary float-right">Tambah Dispensasi</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($dispensasi->isEmpty())
                <p>Tidak ada data dispensasi.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal Kegiatan</th>
                            <th>Waktu Kegiatan</th>
                            <th>Tanggal Ditetapkan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dispensasi as $item)
                        <tr>
                            <td>{{ $loop->iteration + ($dispensasi->currentPage() - 1) * $dispensasi->perPage() }}</td>
                            <td>{{ $item->nama_kegiatan }}</td>
                            <td>{{ $item->tgl_kegiatan }}</td>
                            <td>{{ $item->waktu_kegiatan }}</td>
                            <td>{{ $item->tgl_ditetapkan }}</td>
                            <td>
                                <a href="{{ route('dispensasi.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="{{ route('dispensasi.pdf', $item->id) }}" target="_blank" class="btn btn-sm btn-info" title="View PDF">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                </a>
                                <form action="{{ route('dispensasi.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this dispensasi?')" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $dispensasi->links() }}
            @endif
        </div>
    </div>
</div>
@endsection
