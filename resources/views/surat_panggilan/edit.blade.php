@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card" style="max-width: 700px; margin: auto;">
        <div class="card-header"><h4>Edit Surat Panggilan Siswa</h4></div>
        <div class="card-body">
            <form action="{{ route('surat-panggilan.update', $surat->id) }}" method="POST">
                @csrf @method('PUT')
                @include('surat_panggilan._form', ['surat' => $surat])
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('surat-panggilan.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
