@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Perda</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('perda.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Create</button>
        <a href="{{ route('perda.index') }}" class="btn btn-secondary mt-2">Cancel</a>
    </form>
</div>
@endsection