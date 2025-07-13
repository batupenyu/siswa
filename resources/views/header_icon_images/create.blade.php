@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Upload Header Icon Image</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('header_icon_images.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Select Image (max 2MB):</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Upload</button>
        <a href="{{ route('header_icon_images.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection