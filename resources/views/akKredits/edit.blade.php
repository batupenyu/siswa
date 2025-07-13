@extends('layouts.app') <!-- Assuming you have a layout file -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Card Container -->
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Edit AkKredit</h4>
                </div>
                <div class="card-body">
                    <!-- Validation Error Messages -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form to Edit AkKredit -->
                    <form action="{{ route('akKredits.update', $akKredit->id) }}" method="POST">
                        @csrf <!-- CSRF Token for Security -->
                        @method('PUT') <!-- Use PUT method for updates -->

                        <!-- Pegawai ID Field -->
                        <div class="mb-3">
                            <label for="pegawais_id" class="form-label">Pegawai</label>
                            <select name="pegawais_id" id="pegawais_id" class="form-select" required>
                                <option value="" disabled>Select a Pegawai</option>
                                @foreach ($pegawais as $pegawai)
                                    <option value="{{ $pegawai->id }}" {{ $akKredit->pegawais_id == $pegawai->id ? 'selected' : '' }}>
                                        {{ $pegawai->nama }} <!-- Assuming 'name' is a column in the pegawai table -->
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Predikat Field -->
                        <div class="mb-3">
                            <label for="predikat" class="form-label">Predikat</label>
                            <select name="predikat" id="predikat" class="form-select">
                                <option value="" {{ !$akKredit->predikat ? 'selected' : '' }}>Select a Predikat</option>
                                <option value="Sangat Baik" {{ $akKredit->predikat === 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                                <option value="Baik" {{ $akKredit->predikat === 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Perlu Perbaikan" {{ $akKredit->predikat === 'Perlu Perbaikan' ? 'selected' : '' }}>Perlu Perbaikan</option>
                                <option value="Kurang" {{ $akKredit->predikat === 'Kurang' ? 'selected' : '' }}>Kurang</option>
                                <option value="Sangat Kurang" {{ $akKredit->predikat === 'Sangat Kurang' ? 'selected' : '' }}>Sangat Kurang</option>
                            </select>
                        </div>
                        
                        <!-- Start Date Field -->
                        <div class="mb-3">
                            <label for="startDate" class="form-label">Start Date</label>
                            <input type="date" name="startDate" id="startDate" class="form-control" value="{{ old('startDate', $akKredit->startDate) }}" required>
                        </div>

                        <!-- End Date Field -->
                        <div class="mb-3">
                            <label for="endDate" class="form-label">End Date</label>
                            <input type="date" name="endDate" id="endDate" class="form-control" value="{{ old('endDate', $akKredit->endDate) }}" required>
                        </div>


                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Update AkKredit</button>
                        <!-- Cancel Button -->
                        <a href="{{ route('akKredits.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection