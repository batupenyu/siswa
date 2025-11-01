@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-header">Daftar St. Pegawai
                <a href="{{ route('st-pegawai.create') }}" class="btn btn-sm btn-success float-end">Create</a>
            </div>
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <table class="table table-striped" style="font-size: 10pt">
                    <thead>
                        <tr style="vertical-align: top">
                            <th>No</th>
<<<<<<< HEAD
                            <th>Nama Pegawai</th>
                            <th>Jlh. Peserta</th>
                            <th>Lama <br> kegiatan</th>
=======
                            <th>No Surat</th>
                            <th>Nama Pegawai</th>
                            <th>Jlh_Peserta/ <br>Jlh_hari</th>
                            <!-- <th>Lama <br> kegiatan</th> -->
>>>>>>> 0da78d7 (commit)
                            <th>Tanggal Awal</th>
                            <th>Tanggal Akhir</th>
                            <th>Nama Kegiatan</th>
                            <th>Tgl. Kegiatan</th>
                            <th>Waktu Kegiatan</th>
                            <th>Tempat Kegiatan</th>
                            <th>Dasar Surat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stPegawaiList as $item)
                        <tr>
                            <td style="text-align: center">{{ $loop->iteration }}.</td>
<<<<<<< HEAD
=======
                            <td>{{ $item->no_surat }}</td>
>>>>>>> 0da78d7 (commit)
                            <td>
                                @if(isset($item->pegawais) && $item->pegawais->isNotEmpty())
                                {{ $item->pegawais->pluck('nama')->implode(', ') }}
                                @endif
                            </td>
<<<<<<< HEAD
                            <td>
                                {{ count($item->pegawais) }}
                                ({{ \Riskihajar\Terbilang\Facades\Terbilang::make(count($item->pegawais)) }} org)
                            </td>
                            <td>
                                <?php
                                // Ensure $item->tgl_awal and $item->tgl_akhir are valid date strings
                                if (!empty($item->tgl_awal) && !empty($item->tgl_akhir)) {
                                    try {
                                        // Convert the date strings to DateTime objects
                                        $dateAwal = new DateTime($item->tgl_awal);
                                        $dateAkhir = new DateTime($item->tgl_akhir);

                                        // Calculate the difference
                                        $diff = $dateAwal->diff($dateAkhir);

                                        // Output the difference in days
                                        // echo $diff->days+1 ." hari";
                                    } catch (Exception $e) {
                                        // Handle invalid date format or other errors
                                        echo "Invalid date format";
                                    }
                                } else {
                                    // Handle missing dates
                                    echo "Dates are missing";
                                }
                                ?>
                                {{ $diff->days+1 }}
                                ({{ \Riskihajar\Terbilang\Facades\Terbilang::make($diff->days+1) }} hari)
                            </td>
=======
                            <?php
                            // Ensure $item->tgl_awal and $item->tgl_akhir are valid date strings
                            if (!empty($item->tgl_awal) && !empty($item->tgl_akhir)) {
                                try {
                                    // Convert the date strings to DateTime objects
                                    $dateAwal = new DateTime($item->tgl_awal);
                                    $dateAkhir = new DateTime($item->tgl_akhir);

                                    // Calculate the difference
                                    $diff = $dateAwal->diff($dateAkhir);

                                    // Output the difference in days
                                    // echo $diff->days+1 ." hari";
                                } catch (Exception $e) {
                                    // Handle invalid date format or other errors
                                    echo "Invalid date format";
                                }
                            } else {
                                // Handle missing dates
                                echo "Dates are missing";
                            }
                            ?>
                            <td style="text-align: center;">
                                {{ count($item->pegawais) }}/
                                {{ $diff->days+1 }}
                                <!-- ({{ \Riskihajar\Terbilang\Facades\Terbilang::make(count($item->pegawais)) }} org) -->
                            </td>
                            <!-- <td>
                                {{ $diff->days+1 }}
                                ({{ \Riskihajar\Terbilang\Facades\Terbilang::make($diff->days+1) }} hari)
                            </td> -->
>>>>>>> 0da78d7 (commit)
                            <td>{{ \Carbon\Carbon::parse($item->tgl_awal)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_akhir)->format('d-m-Y') }}</td>
                            <td>{{ $item->nama_kegiatan }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_kegiatan)->format('d-m-Y') }}</td>
                            <td>{{ $item->jam_kegiatan }}</td>
                            <td>{{ $item->tempat_kegiatan }}</td>
                            <td>
                                @if($item->file)
                                <a href="{{ asset('storage/'.$item->file) }}" target="_blank">Dasar Surat</a>
                                <form action="{{ route('st-surat.upload', $item->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file">
                                    <button type="submit" class="btn btn-primary btn-sm">Reupload File</button>
                                </form>
                                @else
                                <form action="{{ route('st-surat.upload', $item->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file">
                                    <button type="submit" class="btn btn-primary btn-sm">Upload File</button>
                                </form>
                                @endif
                            </td>
                            <td>

                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                        id="dropdownMenuButton-{{ $item->id }}" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="bi-three-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $item->id }}">
                                        <a href="{{ route('st-pegawai.pdf', $item->id) }}" class="dropdown-item"><i
                                                class="bi-file-pdf"></i> Spt</a>
                                        <a href="{{ route('st-pegawai.laporan', $item->id) }}" class="dropdown-item"><i
                                                class="bi-file-pdf"></i> Laporan</a>
                                        <a href="{{ route('rincian_pdf', $item->id) }}" class="dropdown-item"><i
                                                class="bi bi-list-check"></i> Rincian</a>
                                        <a href="{{ route('spb_pdf', $item->id) }}" class="dropdown-item"><i
                                                class="bi bi-list-check"></i> Spb</a>
                                        <a href="{{ route('kwitansi_pdf', $item->id) }}" class="dropdown-item"><i
                                                class="bi bi-list-check"></i> Kwitansi</a>
                                        <a href="{{ route('sppd_depan', $item->id) }}" class="dropdown-item"><i
                                                class="bi bi-list-check"></i> Sppd_1</a>
                                        <a href="{{ route('sppd_pdf', $item->id) }}" class="dropdown-item"><i
                                                class="bi bi-list-check"></i> Sppd_2</a>
                                        <a href="{{ route('photo_surat.index', $item->id) }}" class="dropdown-item"><i
                                                class="bi bi-camera-fill"></i> Photo</a>
                                        <a href="{{ route('st-pegawai.edit', $item->id) }}" class="dropdown-item"><i
                                                class="bi-pen-fill"></i> Edit</a>
                                        <form action="{{ route('st-pegawai.destroy', $item->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
        dropdownElementList.map(function(dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl)
        })
    });
</script>
@endpush