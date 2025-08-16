{{-- <img src="{{ asset('images/kopSekolah.PNG') }}" alt=""> --}}

<h1>{{ $siswa->name }}</h1>
<p>NIS: {{ $siswa->nis }}</p>
<p>Kelas: {{ $siswa->kelas->name }}</p>