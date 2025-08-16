@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">SPMT</div>
                    <div class="card-body">
                        <a href="{{ route('spmts.create') }}" class="btn btn-primary mb-3">Create SPMT</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pegawai</th>
                                    <th>Nomor Surat</th>
                                    <th>Tgl Surat</th>
                                    <th>Hal Surat</th>
                                    <th>Tempat Ditetapkan</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($spmts as $spmt)
                                    <tr>
                                        <td>{{ $spmt->id }}</td>
                                        <td>{{ $spmt->pegawai->nama }}</td>
                                        <td>{{ $spmt->nomor_surat }}</td>
                                        <td>{{ $spmt->tgl_surat }}</td>
                                        <td>{{ $spmt->hal_surat }}</td>
                                        <td>{{ $spmt->tempat_ditetapkan }}</td>
                                        <td>
                                            <a href="{{ route('spmts.show', $spmt->id) }}" class="btn btn-sm btn-info"><i class="bi bi-eye"></i></a>
                                            <a href="{{ route('spmts.edit', $spmt->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                                            <form action="{{ route('spmts.destroy', $spmt->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
