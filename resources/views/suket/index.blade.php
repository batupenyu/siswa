@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Surat Keterangan (Suket)</h1>

  <!-- <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createSuketModal">
    Create New Suket
  </button> -->
  <button type="button" class="btn btn-secondary mb-3" onclick="window.location.href='{{ route('sukets.create') }}'">
    Create Suket
  </button>


  @if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search Suket...">

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Siswa</th>
        <th>Description</th>
        <th>Tanggal Ditetapkan</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="suketTableBody">
      @foreach($sukets as $suket)
      <tr>
        <td>{{ $suket->id }}</td>
        <td>
          {{ $suket->siswa->name ?? 'N/A' }}
          <a href="{{ route('siswas.edit', $suket->siswas_id) }}" class="btn btn-sm btn-outline-secondary ms-2" title="Edit Siswa">
            <i class="bi bi-pencil-square"></i>
          </a>
        </td>
        <td>{{ $suket->description }}</td>
        <td>{{ $suket->tempat_ditetapkan }}</td>
        <td>
          <button class="btn btn-sm btn-warning edit-btn" data-id="{{ $suket->id }}" data-siswas_id="{{ $suket->siswas_id }}" data-description="{{ $suket->description }}" data-tgl_ditetapkan="{{ $suket->tgl_ditetapkan }}" data-tempat_ditetapkan="{{ $suket->tempat_ditetapkan }}" data-bs-toggle="modal" data-bs-target="#editSuketModal">
            <i class="bi bi-pencil-square"></i>
          </button>
          <a href="{{ route('sukets.pdf', $suket->id) }}" class="btn btn-sm btn-info" target="_blank" title="View PDF">
            <i class="bi bi-file-earmark-pdf"></i>
          </a>
          <form action="{{ route('sukets.destroy', $suket->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this suket?')">
              <i class="bi bi-trash"></i>
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $sukets->links() }}
</div>

<!-- Create Suket Modal -->
<div class="modal fade" id="createSuketModal" tabindex="-1" aria-labelledby="createSuketModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('sukets.store') }}" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="createSuketModalLabel">Create Suket</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="siswas_id" class="form-label">Siswa</label>
          <select name="siswas_id" id="siswas_id" class="form-select" required>
            <option value="">Select Siswa</option>
            @foreach($siswas as $siswa)
            <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
          <label for="tgl_ditetapkan" class="form-label">Tanggal Ditetapkan</label>
          <input type="date" name="tgl_ditetapkan" id="tgl_ditetapkan" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="tempat_ditetapkan" class="form-label">Tempat Ditetapkan</label>
          <input type="text" name="tempat_ditetapkan" id="tempat_ditetapkan" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Suket</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit Suket Modal -->
<div class="modal fade" id="editSuketModal" tabindex="-1" aria-labelledby="editSuketModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editSuketForm" method="POST" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title" id="editSuketModalLabel">Edit Suket</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="edit_siswas_id" class="form-label">Siswa</label>
          <select name="siswas_id" id="edit_siswas_id" class="form-select" required>
            <option value="">Select Siswa</option>
            @foreach($siswas as $siswa)
            <option value="{{ $siswa->id }}">{{ $siswa->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="edit_description" class="form-label">Description</label>
          <textarea name="description" id="edit_description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
          <label for="edit_tgl_ditetapkan" class="form-label">Tanggal Ditetapkan</label>
          <input type="date" name="tgl_ditetapkan" id="edit_tgl_ditetapkan" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="edit_tempat_ditetapkan" class="form-label">Tempat Ditetapkan</label>
          <input type="text" name="tempat_ditetapkan" id="edit_tempat_ditetapkan" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update Suket</button>
      </div>
    </form>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const editSuketModal = document.getElementById('editSuketModal');
    const editSuketForm = document.getElementById('editSuketForm');

    editSuketModal.addEventListener('show.bs.modal', function(event) {
      const button = event.relatedTarget;
      console.log('Edit modal show event triggered');
      console.log('Button data attributes:', {
        id: button.getAttribute('data-id'),
        siswas_id: button.getAttribute('data-siswas_id'),
        description: button.getAttribute('data-description'),
        tgl_ditetapkan: button.getAttribute('data-tgl_ditetapkan'),
        tempat_ditetapkan: button.getAttribute('data-tempat_ditetapkan')
      });

      const id = button.getAttribute('data-id');
      const siswas_id = button.getAttribute('data-siswas_id');
      const description = button.getAttribute('data-description');
      const tgl_ditetapkan = button.getAttribute('data-tgl_ditetapkan');
      const tempat_ditetapkan = button.getAttribute('data-tempat_ditetapkan');

      editSuketForm.action = '/sukets/' + id;
      editSuketForm.querySelector('#edit_siswas_id').value = siswas_id;
      editSuketForm.querySelector('#edit_description').value = description;
      editSuketForm.querySelector('#edit_tgl_ditetapkan').value = tgl_ditetapkan;
      editSuketForm.querySelector('#edit_tempat_ditetapkan').value = tempat_ditetapkan;
    });

    // Optional: Implement search filter for the table
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('keyup', function() {
      const filter = searchInput.value.toLowerCase();
      const rows = document.querySelectorAll('#suketTableBody tr');
      rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
      });
    });
  });

  // Additional script to test modal programmatically
  // Removed redundant script that manually shows the createSuketModal on button click
</script>
@endsection