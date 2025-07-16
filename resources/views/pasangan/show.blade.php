@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h1>Detail Pasangan</h1>
    <table class="table table-bordered" style="font-size: 8pt;">
        <tr>
            <th>Nama Pasangan</th>
            <td>{{ $pasangan->nama }}</td>
        </tr>
        <tr>
            <th>Nama Pegawai</th>
            <td>{{ $pasangan->pegawai->nama ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tempat Lahir</th>
            <td>{{ $pasangan->tempat_lahir }}</td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td>{{ \Carbon\Carbon::parse($pasangan->tgl_lahir)->translatedFormat('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Tanggal Perkawinan</th>
            <td>{{ \Carbon\Carbon::parse($pasangan->tgl_perkawinan)->translatedFormat('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Pekerjaan</th>
            <td>{{ $pasangan->pekerjaan }}</td>
        </tr>
        <tr>
            <th>Status Pernikahan</th>
            <td>{{ $pasangan->status_pernikahan }}</td>
        </tr>
        <tr>
            <th>Status Tunjangan</th>
            <td>{{ $pasangan->status_tunjangan }}</td>
        </tr>
    </table>
    <a href="{{ route('pasangan.index') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('pasangan.edit', $pasangan->id) }}" class="btn btn-primary">Edit</a>
</div>
@endsection
