@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Suket</h1>

    <form action="{{ route('sukets.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="siswas_id" class="form-label">Siswa</label>
            <select name="siswas_id" id="siswas_id" class="form-select" required>
                <option value="">Select Siswa</option>
                @foreach($siswas as $siswa)
                <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="tgl_ditetapkan" class="form-label">Tanggal Ditetapkan</label>
            <input type="date" name="tgl_ditetapkan" id="tgl_ditetapkan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tempat_ditetapkan" class="form-label">Tempat Ditetapkan</label>
            <input type="text" name="tempat_ditetapkan" id="tempat_ditetapkan" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Suket</button>
        <a href="{{ route('sukets.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection