@extends('layouts.app')

@section('content')
<div class="container">
    <h1>PP Gaji Details</h1>

    <div class="mb-3">
        <strong>ID:</strong> {{ $pp_gaji->id }}
    </div>
    <div class="mb-3">
        <strong>Description:</strong> {{ $pp_gaji->description }}
    </div>

    <a href="{{ route('pp_gaji.index') }}" class="btn btn-secondary">Back to List</a>
    <a href="{{ route('pp_gaji.edit', $pp_gaji->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection
