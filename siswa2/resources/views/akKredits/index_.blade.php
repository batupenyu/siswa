@extends('layouts.app')

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

@section('content')
    <h1>AkKredits</h1>

    <!-- Print PDF Button -->
    <button class="print-pdf-btn" id="printPdfBtn">Preview PDF</button>

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
    </div>

    <!-- Display akKredits -->
    @if ($akKredits->isEmpty())
        <p>No records found.</p>
    @else
        <table id="akKreditsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pegawai</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($akKredits as $akKredit)
                    <tr>
                        <td>{{ $akKredit->id }}</td>
                        <td>{{ $akKredit->pegawai->nama }}</td>
                        <td>{{ $akKredit->predikat }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Include jsPDF and html2canvas libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <script>
        document.getElementById('printPdfBtn').addEventListener('click', function () {
            // Get the table element
            const table = document.getElementById('akKreditsTable');

            // Use html2canvas to capture the table as an image
            html2canvas(table).then(canvas => {
                // Convert the canvas to an image data URL
                const imgData = canvas.toDataURL('image/png');

                // Initialize jsPDF
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF();

                // Add the image to the PDF
                const imgProps = pdf.getImageProperties(imgData);
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);

                // Generate a data URL for the PDF
                const pdfDataUrl = pdf.output('datauristring');

                // Open the PDF in a new browser tab
                const newTab = window.open();
                newTab.document.write(`<iframe width='100%' height='100%' src='${pdfDataUrl}'></iframe>`);
            });
        });
    </script>
@endsection