@extends('layouts.app')

@section('title', 'Daftar Siswa')

@section('content')
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

<div class="container mt-5">
    <h3 class="text-center mb-4">DAFTAR SISWA SMKN 1 KOBA</h3>

    <!-- Search Form -->
    <div class="mb-3">
        <form action="{{ route('siswas.index') }}" method="GET">
            @csrf
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari siswa...">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
    </div>

    <!-- Export and Import Section -->
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <a href="{{ route('siswas.export') }}" class="btn btn-success">Export to XLSX</a>
        <form action="{{ route('siswas.import') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center">
            @csrf
            <input type="file" name="file" accept=".xlsx,.csv" required class="form-control form-control-sm me-2">
            <button type="submit" class="btn btn-primary btn-sm">Import XLSX</button>
        </form>
    </div>

    <!-- Add New Student Button -->
    <div class="mb-3 text-end">
        <a href="{{ route('siswas.create') }}" class="btn btn-primary">Tambah Siswa</a>
    </div>

    <!-- Display Success Message -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Table to Display Students -->
    <table class="table table-sm table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th style="text-align: center" scope="col">No.</th>
                <th scope="col">Nama</th>
                <th scope="col">NSN</th>
                <th scope="col">Kelas</th>
                <th style="text-align: center" scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>

            @forelse($siswas as $siswa)
            <tr>
                <td style="text-align:center">{{ ($siswas->currentPage()-1) * $siswas->perPage() + $loop->index + 1 }}.
                </td>
                <td>{{ $siswa->name }}</td>
                <td>{{ $siswa->nis }}</td>
                <td>{{ $siswa->kelas->name ?? '' }}</td>
                <td style="text-align: center">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Aksi
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('siswas.show', $siswa->id) }}">Detail</a>
                            <a class="dropdown-item" href="{{ route('siswa.pdf', $siswa->id) }}">{{ __('Suket') }}</a>
                            <a class="dropdown-item" href="{{ route('siswas.edit', $siswa->id) }}">Edit</a>
                            <form action="{{ route('siswas.destroy', $siswa->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data siswa.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
{{ $siswas->links() }}

{{-- <script>
    $(document).ready(function() {
        $('.dropdown-toggle').dropdown();
    });
</script> --}}
<script>
    var dropdowns = document.querySelectorAll('.dropdown-toggle')
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', function() {
            var dropdownMenu = this.nextElementSibling
            dropdownMenu.classList.toggle('show')
        })
    })
</script>
@endsection