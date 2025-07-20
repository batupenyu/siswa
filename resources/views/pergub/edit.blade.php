@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Pergub</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('pergub.update', $pergub->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description', $pergub->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary" title="Update">
            <i class="fa fa-save"></i> Update
        </button>
        <a href="{{ route('pergub.index') }}" class="btn btn-secondary" title="Cancel">
            <i class="fa fa-times"></i> Cancel
        </a>
    </form>
</div>
@endsection