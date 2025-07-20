@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Header Icon Images</h1>
    <a href="{{ route('header_icon_images.create') }}" class="btn btn-primary mb-3">Upload New Image</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                {{-- <th>ID</th> --}}
                <th>Filename</th>
                <th>Preview</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($images as $image)
            <tr>
                <td>{{ $image->filename }}</td>
                <td style="text-align: center;">
                    <img src="{{ asset('storage/header_icons/' . rawurlencode($image->filename)) }}" alt="{{ $image->filename }}" style="max-height: 50px;">
                </td>
                <td style="text-align: center;">
                    <a href="{{ route('header_icon_images.edit', $image->id) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-fill"></i>
                    </a>
                    <form action="{{ route('header_icon_images.destroy', $image->id) }}" method="POST"
                        style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this image?')">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection