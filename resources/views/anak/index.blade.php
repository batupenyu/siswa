@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h1>Daftar Anak</h1>
    <form method="GET" action="{{ route('anak.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari nama anak..." value="{{ request('search') }}">
            <input type="text" name="pegawai_nama" class="form-control" placeholder="Cari nama pegawai..." value="{{ request('pegawai_nama') }}">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
    </form>

    <a href="{{ route('anak.create') }}" class="btn btn-primary mb-3">Tambah Anak</a>
    <table class="table table-sm table-striped" style="font-size: 12pt;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Anak</th>
                <th>Nama Pegawai</th>
                <th>Tanggal Lahir</th>
                <th>Umur</th>
                <th>Tempat Lahir</th>
                <th>Status Pekerjaan</th>
                <th>Status Pernikahan</th>
                <th>Pendidikan</th>
                <th>Nama Sekolah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anakList as $anak)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $anak->nama }}</td>
                <td>{{ $anak->pegawai->nama ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($anak->tgl_lahir)->translatedFormat('d-m-Y') }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($anak->tgl_lahir)->age }}
                    @if(\Carbon\Carbon::parse($anak->tgl_lahir)->age > 21)
                    th
                    <i class="bi bi-x-circle-fill text-danger" title="Age =< 21"></i>
                    @else
                    th
                    <i class="bi bi-check-circle-fill text-success" title="Age > 21"></i>
                    @endif
                </td>
                <td>{{ $anak->tempat_lahir }}</td>
                <td>{{ $anak->status_pekerjaan }}</td>
                <td>{{ $anak->status_pernikahan }}</td>
                <td>{{ $anak->pendidikan }}</td>
                <td>{{ $anak->nama_sekolah }}</td>
                <td>
                    <a href="{{ route('anak.pdf', $anak->pegawais_id) }}" title="Print"><i class="bi bi-printer"></i></a>
                    <a href="{{ route('anak.edit', $anak->id) }}" title="Edit"><i class="bi bi-pencil-square"></i></a>
                    <form action="{{ route('anak.destroy', $anak->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Delete" class="btn btn-link p-0 m-0 text-danger" style="background:none; border:none; cursor:pointer;">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $anakList->links() }}
</div>
@endsection