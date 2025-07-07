@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mutasi List</h1>
    <a href="{{ route('mutasi.create') }}" class="btn btn-primary mb-3">Add New Mutasi</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Siswa</th>
                <th>Alasan Pindah</th>
                <th style="text-align: center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mutasis as $mutasi)
            <tr>
                <td>{{ $mutasi->id }}</td>
                <td>{{ $mutasi->siswa->name ?? 'N/A' }}</td>
                <td>{{ $mutasi->alasan_pindah }}</td>
                <td style="text-align: center">
                    {{-- <a href="{{ route('mutasi.show', $mutasi->id) }}" class="btn btn-info btn-sm">View</a> --}}
                    <a href="{{ route('mutasi.edit', $mutasi->id) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <form action="{{ route('mutasi.destroy', $mutasi->id) }}" method="POST"
                        style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                    <a href="{{ route('mutasi.pdf', $mutasi->id) }}" class="btn btn-secondary btn-sm"
                        target="_blank">
                        <i class="bi bi-printer"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $mutasis->links() }}
</div>
@endsection