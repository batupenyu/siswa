<!-- resources/views/pegawai/index.blade.php -->

@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Pegawai</h2>
    <a href="{{ route('pegawais.create') }}" class="btn btn-primary mb-3">Tambah Pegawai</a>
    <a href="{{ route('pegawais.exportExcel') }}" class="btn btn-success mb-3 ms-2">Export Excel</a>
    <!-- Search Form -->
    <div class="mb-3">
        <form action="{{ route('pegawais.index') }}" method="GET">
            @csrf
            <div class="input-group mb-2">
                <input type="text" name="search" class="form-control" placeholder="Cari pegawai...">
                <select name="pangkat" class="form-select" aria-label="Filter by Pangkat/Golongan">
                    <option value="">Semua Pangkat/Golongan</option>
                    <option value="-">-</option>
                    <option value="I/a">I/a</option>
                    <option value="I/b">I/b</option>
                    <option value="I/c">I/c</option>
                    <option value="I/d">I/d</option>
                    <option value="II/a">II/a</option>
                    <option value="II/b">II/b</option>
                    <option value="II/c">II/c</option>
                    <option value="II/d">II/d</option>
                    <option value="III/a">III/a</option>
                    <option value="III/b">III/b</option>
                    <option value="III/c">III/c</option>
                    <option value="III/d">III/d</option>
                    <option value="IV/a">IV/a</option>
                    <option value="IV/b">IV/b</option>
                    <option value="IV/c">IV/c</option>
                    <option value="IV/d">IV/d</option>
                    <option value="IV/e">IV/e</option>
                </select>
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
    </div>
    
    <table class="table table-sm table-bordered table-striped" style="font-size: 10pt">
        <thead>
            <tr style="height: 40px;vertical-align:middle;text-align:center">
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jabatan</th>
                <th>Pangkat/Golongan</th>
                <th style="text-align: center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pegawais as $index => $pegawai)
            <tr>
                <td style="text-align:center">{{ ($pegawais->currentPage()-1) * $pegawais->perPage() + $loop->index + 1
                    }}.</td>
                <td>{{ $pegawai->nama }}</td>
                <td>{{ $pegawai->nip }}</td>
                <td>{{ $pegawai->jabatan }}</td>
                <td style="text-align: center">{{ $pegawai->pangkat}}</td>
                <td style="text-align: center">
                    <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi-three-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href="{{ route('pegawais.edit', $pegawai->id) }}" class="dropdown-item"><i
                                    class="bi-pen-fill"></i> Edit</a>
                            <form action="{{ route('pegawais.destroy', $pegawai->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="bi-trash"></i> Delete
                                </button>
                            </form>
                            {{-- <a href="{{ route('pegawais.pdf', $pegawai->id) }}" class="dropdown-item"><i
                                    class="bi-file-pdf"></i> Laporan</a> --}}
                            {{-- <a href="{{ route('pegawais.kredit', $pegawai->id) }}" class="dropdown-item"><i
                                    class="bi-file-pdf"></i> ak</a> --}}
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $pegawais->links() }}
</div>

<script>
    var dropdowns = document.querySelectorAll('.dropdown-toggle')
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', function () {
            var dropdownMenu = this.nextElementSibling
            dropdownMenu.classList.toggle('show')
        })
    })
</script>
@endsection