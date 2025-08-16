@extends('layouts.app')

@section('title', 'Siswa Profil List')


@section('content')
<div class="container">
    <h1>Siswa Profil List</h1>
    <a href="{{ url('/siswa-profil/create') }}" class="btn btn-primary mb-3">Add New Siswa Profil</a>

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