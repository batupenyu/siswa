@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Holiday</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('holidays.update', $holiday->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $holiday->date->format('Y-m-d')) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description (optional)</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ old('description', $holiday->description) }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Holiday</button>
        <a href="{{ route('holidays.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
