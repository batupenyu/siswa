@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pergub Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $pergub->id }}</h5>
            <p class="card-text"><strong>Description:</strong> {{ $pergub->description }}</p>
        </div>
    </div>

    <a href="{{ route('pergub.index') }}" class="btn btn-secondary mt-3" title="Back to List">
        <i class="fa fa-arrow-left"></i> Back
    </a>
    <a href="{{ route('pergub.edit', $pergub->id) }}" class="btn btn-warning mt-3" title="Edit">
        <i class="fa fa-edit"></i> Edit
    </a>
</div>
@endsection