@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mutasi Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Siswa: {{ $mutasi->siswa->name ?? 'N/A' }}</h5>
            <p class="card-text"><strong>Alasan Pindah:</strong> {{ $mutasi->alasan_pindah }}</p>
        </div>
    </div>

    <a href="{{ route('mutasi.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection