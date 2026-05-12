@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card" style="max-width: 700px; margin: auto;">
        <div class="card-header"><h4>Buat Surat Panggilan Siswa</h4></div>
        <div class="card-body">
            <form action="{{ route('surat-panggilan.store') }}" method="POST">
                @csrf
                @include('surat_panggilan._form')
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('surat-panggilan.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
