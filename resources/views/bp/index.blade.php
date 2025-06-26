@extends('layouts.app')

@section('title', 'BP List')

@section('content')
<div class="container">
    <h1>BP List</h1>
    <a href="{{ route('bp.create') }}" class="btn btn-primary mb-3">Add New BP</a>
    <button type="button" class="btn btn-secondary mb-3 ms-2" onclick="changeFontSize()" title="Change font size to 10pt">
        &#128441; {{-- Unicode icon for font --}}
    </button>
    <table class="table table-bordered" id="bp-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>NIP</th>
                <th>Pangkat</th>
                <th>Unit Kerja</th>
                <th>Instansi</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bps as $bp)
            <tr>
                <td>{{ $bp->id }}</td>
                <td>{{ $bp->nama }}</td>
                <td>{{ $bp->jabatan }}</td>
                <td>{{ $bp->nip }}</td>
                <td>{{ $bp->pangkat }}</td>
                <td>{{ $bp->unitkerja }}</td>
                <td>{{ $bp->instansi }}</td>
                <td>
                    <a href="{{ route('bp.edit', $bp->id) }}" class="btn btn-warning btn-sm" title="Edit">
                        &#9998; {{-- Unicode pencil/edit icon --}}
                    </a>
                    <form action="{{ route('bp.destroy', $bp->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                            onclick="return confirm('Are you sure you want to delete this BP?')">&#128465;</button> {{-- Unicode trash bin icon --}}
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function changeFontSize() {
        const container = document.querySelector('.container');
        if (container) {
            container.style.fontSize = '10pt';
        }
    }
</script>
@endsection