<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-papb+Q+6XQ6X+6XQ6X+6XQ6X+6XQ6X+6XQ6X+6XQ6X+6XQ6X+6XQ6X+6XQ6X+6XQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('styles')

    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #212529;
            border-right: 1px solid #343a40;
        }

        .sidebar .nav-link {
            color: #e0e0e0;
            border-radius: 0.25rem;
            margin-bottom: 0.25rem;
        }

        .sidebar .nav-link:hover {
            background-color: #343a40;
            color: #ffffff;
        }

        .sidebar .nav-link.active {
            background-color: #495057;
            color: #ffffff;
        }

        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
        }

        .main-content {
            padding: 20px;
            background-color: #121212;
            min-height: 100vh;
        }

        a {
            color: #66b2ff;
        }

        a:hover {
            color: #99ccff;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block sidebar collapse show">
                <div class="position-sticky pt-3">
                    <h4 class="text-center mb-4">My App</h4>
                    <div class="d-flex flex-column px-3">
                        <a href="{{ route('header_icon_images.index') }}" class="nav-link"><i class="bi bi-image"></i> Ganti kop</a>
                        <a href="{{ route('siswas.index') }}" class="nav-link"><i class="bi bi-people"></i> Siswa</a>
                        <a href="{{ route('kelas.index') }}" class="nav-link"><i class="bi bi-building"></i> Kelas</a>
                        <a href="{{ route('holidays.index') }}" class="nav-link"><i class="bi bi-calendar-event"></i> Libur</a>
                        <a href="{{ route('pegawais.index') }}" class="nav-link"><i class="bi bi-people"></i> Pegawai</a>
                        <a href="{{ route('penilai.index') }}" class="nav-link"><i class="bi bi-person-check"></i> Penilai</a>
                        <a href="{{ route('kpa.index') }}" class="nav-link"><i class="bi bi-person-check"></i> KPA</a>
                        <a href="{{ route('bp.index') }}" class="nav-link"><i class="bi bi-person-badge"></i> BP</a>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="suratDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-folder"></i> Surat
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="suratDropdown">
                                <li><a class="dropdown-item" href="{{ route('surat_izin_pegawai.index') }}"><i class="bi bi-person-badge"></i> Surat izin pegawai</a></li>
                                <li><a class="dropdown-item" href="{{ route('stPegawai.index') }}"><i class="bi bi-person-badge"></i> Surat tugas pegawai</a></li>
                                <li><a class="dropdown-item" href="{{ route('akKredits.index') }}"><i class="bi bi-person-badge"></i> Angka kredit</a></li>
                                <li><a class="dropdown-item" href="{{ route('mutasi.index') }}"><i class="bi bi-arrow-left-right"></i> Surat mutasi siswa</a></li>
                                <li><a class="dropdown-item" href="{{ route('sukets.index') }}"><i class="bi bi-file-text"></i> Surat ket. siswa</a></li>
<li><a class="dropdown-item" href="{{ route('surats.index') }}"><i class="bi bi-person-badge"></i> Surat tugas siswa</a></li>
                                <li><a class="dropdown-item" href="{{ route('dispensasi.index') }}"><i class="bi bi-person-badge"></i> Surat dispen siswa</a></li>
                                <li><a class="dropdown-item" href="{{ route('siswa-profil.index') }}"><i class="bi bi-person-badge"></i> Siswa Profil</a></li>
                            </ul>
                        </div>
                        <a href="{{ route('anak.index') }}" class="nav-link"><i class="bi bi-people"></i> Anak & KP4</a>
                        <a href="{{ route('pasangan.index') }}" class="nav-link"><i class="bi bi-people"></i> Pasangan</a>
                        <a href="{{ route('pp_gaji.index') }}" class="nav-link"><i class="bi bi-cash-stack"></i> PP Gaji</a>
                        <a href="{{ route('pergub.index') }}" class="nav-link"><i class="bi bi-file-earmark-text"></i> Pergub</a>
                        <a href="{{ route('perda.index') }}" class="nav-link"><i class="bi bi-file-earmark-text"></i> Perda</a>
                        <a href="{{ route('bends.index') }}" class="nav-link"><i class="bi bi-list-check"></i> Bend</a>
                        <a href="{{ route('ipps.index') }}" class="nav-link"><i class="bi bi-list-check"></i> Donasi</a>
                        <a href="{{ route('cuti.index') }}" class="nav-link"><i class="bi bi-calendar-check"></i> Cuti</a>
                        <a href="{{ route('sisa_cuti.index') }}" class="nav-link"><i class="bi bi-calendar-check"></i> Sisa Cuti</a>
                        <a href="{{ route('spmts.index') }}" class="nav-link"><i class="bi bi-file-earmark-text"></i> SPMT</a>
                        @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link" style="background: none; border: none;"><i class="bi bi-box-arrow-right"></i> Logout</button>
                        </form>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>