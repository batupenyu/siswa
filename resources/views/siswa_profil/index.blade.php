@extends('layouts.app')

@section('title', 'Siswa Profil List')

@section('content')
<div class="container">
    <h1>Siswa Profil List</h1>
    <a href="{{ url('/siswa-profil/create') }}" class="btn btn-primary mb-3">Add New Siswa Profil</a>

    <table class="table table-bordered">
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
                <td>{{ $profil->id }}</td>
                <td>{{ $profil->nama_panggilan }}</td>
                <td>{{ $profil->jenis_kelamin }}</td>
                <td>{{ $profil->tempat_tanggal_lahir }}</td>
                <td>{{ $profil->agama }}</td>
                <td>{{ $profil->kewarganegaraan }}</td>
                <td>
                    <a href="{{ url('/siswa-profil/' . $profil->id . '/edit') }}"
                        class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ url('/siswa-profil/' . $profil->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this profile?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection