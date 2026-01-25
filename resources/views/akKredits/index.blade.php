@extends('layouts.app')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<style>
    /* General table styling */
    table {
        width: 100%; /* Set table width to full container */
        border-collapse: collapse; /* Remove default spacing between cells */
        font-family: Arial, sans-serif; /* Set font family */
        margin: 20px 0; /* Add some margin above and below the table */
    }

    /* Style for table headers */
    th {
        background-color: #4CAF50; /* Green background for headers */
        color: white; /* White text for readability */
        padding: 10px; /* Add padding inside header cells */
        text-align: left; /* Align text to the left */
        font-weight: bold; /* Make header text bold */
    }

    /* Style for table data cells */
    td {
        border: 1px solid #ddd; /* Add a light gray border around cells */
        padding: 8px; /* Add padding inside data cells */
        text-align: left; /* Align text to the left */
    }

    /* Hover effect for rows */
    tr:hover {
        background-color: #f5f5f5; /* Light gray background on hover */
    }

    /* Zebra striping (alternating row colors) */
    tr:nth-child(even) {
        background-color: #f9f9f9; /* Light gray background for even rows */
    }

    /* Style for caption (if present) */
    caption {
        caption-side: top; /* Place caption at the top */
        font-size: 1.2em; /* Increase font size */
        margin-bottom: 10px; /* Add space below the caption */
        font-weight: bold; /* Bold font for caption */
    }

    /* Print PDF Button Styling */
    .print-pdf-btn {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .print-pdf-btn:hover {
        background-color: #0056b3;
    }
</style>
<style>
    /* Inline styling for the form */
    .inline-form {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        gap: 10px; /* Space between elements */
        margin-bottom: 20px;
    }

    /* Container for checkboxes */
    .checkbox-container {
        margin: 10px 0;
    }

    /* Styling for input fields */
    .inline-form input[type="date"] {
        padding: 8px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 100%;
    }

    /* Styling for the submit button */
    .inline-form input[type="submit"] {
        padding: 10px 15px;
        font-size: 16px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.3s;
    }

    /* Hover effect for the submit button */
    .inline-form input[type="submit"]:hover {
        background-color: #0056b3;
    }

    /* Responsive adjustments */
    @media (min-width: 768px) {
        .inline-form {
            flex-direction: row;
            align-items: flex-start;
        }

        .inline-form input[type="submit"] {
            width: auto;
            min-width: 180px;
        }

        .checkbox-container {
            flex: 1;
        }
    }

    /* Additional responsive adjustments for smaller screens */
    @media (max-width: 767px) {
        .inline-form {
            gap: 15px;
        }

        .periode-checkboxes {
            max-height: 150px !important;
        }
    }
    </style>
    </head>
@section('content')

<body>
    <style>
        .full-width {
            width: 100%;
        }
        .mb-10 {
            margin-bottom: 10px;
        }
        .mt-20 {
            margin-top: 20px;
        }
    </style>
    
    <div class="card full-width">
        <div class="card-header">
            <h3 class="card-title">Laporan Angka Kredit</h3>
        </div>

        
    <!-- Dropdown to select pegawai -->
    <div class="container p-3 bg-light rounded border">
        <form method="GET" action="{{ route('akKredits.index') }}">
            <div class="mb-3">
                <label for="pegawai_id" class="form-label fw-bold">Select Pegawai:</label>
                <select name="pegawai_id" id="pegawai_id" onchange="this.form.submit()" class="form-select">
                    <option value="">Pilih Pegawai</option>
                    @foreach ($pegawais as $pegawai)
                        <option value="{{ $pegawai->id }}" {{ $pegawaiId == $pegawai->id ? 'selected' : '' }}>
                            {{ $pegawai->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
        <a class="btn btn-primary mt-2" href="{{ route('akKredits.create') }}">Buat AK</a>
    </div>

        
        <div class="card-body full-width">
            <!-- First Form: Generate PDF -->
            <form class="inline-form full-width" action="{{ route('akKredits.generatePdf') }}" method="GET">
                <div class="mb-10 checkbox-container">
                    <label class="form-label">Options:</label>
                    <div class="periode-checkboxes" style="max-height: 200px; overflow-y: auto; border: 1px solid #ccc; padding: 10px; border-radius: 4px;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="angka_integrasi" id="angka_integrasi_akumulasi">
                            <label class="form-check-label" for="angka_integrasi_akumulasi">Angka Integrasi</label>
                        </div>
                        <hr style="margin: 10px 0;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="periode[]" value="all" id="periode_all_akumulasi">
                            <label class="form-check-label" for="periode_all_akumulasi">All Periods</label>
                        </div>
                        @foreach($availablePeriods as $period)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="periode[]" value="{{ $period['value'] }}" id="periode_{{ $loop->index }}_akumulasi_{{ $period['value'] }}">
                            <label class="form-check-label" for="periode_{{ $loop->index }}_akumulasi_{{ $period['value'] }}">{{ $period['label'] }}</label>
                        </div>
                        @endforeach
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="periode[]" value="current_year" id="periode_current_year_akumulasi">
                            <label class="form-check-label" for="periode_current_year_akumulasi">Current Year</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="periode[]" value="last_year" id="periode_last_year_akumulasi">
                            <label class="form-check-label" for="periode_last_year_akumulasi">Last Year</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="periode[]" value="last_2_years" id="periode_last_2_years_akumulasi">
                            <label class="form-check-label" for="periode_last_2_years_akumulasi">Last 2 Years</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="periode[]" value="last_5_years" id="periode_last_5_years_akumulasi">
                            <label class="form-check-label" for="periode_last_5_years_akumulasi">Last 5 Years</label>
                        </div>
                    </div>
                </div>

                <!-- Hidden date fields with default values -->
                <input type="hidden" name="tgl_awal" value="2022-01-01">
                <input type="hidden" name="tgl_akhir" value="{{ date('Y-m-d') }}">

                <input type="hidden" name="pegawai_id" value="{{ $pegawaiId }}">
                <input type="submit" value="Print Akumulasi" class="full-width">
            </form>

            <!-- Second Form: Penetapan -->
            <form class="inline-form full-width mt-20" action="{{ route('akKredits.penetapan') }}" method="GET">
                <div class="mb-10 checkbox-container">
                    <label class="form-label">Options:</label>
                    <div class="periode-checkboxes" style="max-height: 200px; overflow-y: auto; border: 1px solid #ccc; padding: 10px; border-radius: 4px;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="angka_integrasi" id="angka_integrasi_penetapan">
                            <label class="form-check-label" for="angka_integrasi_penetapan">Angka Integrasi</label>
                        </div>
                        <hr style="margin: 10px 0;">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="periode[]" value="all" id="periode_all_penetapan">
                            <label class="form-check-label" for="periode_all_penetapan">All Periods</label>
                        </div>
                        @foreach($availablePeriods as $period)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="periode[]" value="{{ $period['value'] }}" id="periode_{{ $loop->index }}_penetapan_{{ $period['value'] }}">
                            <label class="form-check-label" for="periode_{{ $loop->index }}_penetapan_{{ $period['value'] }}">{{ $period['label'] }}</label>
                        </div>
                        @endforeach
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="periode[]" value="current_year" id="periode_current_year_penetapan">
                            <label class="form-check-label" for="periode_current_year_penetapan">Current Year</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="periode[]" value="last_year" id="periode_last_year_penetapan">
                            <label class="form-check-label" for="periode_last_year_penetapan">Last Year</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="periode[]" value="last_2_years" id="periode_last_2_years_penetapan">
                            <label class="form-check-label" for="periode_last_2_years_penetapan">Last 2 Years</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="periode[]" value="last_5_years" id="periode_last_5_years_penetapan">
                            <label class="form-check-label" for="periode_last_5_years_penetapan">Last 5 Years</label>
                        </div>
                    </div>
                </div>

                <!-- Hidden date fields with default values -->
                <input type="hidden" name="tgl_awal" value="2022-01-01">
                <input type="hidden" name="tgl_akhir" value="{{ date('Y-m-d') }}">

                <input type="hidden" name="pegawai_id" value="{{ $pegawaiId }}">
                <input type="submit" value="Print Penetapan" class="full-width">
            </form>
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Print Preview Button -->
    <form method="GET" action="{{ route('akKredits.generatePdf') }}" target="_blank" class="mb-3">
        <input type="hidden" name="pegawai_id" value="{{ $pegawaiId }}">
        {{-- <button type="submit" class="print-pdf-btn">Print Akumulasi</button> --}}
    </form>

    <!-- Display akKredits -->
    @if ($akKredits->isEmpty())
        <p>No records found.</p>
    @else
        <table id="akKreditsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tahun</th>
                    <th>Pegawai
                        <a href="javascript:void(0);" class="edit-pegawai-btn" data-id="{{ $akKredit->pegawai->id }}" title="Edit Pegawai"><i class="bi-pen-fill"></i></a>
                    </th>
                    <th>Predikat</th>
                    <th style="text-align: center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($akKredits as $akKredit)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{Carbon\Carbon::parse($akKredit->startDate)->format('Y')}}
                        </td>
                        <td>{{ $akKredit->pegawai->nama }}
                        </td>
                        <td>{{ $akKredit->predikat }}</td>
                        <td style="text-align: center">
                            <!-- View PDF Icon -->
                            <a href="{{ route('akKredits.viewPdf', $akKredit->id) }}" target="_blank" class="btn btn-sm btn-success me-2" aria-label="View PDF">
                                <i class="fas fa-file-pdf"></i>
                            </a>

                            <!-- Edit Icon -->
                            <a href="{{ route('akKredits.edit', $akKredit->id) }}" class="btn btn-sm btn-primary me-2" aria-label="Edit Record">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Delete Icon -->
                            <form action="{{ route('akKredits.destroy', $akKredit->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?')" aria-label="Delete Record">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $akKredits->links() }}
    @endif
    
<!-- Modal -->
<div class="modal fade" id="editPegawaiModal" tabindex="-1" aria-labelledby="editPegawaiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPegawaiModalLabel">Edit Pegawai</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="editPegawaiFormContainer">
          <!-- AJAX loaded form will be injected here -->
          <p>Loading...</p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-pegawai-btn');
    const modal = new bootstrap.Modal(document.getElementById('editPegawaiModal'));
    const formContainer = document.getElementById('editPegawaiFormContainer');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const pegawaiId = this.getAttribute('data-id');
            // Load the edit form via AJAX
            fetch(`/pegawais/${pegawaiId}/edit-modal`)
                .then(response => response.text())
                .then(html => {
                    formContainer.innerHTML = html;
                    modal.show();

                    // Attach submit event to the loaded form
                    const form = formContainer.querySelector('form');
                    if (form) {
                        // Remove any existing submit event listeners to avoid duplicates
                        const submitHandler = function(e) {
                            e.preventDefault();
                            console.log('Form submitted');
                            const formData = new FormData(form);

                            // Get CSRF token
                            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                            console.log('CSRF Token:', csrfToken);

                            fetch(form.action, {
                                method: form.method,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': csrfToken,
                                },
                                body: formData
                            })
                            .then(response => {
                                console.log('Response status:', response.status);
                                return response.json();
                            })
                            .then(data => {
                                console.log('Response data:', data);
                                if (data.success) {
                                    // Close modal and optionally refresh or update the table row
                                    modal.hide();
                                    location.reload(); // Simple approach: reload the page to reflect changes
                                } else {
                                    // Display errors
                                    const errorsContainer = form.querySelector('.errors');
                                    if (errorsContainer) {
                                        errorsContainer.innerHTML = '';
                                        for (const key in data.errors) {
                                            const errorList = data.errors[key];
                                            errorList.forEach(error => {
                                                const errorElem = document.createElement('div');
                                                errorElem.textContent = error;
                                                errorsContainer.appendChild(errorElem);
                                            });
                                        }
                                    }
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                        };

                        // Remove existing listener before adding new one
                        form.removeEventListener('submit', submitHandler);
                        form.addEventListener('submit', submitHandler);

                        // Add click event listener for simpan_perubahan button to trigger form submission
                        const simpanButton = form.querySelector('#simpan_perubahan');
                        if (simpanButton) {
                            // Remove existing click listener before adding new one
                            const clickHandler = function(e) {
                                console.log('Simpan Perubahan button clicked');
                                e.preventDefault();
                                form.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
                            };

                            simpanButton.removeEventListener('click', clickHandler);
                            simpanButton.addEventListener('click', clickHandler);
                        }
                    }
                })
                .catch(error => {
                    formContainer.innerHTML = '<p class="text-danger">Failed to load form.</p>';
                    console.error('Error loading form:', error);
                });
        });
    });
});

</script>
@endsection
