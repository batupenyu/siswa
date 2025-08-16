@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Penilai List</h1>
    <a href="{{ route('penilai.create') }}" class="btn btn-primary mb-3">Add New Penilai</a>
    <button type="button" class="btn btn-secondary mb-3 ms-2" onclick="changeFontSize()" title="Change font size to 10pt">
        &#128441; {{-- Unicode icon for font --}}
    </button>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($penilai->count())
    <table class="table table-bordered">
        <thead>
            <tr>
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
            @foreach($penilai as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jabatan }}</td>
                <td>{{ $item->nip }}</td>
                <td>{{ $item->pangkat }}</td>
                <td>{{ $item->unitkerja }}</td>
                <td>{{ $item->instansi }}</td>
                <td>
                    <a href="{{ route('penilai.show', $item->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('penilai.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                        &#9998; {{-- Unicode pencil/edit icon --}}
                    </a>
                    <form action="{{ route('penilai.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure to delete this penilai?')">&#128465;</button> {{-- Unicode trash bin icon --}}
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No penilai found.</p>
    @endif
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