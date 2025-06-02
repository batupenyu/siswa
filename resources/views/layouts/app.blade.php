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
        <a href="{{ route('siswas.index') }}"><i class="bi bi-gear"></i> Siswa</a>
        <a href="{{ route('pegawais.index') }}"><i class="bi bi-gear"></i> Pegawai</a>
        <a href="{{ route('holidays.index') }}"><i class="bi bi-calendar-event"></i> Holidays</a>
        <a href="{{ route('sukets.index') }}"><i class="bi bi-file-text"></i> Suket</a>
        <a href="{{ route('penilai.index') }}"><i class="bi bi-person-check"></i> Penilai</a>
        <a href="{{ route('kpa.index') }}"><i class="bi bi-people"></i> KPA</a>
        <a href="{{ route('bp.index') }}"><i class="bi bi-person-badge"></i> BP</a>
        <div class="dropdown position-relative">
            {{-- Dropdown for Dokumen --}}
            <button type="button" id="dropdownDokumen" class="btn btn-link dropdown-toggle p-3 text-white" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;">
                <i class="bi bi-gear"></i> Dokumen
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownDokumen">
                <li><a class="dropdown-item" style="color: black;" href="{{ route('surat') }}">Surat tugas siswa</a></li>
                <li><a class="dropdown-item" style="color: black;" href="{{ route('stPegawai.index') }}">Surat tugas pegawai</a></li>
                <li><a class="dropdown-item" style="color: black;" href="{{ route('akKredit.index') }}">Angka kredit</a></li>
                <li><a class="dropdown-item" style="color: black;" href="{{ route('dispensasi.index') }}">Surat Dispensasi</a></li>
            </ul>
        </div>
        {{-- <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dropdownToggle = document.getElementById('dropdownDokumen');
            if (dropdownToggle) {
                var dropdown = new bootstrap.Dropdown(dropdownToggle);

                // Stop propagation on dropdown toggle click
                dropdownToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                });

                // Re-initialize dropdown on sidebar link clicks
                var sidebarLinks = document.querySelectorAll('.sidebar a');
                sidebarLinks.forEach(function(link) {
                    link.addEventListener('click', function() {
                        dropdown.hide();
                        dropdown.dispose();
                        dropdown = new bootstrap.Dropdown(dropdownToggle);
                    });
                });
            }
        });
    </script>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Removed Bootstrap 4.6.2 JS to avoid conflict with Bootstrap 5 -->

<!-- Include Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dropdownToggle = document.getElementById('dropdownDokumen');
        if (dropdownToggle) {
            var dropdown = new bootstrap.Dropdown(dropdownToggle);

            // Stop propagation on dropdown toggle click
            dropdownToggle.addEventListener('click', function(e) {
                e.stopPropagation();
            });

            // Re-initialize dropdown on sidebar link clicks
            var sidebarLinks = document.querySelectorAll('.sidebar a');
            sidebarLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    dropdown.hide();
                    dropdown.dispose();
                    dropdown = new bootstrap.Dropdown(dropdownToggle);
                });
            });
        }
    });
</script>
</body>

</html>