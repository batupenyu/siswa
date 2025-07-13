g@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Rincian Surat List</h1>

    <a href="{{ route('rincian_surat.create') }}" class="btn btn-primary mb-3">Add New Rincian Surat</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($rincians->isEmpty())
        <p>No Rincian Surat found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Biaya Transportasi</th>
                    <th>Biaya Penginapan</th>
                    <th>Biaya Tiket</th>
                    <th>Transport Lokal</th>
                    <th>Uang Makan</th>
                    <th>Uang Saku</th>
                    <th>Uang Representasi</th>
                    <th>Uang Kediklatan</th>
                    <th>Korek</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rincians as $rincianSurat)
                <tr>
                    <td>{{ $rincianSurat->id }}</td>
                    <td>{{ $rincianSurat->biaya_transportasi }}</td>
                    <td>{{ $rincianSurat->biaya_penginapan }}</td>
                    <td>{{ $rincianSurat->biaya_tiket }}</td>
                    <td>{{ $rincianSurat->transport_lokal }}</td>
                    <td>{{ $rincianSurat->uang_makan }}</td>
                    <td>{{ $rincianSurat->uang_saku }}</td>
                    <td>{{ $rincianSurat->uang_representasi }}</td>
                    <td>{{ $rincianSurat->uang_kediklatan }}</td>
                    <td>{{ $rincianSurat->korek }}</td>
                    <td>{{ $rincianSurat->created_at }}</td>
                    <td>{{ $rincianSurat->updated_at }}</td>
                    {{-- <td>
                        <a href="{{ route('rincian_surat.show', $rincianSurat->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('rincian_surat.edit', $rincianSurat->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('rincian_surat.destroy', $rincianSurat->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                        </form>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
