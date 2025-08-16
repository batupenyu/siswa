@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit SPMT</div>
                    <div class="card-body">
                        <form action="{{ route('spmts.update', $spmt->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pegawai_id">Pegawai</label>
                                        <select name="pegawai_id" id="pegawai_id" class="form-control">
                                            @foreach ($pegawais as $pegawai)
                                                <option value="{{ $pegawai->id }}" {{ $spmt->pegawai_id == $pegawai->id ? 'selected' : '' }}>{{ $pegawai->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="dasar_surat">Dasar Surat</label>
                                        <input type="text" name="dasar_surat" id="dasar_surat" class="form-control" value="{{ $spmt->dasar_surat }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nomor_surat">Nomor Surat</label>
                                        <input type="text" name="nomor_surat" id="nomor_surat" class="form-control" value="{{ $spmt->nomor_surat }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_surat">Tanggal Surat</label>
                                        <input type="date" name="tgl_surat" id="tgl_surat" class="form-control" value="{{ $spmt->tgl_surat }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hal_surat">Hal Surat</label>
                                        <input type="text" name="hal_surat" id="hal_surat" class="form-control" value="{{ $spmt->hal_surat }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" class="form-control">{{ $spmt->keterangan }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_ditetapkan">Tanggal Ditetapkan</label>
                                        <input type="date" name="tgl_ditetapkan" id="tgl_ditetapkan" class="form-control" value="{{ $spmt->tgl_ditetapkan }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tempat_ditetapkan">Tempat Ditetapkan</label>
                                        <input type="text" name="tempat_ditetapkan" id="tempat_ditetapkan" class="form-control" value="{{ $spmt->tempat_ditetapkan }}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
