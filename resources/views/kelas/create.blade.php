@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Kelas</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('kelas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Kelas</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Simpan</button>
        <a href="{{ route('kelas.index') }}" class="btn btn-secondary mt-2">Batal</a>
    </form>
</div>
@endsection