@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Sisa Cuti</h1>

    <a href="{{ route('sisa_cuti.create') }}" class="btn btn-primary mb-3">Tambah Sisa Cuti</a>

    <form method="GET" action="{{ route('sisa_cuti.index') }}" class="mb-3">
        <input type="text" name="search" placeholder="Cari Pegawai" value="{{ $search }}">
        <button type="submit" class="btn btn-secondary">Cari</button>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pegawai</th>
                <th>Sisa Tahun N</th>
                <th>Sisa Tahun N-1</th>
                <th>Sisa Tahun N-2</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sisaCutis as $sisaCuti)
            <tr>
                <td>{{ $sisaCuti->pegawai->nama ?? 'N/A' }}</td>
                <td>{{ $sisaCuti->sisa_tahun_n }}</td>
                <td>{{ $sisaCuti->sisa_tahun_n_1 }}</td>
                <td>{{ $sisaCuti->sisa_tahun_n_2 }}</td>
                <td>
                    <a href="{{ route('sisa_cuti.edit', $sisaCuti->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('sisa_cuti.destroy', $sisaCuti->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @if($sisaCutis->isEmpty())
            <tr>
                <td colspan="5" class="text-center">Data tidak ditemukan</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
