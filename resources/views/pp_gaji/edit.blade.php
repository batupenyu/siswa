@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit PP Gaji</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pp_gaji.update', $pp_gaji->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $pp_gaji->description) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pp_gaji.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
