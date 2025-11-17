@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Pegawai</h2>

    <!-- Aksi Utama -->
    <div class="d-flex mb-3">
        <a href="{{ route('pegawais.create') }}" class="btn btn-primary">Tambah Pegawai</a>
        <a href="{{ route('pegawais.exportExcel') }}" class="btn btn-success ms-2">Export Excel</a>
        <button type="button" class="btn btn-info ms-2" data-bs-toggle="modal" data-bs-target="#importExcelModal">
            Import Excel
        </button>

        <!-- Tambahkan tombol Hapus Semua di sini -->
        <form action="{{ route('pegawais.destroyAll') }}" method="POST" class="ms-2" onsubmit="return confirm('⚠️ PERINGATAN: Ini akan menghapus SEMUA data pegawai! Lanjutkan?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus Semua Pegawai</button>
        </form>
    </div>

    <!-- Modal Import Excel -->
    <div class="modal fade" id="importExcelModal" tabindex="-1" aria-labelledby="importExcelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('pegawais.importExcel') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="importExcelModalLabel">Import Data Pegawai dari Excel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="file" class="form-label">Pilih File Excel (.xlsx atau .xls)</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".xlsx, .xls" required>
                            <small class="text-muted">Format file harus sesuai template. <a href="#" class="text-decoration-none">Unduh template</a></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Search Form -->
    <div class="mb-3">
        <form action="{{ route('pegawais.index') }}" method="GET">
            @csrf
            <div class="input-group mb-2">
                <input type="text" name="search" class="form-control" placeholder="Cari pegawai..." value="{{ request('search') }}">
                <select name="pangkat" class="form-select" aria-label="Filter by Pangkat/Golongan">
                    <option value="">Semua Pangkat/Golongan</option>
                    <option value="-" {{ request('pangkat') == '-' ? 'selected' : '' }}>-</option>
                    @php
                    $golongan = ['I/a', 'I/b', 'I/c', 'I/d', 'II/a', 'II/b', 'II/c', 'II/d', 'III/a', 'III/b', 'III/c', 'III/d', 'IV/a', 'IV/b', 'IV/c', 'IV/d', 'IV/e'];
                    @endphp
                    @foreach($golongan as $g)
                    <option value="{{ $g }}" {{ request('pangkat') == $g ? 'selected' : '' }}>{{ $g }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
    </div>

    <!-- Tabel Pegawai -->
    <table class="table table-sm table-bordered table-striped" style="font-size: 10pt">
        <thead>
            <tr style="height: 40px; vertical-align: middle; text-align: center">
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jabatan</th>
                <th>Pangkat/Golongan</th>
                <th style="text-align: center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pegawais as $index => $pegawai)
            <tr>
                <td style="text-align:center">{{ ($pegawais->currentPage() - 1) * $pegawais->perPage() + $loop->index + 1 }}.</td>
                <td>{{ $pegawai->nama }}</td>
                <td>{{ $pegawai->nip }}</td>
                <td>{{ $pegawai->jabatan }}</td>
                <td style="text-align: center">{{ $pegawai->pangkat }}</td>
                <td style="text-align: center">
                    <div class="dropdown">
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $pegawai->id }}"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi-three-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $pegawai->id }}">
                            <a href="{{ route('pegawais.edit', $pegawai->id) }}" class="dropdown-item"><i class="bi-pen-fill"></i> Edit</a>
                            <form action="{{ route('pegawais.destroy', $pegawai->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data pegawai.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $pegawais->links() }}
</div>

@endsection

@push('scripts')
<script>
    // Opsional: Tutup modal setelah submit (jika ingin redirect, biasanya tidak perlu karena form submit biasa)
    // Tapi jika pakai AJAX, bisa ditambahkan di sini
</script>
@endpush