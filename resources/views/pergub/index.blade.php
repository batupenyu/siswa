@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pergub List</h1>

    <a href="{{ route('pergub.create') }}" class="btn btn-primary mb-3" title="Add New Pergub">
        <i class="bi bi-plus"></i>
    </a>

    <form method="GET" action="{{ route('pergub.index') }}" class="mb-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search description" class="form-control" />
    </form>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($pergubList->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pergubList as $pergub)
            <tr>
                <td>{{ $pergub->id }}</td>
                <td>{{ $pergub->description }}</td>
                <td>
                    <a href="{{ route('pergub.show', $pergub->id) }}" class="btn btn-info btn-sm" title="View">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="{{ route('pergub.edit', $pergub->id) }}" class="btn btn-warning btn-sm" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('pergub.destroy', $pergub->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this pergub?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $pergubList->links() }}
    @else
    <p>No pergub found.</p>
    @endif
</div>
@endsection