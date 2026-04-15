@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>Download Template Siswa</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            <p>Download template Excel untuk import data siswa.</p>
            <a href="{{ route('siswas.template') }}" class="btn btn-primary" onclick="setTimeout(() => { window.location.href = '{{ route('siswas.template.page') }}?downloaded=1'; }, 1000)">
                Download Template
            </a>
            <a href="{{ route('siswas.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>

@if(request('downloaded'))
@section('scripts')
<script>
    alert('Template berhasil didownload!');
</script>
@endsection
@endif