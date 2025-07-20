@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Donasi List</h1>
    <a href="{{ route('ipps.create') }}" class="btn btn-primary mb-3">Add New Donasi</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Siswa</th>
                <th>Bulan</th>
                <th style="text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ipps as $ipp)
            <tr>
                <td>{{ $ipp->id }}</td>
                <td>{{ $ipp->siswa->name ?? 'N/A' }}</td>
                <td>{{ $ipp->bulan }}</td>
                <td style="text-align: center;">
                    <a href="{{ route('ipps.show', $ipp->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('ipps.edit', $ipp->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('ipps.destroy', $ipp->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this IPP?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $ipps->links() }}
</div>
@endsection