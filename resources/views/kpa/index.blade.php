@extends('layouts.app')

@section('title', 'KPA List')

@section('content')
<div class="container">
    <h1>KPA List</h1>
    <a href="{{ route('kpa.create') }}" class="btn btn-primary mb-3">Add New KPA</a>
    <button type="button" class="btn btn-secondary mb-3 ms-2" onclick="changeFontSize()" title="Change font size to 10pt">
        &#128441; {{-- Unicode icon for font --}}
    </button>
    <table class="table table-bordered" id="kpa-table">
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
            @foreach ($kpas as $kpa)
            <tr>
                <td>{{ $kpa->id }}</td>
                <td>{{ $kpa->nama }}</td>
                <td>{{ $kpa->jabatan }}</td>
                <td>{{ $kpa->nip }}</td>
                <td>{{ $kpa->pangkat }}</td>
                <td>{{ $kpa->unitkerja }}</td>
                <td>{{ $kpa->instansi }}</td>
                <td>
                    <a href="{{ route('kpa.edit', $kpa->id) }}" class="btn btn-warning btn-sm" title="Edit">
                        &#9998; {{-- Unicode pencil/edit icon --}}
                    </a>
                    <form action="{{ route('kpa.destroy', $kpa->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                            onclick="return confirm('Are you sure you want to delete this KPA?')">&#128465;</button> {{-- Unicode trash bin icon --}}
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