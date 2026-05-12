@php $s = $surat ?? null; @endphp

@if($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
@endif

<div class="row g-3">
    <div class="col-12">
        <label class="form-label">Kop Surat</label>
        <select name="kop_id" class="form-select">
            <option value="">-- Pilih Kop Surat --</option>
            @foreach($kops as $kop)
                <option value="{{ $kop->id }}" {{ old('kop_id', $s?->kop_id) == $kop->id ? 'selected' : '' }}>
                    {{ $kop->filename }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Tanggal Surat</label>
        <input type="date" name="tanggal_surat" class="form-control" value="{{ old('tanggal_surat', $s?->tanggal_surat?->format('Y-m-d')) }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Nomor Surat</label>
        <input type="text" name="nomor_surat" class="form-control" value="{{ old('nomor_surat', $s?->nomor_surat) }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Sifat</label>
        <input type="text" name="sifat" class="form-control" value="{{ old('sifat', $s?->sifat) }}" placeholder="Penting / Biasa">
    </div>
    <div class="col-md-6">
        <label class="form-label">Lampiran</label>
        <input type="text" name="lampiran" class="form-control" value="{{ old('lampiran', $s?->lampiran) }}" placeholder="-">
    </div>
    <div class="col-12">
        <label class="form-label">Perihal</label>
        <input type="text" name="perihal" class="form-control" value="{{ old('perihal', $s?->perihal) }}" required>
    </div>
    <div class="col-12">
        <label class="form-label">Nama Siswa (Tujuan kepada Orang Tua/Wali)</label>
        <select name="nama_siswa" class="form-select" required>
            <option value="">-- Pilih Siswa --</option>
            @foreach($siswas as $siswa)
                <option value="{{ $siswa->name }}" {{ old('nama_siswa', $s?->nama_siswa) == $siswa->name ? 'selected' : '' }}>
                    {{ $siswa->name }} @if($siswa->nis)({{ $siswa->nis }})@endif
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Hari / Tanggal Pertemuan</label>
        <input type="date" name="hari_tanggal" class="form-control" value="{{ old('hari_tanggal', $s?->hari_tanggal?->format('Y-m-d')) }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Tempat</label>
        <input type="text" name="tempat" class="form-control" value="{{ old('tempat', $s?->tempat) }}" required>
    </div>
    <div class="col-12">
        <label class="form-label">Agenda</label>
        <textarea name="agenda" class="form-control" rows="3" required>{{ old('agenda', $s?->agenda) }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label">Paragraf Penutup</label>
        <textarea name="paragraf_penutup" class="form-control" rows="3">{{ old('paragraf_penutup', $s?->paragraf_penutup) }}</textarea>
    </div>
    <div class="col-12"><hr><strong>Tanda Tangan Guru BK</strong></div>
    <div class="col-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="an_guru_bk" value="1" id="an_guru_bk" {{ old('an_guru_bk', $s?->an_guru_bk) ? 'checked' : '' }}>
            <label class="form-check-label" for="an_guru_bk">a.n. Guru BK (centang jika atas nama)</label>
        </div>
    </div>
    <div class="col-12">
        <label class="form-label">Guru BK</label>
        <select name="nama_guru_bk" class="form-select" id="selectGuru" required>
            <option value="">-- Pilih Pegawai --</option>
            @foreach($pegawais as $pegawai)
                <option value="{{ $pegawai->nama }}"
                    data-pangkat="{{ $pegawai->pangkat }}"
                    data-nip="{{ $pegawai->nip }}"
                    {{ old('nama_guru_bk', $s?->nama_guru_bk) == $pegawai->nama ? 'selected' : '' }}>
                    {{ $pegawai->nama }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Pangkat dan Golongan</label>
        <input type="text" name="pangkat_golongan" id="inputPangkat" class="form-control" value="{{ old('pangkat_golongan', $s?->pangkat_golongan) }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">NIP</label>
        <input type="text" name="nip" id="inputNip" class="form-control" value="{{ old('nip', $s?->nip) }}">
    </div>
</div>

@push('scripts')
<script>
document.getElementById('selectGuru').addEventListener('change', function () {
    const opt = this.options[this.selectedIndex];
    document.getElementById('inputPangkat').value = opt.dataset.pangkat || '';
    document.getElementById('inputNip').value = opt.dataset.nip || '';
});
</script>
@endpush
