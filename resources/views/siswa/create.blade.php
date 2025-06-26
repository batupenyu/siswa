@extends('layouts.app')

@section('content')
<style>
    .card-body {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h1>Create Student</h1>
            <form action="{{ route('siswa.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="name">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="nis">N I S</label>
                        <input type="text" name="nis" id="nis" class="form-control" required>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="npsn">NPSN</label>
                        <input type="text" name="npsn" id="npsn" class="form-control">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="kelas_id">Kelas</label>
                        <select name="kelas_id" id="kelas_id" class="form-control select2" required>
                            <option value="">Select Class</option>
                            @foreach ($kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </div>
    </div>
</div>

<!-- Include Select2 CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection