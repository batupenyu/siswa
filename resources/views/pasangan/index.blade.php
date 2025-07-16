@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h1>Daftar Pasangan</h1>
    <a href="{{ route('pasangan.create') }}" class="btn btn-primary mb-3">Tambah Pasangan</a>
    <table class="table table-sm table-striped" style="font-size: 8pt;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pasangan</th>
                <th>Nama Pegawai</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Tanggal Perkawinan</th>
                <th>Pekerjaan</th>
                <th>Status Pernikahan</th>
                <th>Status Tunjangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pasanganList as $pasangan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pasangan->nama }}</td>
                <td>{{ $pasangan->pegawai->nama ?? '-' }}</td>
                <td>{{ $pasangan->tempat_lahir }}</td>
                <td>{{ \Carbon\Carbon::parse($pasangan->tgl_lahir)->translatedFormat('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($pasangan->tgl_perkawinan)->translatedFormat('d-m-Y') }}</td>
                <td>{{ $pasangan->pekerjaan }}</td>
                <td>{{ $pasangan->status_pernikahan }}</td>
                <td>{{ $pasangan->status_tunjangan }}</td>
                <td>
                    <a href="{{ route('pasangan.edit', $pasangan->id) }}" title="Edit"><i class="bi bi-pencil-square"></i></a>
                    <form action="{{ route('pasangan.destroy', $pasangan->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Delete" class="btn btn-link p-0 m-0 text-danger" style="background:none; border:none; cursor:pointer;">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                    <button type="button" class="btn btn-link p-0 m-0" title="Detail" data-bs-toggle="modal" data-bs-target="#pasanganModal" data-pasangan="{{ json_encode($pasangan) }}">
                        <i class="bi bi-eye"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $pasanganList->links() }}

    <!-- Modal -->
    <div class="modal fade" id="pasanganModal" tabindex="-1" aria-labelledby="pasanganModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark text-light">
                <div class="modal-header">
                    <h5 class="modal-title" id="pasanganModalLabel">Detail Pasangan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm table-borderless" style="font-size: 8pt;">
                        <tr>
                            <th>Nama Pasangan</th>
                            <td id="modalNama"></td>
                        </tr>
                        <tr>
                            <th>Nama Pegawai</th>
                            <td id="modalPegawai"></td>
                        </tr>
                        <tr>
                            <th>Tempat Lahir</th>
                            <td id="modalTempatLahir"></td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td id="modalTglLahir"></td>
                        </tr>
                        <tr>
                            <th>Tanggal Perkawinan</th>
                            <td id="modalTglPerkawinan"></td>
                        </tr>
                        <tr>
                            <th>Pekerjaan</th>
                            <td id="modalPekerjaan"></td>
                        </tr>
                        <tr>
                            <th>Status Pernikahan</th>
                            <td id="modalStatusPernikahan"></td>
                        </tr>
                        <tr>
                            <th>Status Tunjangan</th>
                            <td id="modalStatusTunjangan"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var pasanganModal = document.getElementById('pasanganModal');
    pasanganModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var pasangan = JSON.parse(button.getAttribute('data-pasangan'));

        document.getElementById('modalNama').textContent = pasangan.nama;
        document.getElementById('modalPegawai').textContent = pasangan.pegawai ? pasangan.pegawai.nama : '-';
        document.getElementById('modalTempatLahir').textContent = pasangan.tempat_lahir;
        document.getElementById('modalTglLahir').textContent = new Date(pasangan.tgl_lahir).toLocaleDateString('id-ID');
        document.getElementById('modalTglPerkawinan').textContent = new Date(pasangan.tgl_perkawinan).toLocaleDateString('id-ID');
        document.getElementById('modalPekerjaan').textContent = pasangan.pekerjaan;
        document.getElementById('modalStatusPernikahan').textContent = pasangan.status_pernikahan;
        document.getElementById('modalStatusTunjangan').textContent = pasangan.status_tunjangan;
    });
</script>
@endsection
