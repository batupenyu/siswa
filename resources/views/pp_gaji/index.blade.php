@extends('layouts.app')

@section('content')
<div class="container">
    <h1>PP Gaji List</h1>
    <a href="{{ route('pp_gaji.create') }}" class="btn btn-primary mb-3">Create New</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($ppGajis->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ppGajis as $ppGaji)
            <tr>
                <td>{{ $ppGaji->id }}</td>
                <td x>{{ $ppGaji->description }}</td>
                <td style="width: 150px;"> 
                    <a href="{{ route('pp_gaji.show', $ppGaji->id) }}" class="btn btn-info btn-sm" title="View">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="{{ route('pp_gaji.edit', $ppGaji->id) }}" class="btn btn-warning btn-sm" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('pp_gaji.destroy', $ppGaji->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this item?')" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No PP Gaji found.</p>
    @endif
</div>
@endsection
