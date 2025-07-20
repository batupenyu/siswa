@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Perda List</h1>
    <a href="{{ route('perda.create') }}" class="btn btn-primary mb-3">Create New Perda</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($perdas->count())
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($perdas as $perda)
            <tr>
                <td>{{ $perda->id }}</td>
                <td>{{ $perda->description }}</td>
                <td style="text-align: center;">
                    <a href="{{ route('perda.show', $perda->id) }}" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('perda.edit', $perda->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('perda.destroy', $perda->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this perda?')"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $perdas->links() }}
    @else
    <p>No perda found.</p>
    @endif
</div>
@endsection