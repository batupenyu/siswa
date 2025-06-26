@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Surat Izin Pegawai</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $suratIzinPegawai->id }}</p>
            <p><strong>Pegawai:</strong> {{ $suratIzinPegawai->pegawai->nama ?? '-' }}</p>
            <p><strong>Tanggal:</strong> {{ $suratIzinPegawai->tanggal }}</p>
            <p><strong>Jam:</strong> {{ $suratIzinPegawai->jam }}</p>
            <p><strong>Keperluan:</strong> {{ $suratIzinPegawai->keperluan }}</p>
            <p><strong>Keterangan:</strong> {{ $suratIzinPegawai->keterangan }}</p>
        </div>
    </div>

    <a href="{{ route('surat_izin_pegawai.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection