<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'My App')</title>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Removed Bootstrap 4.6.2 CSS to avoid conflict with Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-papb+Y1+Y+6k+6Q5b+6Q5b+6Q5b+6Q5b+6Q5b+6Q5b+6Q5b+6Q5b+6Q5b+6Q5b+6Q5b+6Q5b+6Q5b+6Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Custom styles for the sidebar */
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        /* Style dropdown toggle button to match sidebar links */
        .sidebar .dropdown>button.dropdown-toggle {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            width: 100%;
            text-align: left;
            background: none;
            border: none;
        }

        .sidebar .dropdown>button.dropdown-toggle:hover {
            background-color: #495057;
        }

        .main-content {
            margin-left: 250px;
            /* Offset for the sidebar */
            padding: 20px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center mb-4">My App</h4>
        <a href="{{ route('header_icon_images.index') }}"><i class="bi bi-image"></i> Ganti Kop Surat</a>
        <a href="{{ route('siswas.index') }}"><i class="bi bi-people"></i> Siswa</a>
        <a href="{{ route('pegawais.index') }}"><i class="bi bi-people"></i> Pegawai</a>
        <a href="{{ route('holidays.index') }}"><i class="bi bi-calendar-event"></i> Holidays</a>
        <a href="{{ route('sukets.index') }}"><i class="bi bi-file-text"></i> Suket</a>
        <a href="{{ route('penilai.index') }}"><i class="bi bi-person-check"></i> Penilai</a>
        <a href="{{ route('kpa.index') }}"><i class="bi bi-person-check"></i> KPA</a>
        <a href="{{ route('bp.index') }}"><i class="bi bi-person-badge"></i> BP</a>
        <a href="{{ route('surat_izin_pegawai.index') }}"><i class="bi bi-person-badge"></i> Surat Izin Pegawai</a>
        <a href="{{ route('surat') }}"><i class="bi bi-person-badge"></i> Surat tugas siswa</a>
        <a href="{{ route('stPegawai.index') }}"><i class="bi bi-person-badge"></i> Surat tugas pegawai</a>
        <a href="{{ route('akKredit.index') }}"><i class="bi bi-person-badge"></i> Angka kredit</a>
        <a href="{{ route('dispensasi.index') }}"><i class="bi bi-person-badge"></i> Surat Dispensasi</a>

    </div>
    {{-- <a href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form> --}}
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Removed custom dropdown initialization script to avoid conflicts with Bootstrap dropdowns -->
</body>

</html>
<!-- Removed duplicate jQuery, Select2, and Bootstrap JS includes and custom dropdown script -->

</body>

</html>