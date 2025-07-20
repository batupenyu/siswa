@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Pergub</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('pergub.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary" title="Save">
            <i class="fa fa-save"></i> Save
        </button>
        <a href="{{ route('pergub.index') }}" class="btn btn-secondary" title="Cancel">
            <i class="fa fa-times"></i> Cancel
        </a>
    </form>
</div>
@endsection