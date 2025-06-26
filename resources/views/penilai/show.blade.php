@extends('layouts.app')

@section('content')
<style>
    .label-colon {
        display: inline-block;
        width: 100px;
        /* fixed width to align colons */
        text-align: left;
        padding-right: 5px;
    }

    .card-body {
        box-shadow: 0 10px 8px rgba(0, 0, 0, 0.1);
    }
</style>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h3>Penilai Details</h3>

            <div class="mb-0">
                <strong class="label-colon">Nama</strong>: {{ $penilai->nama }}
            </div>
            <div class="mb-0">
                <strong class="label-colon">Jabatan</strong>: {{ $penilai->jabatan }}
            </div>
            <div class="mb-0">
                <strong class="label-colon">NIP</strong>: {{ $penilai->nip }}
            </div>
            <div class="mb-0">
                <strong class="label-colon">Pangkat</strong>: {{ $penilai->pangkat }}
            </div>
            <div class="mb-0">
                <strong class="label-colon">Unit Kerja</strong>: {{ $penilai->unitkerja }}
            </div>
            <div class="mb-0">
                <strong class="label-colon">Instansi</strong>: {{ $penilai->instansi }}
            </div>

            <a href="{{ route('penilai.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('penilai.edit', $penilai->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection