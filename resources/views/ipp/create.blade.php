@extends('layouts.app')



<!-- In the <head> section of your layout file -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Before the closing </body> tag -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    .select2-multiple {
        padding: 10px;
        border: 1px solid #0c6cccff;
        border-radius: 5px;
    }

    .select2-multiple .form-check {
        margin-bottom: 10px;
    }

    .select2-multiple .form-check-label {
        font-weight: normal;
    }

    /* Set font color to black for bulan select2 */
    #bulan+.select2-container--default .select2-selection--multiple {
        color: black !important;
    }
</style>

@section('content')
<div class="container">
    <h1>Create IPP</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('ipps.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="siswa_id">Siswa</label>
            <select name="siswa_id" id="siswa_id" class="form-control select2" required>
                <option value="">Select Siswa</option>
                @foreach($siswas as $siswa)
                <option value="{{ $siswa->id }}" {{ old('siswa_id') == $siswa->id ? 'selected' : '' }}>
                    {{ $siswa->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="bulan">Bulan</label>
            <select name="bulan[]" id="bulan" class="form-control select2" multiple required>
                @foreach($bulanOptions as $bulan)
                <option value="{{ $bulan }}" {{ (is_array(old('bulan')) && in_array($bulan, old('bulan'))) ? 'selected' : '' }}>
                    {{ $bulan }}
                </option>
                @endforeach
            </select>
        </div>

        <script>
            $(document).ready(function() {
                $('#bulan').select2({
                    placeholder: "Select bulan", // Placeholder text
                    allowClear: true, // Allow clearing the selection
                });
            });
        </script>

        <button type="submit" class="btn btn-primary mt-3">Create</button>
        <a href="{{ route('ipps.index') }}" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>

@endsection
<!-- 
@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection -->