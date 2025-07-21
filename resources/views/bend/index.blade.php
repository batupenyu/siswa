@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Bend</h1>

    <a href="{{ route('bends.create') }}" class="btn btn-primary mb-3">Tambah Bend Baru</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Bendahara</th>
                <th>Pegawai</th>
                <th style="text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bends as $bend)
            <tr>
                <td>{{ $bend->id }}</td>
                <td>{{ $bend->bendahara }}</td>
                <td>{{ $bend->pegawai->nama ?? '-' }}</td>
                <td style="text-align: center;">
                    <a href="{{ route('bends.show', $bend->id) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('bends.edit', $bend->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('bends.destroy', $bend->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">Tidak ada data bend.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $bends->links() }}
</div>
@endsection