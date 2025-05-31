@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Penilai Details</h1>

    <div class="mb-3">
        <strong>Nama:</strong> {{ $penilai->nama }}
    </div>
    <div class="mb-3">
        <strong>Jabatan:</strong> {{ $penilai->jabatan }}
    </div>
    <div class="mb-3">
        <strong>NIP:</strong> {{ $penilai->nip }}
    </div>
    <div class="mb-3">
        <strong>Pangkat:</strong> {{ $penilai->pangkat }}
    </div>
    <div class="mb-3">
        <strong>Unit Kerja:</strong> {{ $penilai->unitkerja }}
    </div>
    <div class="mb-3">
        <strong>Instansi:</strong> {{ $penilai->instansi }}
    </div>

    <a href="{{ route('penilai.index') }}" class="btn btn-secondary">Back to List</a>
    <a href="{{ route('penilai.edit', $penilai->id) }}" class="btn btn-warning">Edit</a>
</div>
@endsection