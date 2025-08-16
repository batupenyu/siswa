@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Header Icon Image</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('header_icon_images.update', $image->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Current Image:</label><br>
            <img src="{{ Storage::url($image->path) }}" alt="Icon" style="height: 80px;">
        </div>
        <div class="form-group">
            <label for="image">Replace Image (max 2MB):</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('header_icon_images.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection