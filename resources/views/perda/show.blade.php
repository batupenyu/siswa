@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Perda Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $perda->id }}</h5>
            <p class="card-text"><strong>Description:</strong> {{ $perda->description }}</p>
        </div>
    </div>

    <a href="{{ route('perda.edit', $perda->id) }}" class="btn btn-warning mt-3">Edit</a>
    <a href="{{ route('perda.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection