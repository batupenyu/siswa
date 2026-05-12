@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Surat Panggilan Siswa (BK)</h4>
            <a href="{{ route('surat-panggilan.create') }}" class="btn btn-primary">Tambah</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nomor Surat</th>
                        <th>Tanggal Surat</th>
                        <th>Nama Siswa</th>
                        <th>Perihal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suratPanggilan as $item)
                    <tr>
                        <td>{{ $loop->iteration + ($suratPanggilan->currentPage() - 1) * $suratPanggilan->perPage() }}</td>
                        <td>{{ $item->nomor_surat }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_surat)->translatedFormat('d F Y') }}</td>
                        <td>{{ $item->nama_siswa }}</td>
                        <td>{{ $item->perihal }}</td>
                        <td>
                            <a href="{{ route('surat-panggilan.show', $item->id) }}" class="btn btn-sm btn-info" target="_blank">PDF</a>
                            <a href="{{ route('surat-panggilan.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('surat-panggilan.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus surat ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $suratPanggilan->links() }}
        </div>
    </div>
</div>
@endsection
