@extends('layouts.app')

@section('title', 'Edit Siswa')

@section('content')
<style>
    .card-body {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h1 class="text-center mb-4">Edit Siswa</h1>

            <form action="{{ route('siswas.update', $siswa->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ $siswa->name }}" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="text" name="nis" class="form-control" value="{{ $siswa->nis }}" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="npsn" class="form-label">NPSN</label>
                        <input type="text" name="npsn" class="form-control" value="{{ $siswa->npsn }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="kelas_id" class="form-label">Kelas</label>
                        <select name="kelas_id" class="form-control" required>
                            @foreach($kelas as $kelas)
                            <option value="{{ $kelas->id }}" {{ $siswa->kelas_id == $kelas->id ? 'selected' : '' }}>{{
                                $kelas->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('siswas.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection