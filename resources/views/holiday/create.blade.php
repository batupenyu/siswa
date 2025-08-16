@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Holiday</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('holidays.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description (optional)</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ old('description') }}">
        </div>
        <button type="submit" class="btn btn-primary">Add Holiday</button>
        <a href="{{ route('holidays.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
