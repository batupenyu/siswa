@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Mutasi</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('mutasi.update', $mutasi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="siswas_id">Siswa</label>
            <select name="siswas_id" id="siswas_id" class="form-control" required>
                <option value="">Select Siswa</option>
                @foreach($siswas as $siswa)
                <option value="{{ $siswa->id }}" {{ $mutasi->siswas_id == $siswa->id ? 'selected' : '' }}>{{
                    $siswa->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="alasan_pindah">Alasan Pindah</label>
            <textarea name="alasan_pindah" id="alasan_pindah" class="form-control" rows="3"
                required>{{ $mutasi->alasan_pindah }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('mutasi.index') }}" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>
@endsection