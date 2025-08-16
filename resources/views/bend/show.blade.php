@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Bend</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $bend->id }}</p>
            <p><strong>Bendahara:</strong> {{ $bend->bendahara }}</p>
            <p><strong>Pegawai:</strong> {{ $bend->pegawai->nama ?? '-' }}</p>
        </div>
    </div>

    <a href="{{ route('bends.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection