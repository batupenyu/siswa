@extends('layouts.app')

@section('title', 'Siswa Profil List')


@section('content')
<div class="container">
    <h1>Siswa Profil List</h1>
    <div class="d-flex gap-2 mb-3 flex-wrap">
        <a href="{{ url('/siswa-profil/create') }}" class="btn btn-primary">Add New Siswa Profil</a>
        <a href="{{ route('siswa-profil.exportExcel') }}" class="btn btn-success">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </a>
        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal">
            <i class="bi bi-upload"></i> Import Excel
        </button>
    </div>

    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Excel Siswa Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('siswa-profil.importExcel') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif
                        <input type="file" name="file" class="form-control" accept=".xlsx,.xls,.csv" required>
                        <small class="text-muted">Format: .xlsx, .xls, .csv. Gunakan hasil export sebagai template.</small>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Search form for nama -->
    <form method="GET" action="{{ url('/siswa-profil') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search_nama" class="form-control" placeholder="Search by Nama Panggilan"
                value="{{ request('search_nama') }}">
            <button type="submit" class="btn btn-outline-secondary">Search</button>
        </div>
    </form>

    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Panggilan</th>
                <th>Jenis Kelamin</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Agama</th>
                <th>Kewarganegaraan</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswaProfils as $profil)
            <tr>
                <td>{{ $siswaProfils->firstItem() + $loop->index }}</td>
                <td>{{ \Illuminate\Support\Str::title($profil->nama_lengkap) }}</td>
                <td>{{ $profil->jenis_kelamin }}</td>
                <td>{{ $profil->tempat_tanggal_lahir }}</td>
                <td>{{ $profil->agama }}</td>
                <td>{{ \Illuminate\Support\Str::title($profil->kewarganegaraan) }}</td>
                <td>
                    <a href="{{ url('/siswa-profil/' . $profil->id) }}" class="btn btn-sm btn-info" title="Show">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="{{ url('/siswa-profil/' . $profil->id . '/edit') }}" class="btn btn-sm btn-warning" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ url('/siswa-profil/' . $profil->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                            onclick="return confirm('Are you sure you want to delete this profile?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $siswaProfils->links() }}
@endsection