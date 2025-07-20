@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Kelas</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('kelas.create') }}" class="btn btn-primary mb-3">Tambah Kelas</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="text-align: center;">ID</th>
                <th>Nama Kelas</th>
                <th style="text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kelas as $k)
            <tr>
                <td style="text-align: center;">{{ $k->id }}.</td>
                <td>{{ $k->name }}</td>
                <td style="text-align: center;">
                    <a href="{{ route('kelas.edit', $k->id) }}" class="btn btn-warning btn-sm" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706l-1 1a.5.5 0 0 1-.707 0L13 2.707l1-1a.5.5 0 0 1 .707 0l.795.795z" />
                            <path fill-rule="evenodd" d="M1 13.5V16h2.5l7.356-7.356-2.5-2.5L1 13.5zm11.854-6.854a.5.5 0 0 0-.708 0L10.5 7.293l2.5 2.5 1.646-1.646a.5.5 0 0 0 0-.708l-2.792-2.792z" />
                        </svg>
                    </a>
                    <form action="{{ route('kelas.destroy', $k->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kelas ini?')" title="Hapus">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1H14a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118z" />
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection