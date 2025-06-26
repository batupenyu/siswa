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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mutasis as $mutasi)
            <tr>
                <td>{{ $mutasi->id }}</td>
                <td>{{ $mutasi->siswa->name ?? 'N/A' }}</td>
                <td>{{ $mutasi->alasan_pindah }}</td>
                <td>
                    {{-- <a href="{{ route('mutasi.show', $mutasi->id) }}" class="btn btn-info btn-sm">View</a> --}}
                    <a href="{{ route('mutasi.edit', $mutasi->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('mutasi.destroy', $mutasi->id) }}" method="POST"
                        style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    <a href="{{ route('mutasi.pdf', $mutasi->id) }}" class="btn btn-secondary btn-sm"
                        target="_blank">Cetak</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $mutasis->links() }}
</div>
@endsection