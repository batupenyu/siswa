@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Siswa Profil</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="body-card p-4">
        <form action="{{ route('siswa-profil.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row align-items-center">
                        <label for="siswa_id" class="col-sm-4 col-form-label text-end">Siswa</label>
                        <div class="col-sm-8">
                            <select name="siswa_id" class="form-control" required>
                                <option value="">-- Select Siswa --</option>
                                @foreach($siswas as $siswa)
                                <option value="{{ $siswa->id }}" {{ old('siswa->name')==$siswa->name ? 'selected' : ''
                                    }}>
                                    {{ $siswa->name ?? 'Siswa ID: ' . $siswa->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="nama_panggilan" class="col-sm-4 col-form-label text-end">Nama Panggilan</label>
                        <div class="col-sm-8">
                            <input type="text" name="nama_panggilan" class="form-control"
                                value="{{ old('nama_panggilan') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="jenis_kelamin" class="col-sm-4 col-form-label text-end">Jenis Kelamin</label>
                        <div class="col-sm-8">
                            <select name="jenis_kelamin" class="form-control">
                                <option value="">-- Select --</option>
                                <option value="L" {{ old('jenis_kelamin')=='L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin')=='P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="tempat_tanggal_lahir" class="col-sm-4 col-form-label text-end">Tempat Tanggal
                            Lahir</label>
                        <div class="col-sm-8">
                            <input type="text" name="tempat_tanggal_lahir" class="form-control"
                                value="{{ old('tempat_tanggal_lahir') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="agama" class="col-sm-4 col-form-label text-end">Agama</label>
                        <div class="col-sm-8">
                            <select name="agama" class="form-control">
                                <option value="">-- Select --</option>
                                <option value="islam" {{ old('agama')=='islam' ? 'selected' : '' }}>Islam</option>
                                <option value="budha" {{ old('agama')=='budha' ? 'selected' : '' }}>Budha</option>
                                <option value="hindu" {{ old('agama')=='hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="kristen" {{ old('agama')=='kristen' ? 'selected' : '' }}>Kristen</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="jurusan" class="col-sm-4 col-form-label text-end">Jurusan</label>
                        <div class="col-sm-8">
                            <select name="jurusan" class="form-control">
                                <option value="">-- Select Jurusan --</option>
                                <option value="TBSM" {{ old('jurusan')=='TBSM' ? 'selected' : '' }}>TBSM</option>
                                <option value="TKR" {{ old('jurusan')=='TKR' ? 'selected' : '' }}>TKR</option>
                                <option value="TITL" {{ old('jurusan')=='TITL' ? 'selected' : '' }}>TITL</option>
                                <option value="TP" {{ old('jurusan')=='TP' ? 'selected' : '' }}>TP</option>
                                <option value="TKJ" {{ old('jurusan')=='TKJ' ? 'selected' : '' }}>TKJ</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="kewarganegaraan" class="col-sm-4 col-form-label text-end">Kewarganegaraan</label>
                        <div class="col-sm-8">
                            <input type="text" name="kewarganegaraan" class="form-control"
                                value="{{ old('kewarganegaraan') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="anak_ke_berapa" class="col-sm-4 col-form-label text-end">Anak Ke Berapa</label>
                        <div class="col-sm-8">
                            <input type="number" name="anak_ke_berapa" class="form-control"
                                value="{{ old('anak_ke_berapa') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="jumlah_saudara_kandung" class="col-sm-4 col-form-label text-end">Jumlah Saudara
                            Kandung</label>
                        <div class="col-sm-8">
                            <input type="number" name="jumlah_saudara_kandung" class="form-control"
                                value="{{ old('jumlah_saudara_kandung') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="jumlah_saudara_tiri" class="col-sm-4 col-form-label text-end">Jumlah Saudara
                            Tiri</label>
                        <div class="col-sm-8">
                            <input type="number" name="jumlah_saudara_tiri" class="form-control"
                                value="{{ old('jumlah_saudara_tiri') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="jumlah_saudara_angkat" class="col-sm-4 col-form-label text-end">Jumlah Saudara
                            Angkat</label>
                        <div class="col-sm-8">
                            <input type="number" name="jumlah_saudara_angkat" class="form-control"
                                value="{{ old('jumlah_saudara_angkat') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="status_anak" class="col-sm-4 col-form-label text-end">Status Anak</label>
                        <div class="col-sm-8">
                            <select name="status_anak" class="form-control">
                                <option value="">-- Select --</option>
                                <option value="-" {{ old('status_anak')=='-' ? 'selected' : '' }}>-</option>
                                <option value="yatim" {{ old('status_anak')=='yatim' ? 'selected' : '' }}>Yatim</option>
                                <option value="piatu" {{ old('status_anak')=='piatu' ? 'selected' : '' }}>Piatu</option>
                                <option value="yatim-piatu" {{ old('status_anak')=='yatim-piatu' ? 'selected' : '' }}>
                                    Yatim Piatu</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="bahasa_sehari_hari_di_rumah" class="col-sm-4 col-form-label text-end">Bahasa
                            Sehari-hari di Rumah</label>
                        <div class="col-sm-8">
                            <input type="text" name="bahasa_sehari_hari_di_rumah" class="form-control"
                                value="{{ old('bahasa_sehari_hari_di_rumah') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="alamat" class="col-sm-4 col-form-label text-end">Alamat</label>
                        <div class="col-sm-8">
                            <textarea name="alamat" class="form-control">{{ old('alamat') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label for="nomor_telepon" class="col-sm-4 col-form-label text-end">Nomor Telepon</label>
                        <div class="col-sm-8">
                            <input type="text" name="nomor_telepon" class="form-control"
                                value="{{ old('nomor_telepon') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="tinggal_dengan" class="col-sm-4 col-form-label text-end">Tinggal Dengan</label>
                        <div class="col-sm-8">
                            <select name="tinggal_dengan" class="form-control">
                                <option value="">-- Select --</option>
                                <option value="orang_tua" {{ old('tinggal_dengan')=='orang_tua' ? 'selected' : '' }}>
                                    Orang Tua</option>
                                <option value="saudara" {{ old('tinggal_dengan')=='saudara' ? 'selected' : '' }}>Saudara
                                </option>
                                <option value="di_asrama" {{ old('tinggal_dengan')=='di_asrama' ? 'selected' : '' }}>Di
                                    Asrama</option>
                                <option value="kos" {{ old('tinggal_dengan')=='kos' ? 'selected' : '' }}>Kos</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="jarak_tempat_tinggal_ke_sekolah" class="col-sm-4 col-form-label text-end">Jarak
                            Tempat Tinggal ke Sekolah (km)</label>
                        <div class="col-sm-8">
                            <input type="number" step="0.01" name="jarak_tempat_tinggal_ke_sekolah" class="form-control"
                                value="{{ old('jarak_tempat_tinggal_ke_sekolah') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="golongan_darah" class="col-sm-4 col-form-label text-end">Golongan Darah</label>
                        <div class="col-sm-8">
                            <input type="text" name="golongan_darah" class="form-control"
                                value="{{ old('golongan_darah') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="penyakit_yang_pernah_diderita" class="col-sm-4 col-form-label text-end">Penyakit
                            yang Pernah Diderita</label>
                        <div class="col-sm-8">
                            <select name="penyakit_yang_pernah_diderita" class="form-control">
                                <option value="">-- Select --</option>
                                <option value="tbc" {{ old('penyakit_yang_pernah_diderita')=='tbc' ? 'selected' : '' }}>
                                    TBC</option>
                                <option value="cacar" {{ old('penyakit_yang_pernah_diderita')=='cacar' ? 'selected' : ''
                                    }}>Cacar</option>
                                <option value="malaria" {{ old('penyakit_yang_pernah_diderita')=='malaria' ? 'selected'
                                    : '' }}>Malaria
                                </option>
                                <option value="dll" {{ old('penyakit_yang_pernah_diderita')=='dll' ? 'selected' : '' }}>
                                    DLL</option>
                                <option value="-" {{ old('penyakit_yang_pernah_diderita')=='-' ? 'selected' : '' }}>
                                    -</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">


                    <div class="form-group row align-items-center">
                        <label for="kelainan_jasmani" class="col-sm-4 col-form-label text-end">Kelainan Jasmani</label>
                        <div class="col-sm-8">
                            <input type="text" name="kelainan_jasmani" class="form-control"
                                value="{{ old('kelainan_jasmani') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="tinggi_dan_berat_badan" class="col-sm-4 col-form-label text-end">Tinggi dan Berat
                            Badan</label>
                        <div class="col-sm-8">
                            <input type="text" name="tinggi_dan_berat_badan" class="form-control"
                                value="{{ old('tinggi_dan_berat_badan') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="pendidikan_sebelumnya" class="col-sm-4 col-form-label text-end">Pendidikan
                            Sebelumnya</label>
                        <div class="col-sm-8">
                            <input type="text" name="pendidikan_sebelumnya" class="form-control"
                                value="{{ old('pendidikan_sebelumnya') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="lulusan_dari" class="col-sm-4 col-form-label text-end">Lulusan Dari</label>
                        <div class="col-sm-8">
                            <input type="text" name="lulusan_dari" class="form-control"
                                value="{{ old('lulusan_dari') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="tanggal_dan_nomor_sttb" class="col-sm-4 col-form-label text-end">Tanggal dan Nomor
                            STTB</label>
                        <div class="col-sm-8">
                            <input type="text" name="tanggal_dan_nomor_sttb" class="form-control"
                                value="{{ old('tanggal_dan_nomor_sttb') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="lama_belajar" class="col-sm-4 col-form-label text-end">Lama Belajar</label>
                        <div class="col-sm-8">
                            <input type="text" name="lama_belajar" class="form-control"
                                value="{{ old('lama_belajar') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="dari_sekolah" class="col-sm-4 col-form-label text-end">Dari Sekolah</label>
                        <div class="col-sm-8">
                            <input type="text" name="dari_sekolah" class="form-control"
                                value="{{ old('dari_sekolah') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="alasan_pindah" class="col-sm-4 col-form-label text-end">Alasan Pindah</label>
                        <div class="col-sm-8">
                            <textarea name="alasan_pindah" class="form-control">{{ old('alasan_pindah') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="diterima_di_sekolah_ini" class="col-sm-4 col-form-label text-end">Diterima di
                            Sekolah Ini</label>
                        <div class="col-sm-8">
                            <input type="text" name="diterima_di_sekolah_ini" class="form-control"
                                value="{{ old('diterima_di_sekolah_ini') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="di_kelas" class="col-sm-4 col-form-label text-end">Di Kelas</label>
                        <div class="col-sm-8">
                            <input type="text" name="di_kelas" class="form-control" value="{{ old('di_kelas') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="kelompok" class="col-sm-4 col-form-label text-end">Kelompok</label>
                        <div class="col-sm-8">
                            <input type="text" name="kelompok" class="form-control" value="{{ old('kelompok') }}">
                        </div>
                    </div>



                    <div class="form-group row align-items-center">
                        <label for="tanggal_diterima" class="col-sm-4 col-form-label text-end">Tanggal Diterima</label>
                        <div class="col-sm-8">
                            <input type="date" name="tanggal_diterima" class="form-control"
                                value="{{ old('tanggal_diterima') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="kesenian_kegemaran_siswa" class="col-sm-4 col-form-label text-end">Kesenian
                            Kegemaran Siswa</label>
                        <div class="col-sm-8">
                            <input type="text" name="kesenian_kegemaran_siswa" class="form-control"
                                value="{{ old('kesenian_kegemaran_siswa') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="olahraga_kegemaran_siswa" class="col-sm-4 col-form-label text-end">Olahraga
                            Kegemaran Siswa</label>
                        <div class="col-sm-8">
                            <input type="text" name="olahraga_kegemaran_siswa" class="form-control"
                                value="{{ old('olahraga_kegemaran_siswa') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="kegiatan_kemasyarakatan_kegemaran_siswa"
                            class="col-sm-4 col-form-label text-end">Kegiatan Kemasyarakatan Kegemaran Siswa</label>
                        <div class="col-sm-8">
                            <input type="text" name="kegiatan_kemasyarakatan_kegemaran_siswa" class="form-control"
                                value="{{ old('kegiatan_kemasyarakatan_kegemaran_siswa') }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="kegemaran_lain_lain" class="col-sm-4 col-form-label text-end">Kegemaran
                            Lain-lain</label>
                        <div class="col-sm-8">
                            <input type="text" name="kegemaran_lain_lain" class="form-control"
                                value="{{ old('kegemaran_lain_lain') }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('siswa-profil.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection