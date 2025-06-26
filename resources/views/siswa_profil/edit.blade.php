@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Siswa Profil</h1>

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
        <form action="{{ route('siswa-profil.update', $siswaProfil->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">

                    <div class="form-group row align-items-center">
                        <label for="nama_lengkap" class="col-sm-4 col-form-label text-end">Nama Lengkap</label>
                        <div class="col-sm-8">
                            <input type="text" name="nama_lengkap" class="form-control"
                                value="{{ old('nama_lengkap', $siswaProfil->nama_lengkap) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="nama_panggilan" class="col-sm-4 col-form-label text-end">Nama Panggilan</label>
                        <div class="col-sm-8">
                            <input type="text" name="nama_panggilan" class="form-control"
                                value="{{ old('nama_panggilan', $siswaProfil->nama_panggilan) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="jenis_kelamin" class="col-sm-4 col-form-label text-end">Jenis Kelamin</label>
                        <div class="col-sm-8">
                            <select name="jenis_kelamin" class="form-control">
                                <option value="">-- Select --</option>
                                <option value="L" {{ old('jenis_kelamin', $siswaProfil->jenis_kelamin)=='L' ? 'selected'
                                    : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin', $siswaProfil->jenis_kelamin)=='P' ? 'selected'
                                    : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="tempat_lahir" class="col-sm-4 col-form-label text-end">Tempat Lahir</label>
                        <div class="col-sm-8">
                            <input type="text" name="tempat_lahir" class="form-control"
                                value="{{ old('tempat_lahir', $siswaProfil->tempat_lahir) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="tanggal_lahir" class="col-sm-4 col-form-label text-end">Tanggal Lahir</label>
                        <div class="col-sm-8">
                            <input type="date" name="tanggal_lahir" class="form-control"
                                value="{{ old('tanggal_lahir', $siswaProfil->tgl_lahir) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="agama" class="col-sm-4 col-form-label text-end">Agama</label>
                        <div class="col-sm-8">
                            <select name="agama" class="form-control">
                                <option value="">-- Select --</option>
                                <option value="islam" {{ old('agama', $siswaProfil->agama)=='islam' ? 'selected' : ''
                                    }}>Islam</option>
                                <option value="budha" {{ old('agama', $siswaProfil->agama)=='budha' ? 'selected' : ''
                                    }}>Budha</option>
                                <option value="hindu" {{ old('agama', $siswaProfil->agama)=='hindu' ? 'selected' : ''
                                    }}>Hindu</option>
                                <option value="kristen" {{ old('agama', $siswaProfil->agama)=='kristen' ? 'selected' :
                                    '' }}>Kristen</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="kewarganegaraan" class="col-sm-4 col-form-label text-end">Kewarganegaraan</label>
                        <div class="col-sm-8">
                            <input type="text" name="kewarganegaraan" class="form-control"
                                value="{{ old('kewarganegaraan', $siswaProfil->kewarganegaraan) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="anak_ke_berapa" class="col-sm-4 col-form-label text-end">Anak Ke Berapa</label>
                        <div class="col-sm-8">
                            <input type="number" name="anak_ke_berapa" class="form-control"
                                value="{{ old('anak_ke_berapa', $siswaProfil->anak_ke_berapa) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="jumlah_saudara_kandung" class="col-sm-4 col-form-label text-end">Jumlah Saudara
                            Kandung</label>
                        <div class="col-sm-8">
                            <input type="number" name="jumlah_saudara_kandung" class="form-control"
                                value="{{ old('jumlah_saudara_kandung', $siswaProfil->jumlah_saudara_kandung) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="jumlah_saudara_tiri" class="col-sm-4 col-form-label text-end">Jumlah Saudara
                            Tiri</label>
                        <div class="col-sm-8">
                            <input type="number" name="jumlah_saudara_tiri" class="form-control"
                                value="{{ old('jumlah_saudara_tiri', $siswaProfil->jumlah_saudara_tiri) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="jumlah_saudara_angkat" class="col-sm-4 col-form-label text-end">Jumlah Saudara
                            Angkat</label>
                        <div class="col-sm-8">
                            <input type="number" name="jumlah_saudara_angkat" class="form-control"
                                value="{{ old('jumlah_saudara_angkat', $siswaProfil->jumlah_saudara_angkat) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="bahasa_sehari_hari_di_rumah" class="col-sm-4 col-form-label text-end">Bahasa
                            Sehari-hari di Rumah</label>
                        <div class="col-sm-8">
                            <input type="text" name="bahasa_sehari_hari_di_rumah" class="form-control"
                                value="{{ old('bahasa_sehari_hari_di_rumah', $siswaProfil->bahasa_sehari_hari_di_rumah) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="alamat" class="col-sm-4 col-form-label text-end">Alamat</label>
                        <div class="col-sm-8">
                            <textarea name="alamat"
                                class="form-control">{{ old('alamat', $siswaProfil->alamat) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="nomor_telepon" class="col-sm-4 col-form-label text-end">Nomor Telepon</label>
                        <div class="col-sm-8">
                            <input type="text" name="nomor_telepon" class="form-control"
                                value="{{ old('nomor_telepon', $siswaProfil->nomor_telepon) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="tinggal_dengan" class="col-sm-4 col-form-label text-end">Tinggal Dengan</label>
                        <div class="col-sm-8">
                            <select name="tinggal_dengan" class="form-control">
                                <option value="">-- Select --</option>
                                <option value="orang tua" {{ old('tinggal_dengan', $siswaProfil->tinggal_dengan)=='orang
                                    tua' ? 'selected' : '' }}>Orang Tua</option>
                                <option value="menumpang" {{ old('tinggal_dengan', $siswaProfil->
                                    tinggal_dengan)=='menumpang' ? 'selected' : '' }}>Menumpang</option>
                                <option value="di asrama" {{ old('tinggal_dengan', $siswaProfil->tinggal_dengan)=='di
                                    asrama' ? 'selected' : '' }}>Di Asrama</option>
                                <option value="kost" {{ old('tinggal_dengan', $siswaProfil->tinggal_dengan)=='kost' ?
                                    'selected' : '' }}>Kost</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="jarak_tempat_tinggal_ke_sekolah" class="col-sm-4 col-form-label text-end">Jarak
                            Tempat Tinggal ke Sekolah (km)</label>
                        <div class="col-sm-8">
                            <input type="number" step="0.01" name="jarak_tempat_tinggal_ke_sekolah" class="form-control"
                                value="{{ old('jarak_tempat_tinggal_ke_sekolah', $siswaProfil->jarak_tempat_tinggal_ke_sekolah) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="alat_transportasi_ke_sekolah" class="col-sm-4 col-form-label text-end">Alat
                            Transportasi ke Sekolah</label>
                        <div class="col-sm-8">
                            <input type="text" name="alat_transportasi_ke_sekolah" class="form-control"
                                value="{{ old('alat_transportasi_ke_sekolah', $siswaProfil->alat_transportasi_ke_sekolah) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="berat_badan" class="col-sm-4 col-form-label text-end">Berat Badan (kg)</label>
                        <div class="col-sm-8">
                            <input type="number" step="0.01" name="berat_badan" class="form-control"
                                value="{{ old('berat_badan', $siswaProfil->berat_badan) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="tinggi_badan" class="col-sm-4 col-form-label text-end">Tinggi Badan (cm)</label>
                        <div class="col-sm-8">
                            <input type="number" step="0.01" name="tinggi_badan" class="form-control"
                                value="{{ old('tinggi_badan', $siswaProfil->tinggi_badan) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="golongan_darah" class="col-sm-4 col-form-label text-end">Golongan Darah</label>
                        <div class="col-sm-8">
                            <input type="text" name="golongan_darah" class="form-control"
                                value="{{ old('golongan_darah', $siswaProfil->golongan_darah) }}">
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="penyakit_yang_pernah_diderita" class="col-sm-4 col-form-label text-end">Penyakit
                                yang Pernah Diderita</label>
                            <div class="col-sm-8">
                                <select name="penyakit_yang_pernah_diderita" class="form-control">
                                    <option value="">-- Select --</option>
                                    <option value="tbc" {{ old('penyakit_yang_pernah_diderita', $siswaProfil->
                                        penyakit_yang_pernah_diderita)=='tbc' ? 'selected' : '' }}>TBC</option>
                                    <option value="cacar" {{ old('penyakit_yang_pernah_diderita', $siswaProfil->
                                        penyakit_yang_pernah_diderita)=='cacar' ? 'selected' : '' }}>Cacar</option>
                                    <option value="malaria" {{ old('penyakit_yang_pernah_diderita', $siswaProfil->
                                        penyakit_yang_pernah_diderita)=='malaria' ? 'selected' : '' }}>Malaria</option>
                                    <option value="dll" {{ old('penyakit_yang_pernah_diderita', $siswaProfil->
                                        penyakit_yang_pernah_diderita)=='dll' ? 'selected' : '' }}>DLL</option>
                                    <option value="-" {{ old('penyakit_yang_pernah_diderita', $siswaProfil->
                                        penyakit_yang_pernah_diderita)=='-' ? 'selected' : '' }}>-</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="asal_SD" class="col-sm-4 col-form-label text-end">Asal SD</label>
                            <div class="col-sm-8">
                                <input type="text" name="asal_SD" class="form-control"
                                    value="{{ old('asal_SD', $siswaProfil->asal_SD) }}">
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="nomor_sttb_SD" class="col-sm-4 col-form-label text-end">Nomor STTB SD</label>
                            <div class="col-sm-8">
                                <input type="text" name="nomor_sttb_SD" class="form-control"
                                    value="{{ old('nomor_sttb_SD', $siswaProfil->nomor_sttb_SD) }}">
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="tanggal_sttb_SD" class="col-sm-4 col-form-label text-end">Tanggal STTB
                                SD</label>
                            <div class="col-sm-8">
                                <input type="date" name="tanggal_sttb_SD" class="form-control"
                                    value="{{ old('tanggal_sttb_SD', $siswaProfil->tanggal_sttb_SD) }}">
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="lama_belajar_SD" class="col-sm-4 col-form-label text-end">Lama Belajar
                                SD</label>
                            <div class="col-sm-8">
                                <input type="text" name="lama_belajar_SD" class="form-control"
                                    value="{{ old('lama_belajar_SD', $siswaProfil->lama_belajar_SD) }}">
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="asal_SMP" class="col-sm-4 col-form-label text-end">Asal SMP</label>
                            <div class="col-sm-8">
                                <input type="text" name="asal_SMP" class="form-control"
                                    value="{{ old('asal_SMP', $siswaProfil->asal_SMP) }}">
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="nomor_sttb_SMP" class="col-sm-4 col-form-label text-end">Nomor STTB SMP</label>
                            <div class="col-sm-8">
                                <input type="text" name="nomor_sttb_SMP" class="form-control"
                                    value="{{ old('nomor_sttb_SMP', $siswaProfil->nomor_sttb_SMP) }}">
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="tanggal_sttb_SMP" class="col-sm-4 col-form-label text-end">Tanggal STTB
                                SMP</label>
                            <div class="col-sm-8">
                                <input type="date" name="tanggal_sttb_SMP" class="form-control"
                                    value="{{ old('tanggal_sttb_SMP', $siswaProfil->tanggal_sttb_SMP) }}">
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="lama_belajar_SMP" class="col-sm-4 col-form-label text-end">Lama Belajar
                                SMP</label>
                            <div class="col-sm-8">
                                <input type="text" name="lama_belajar_SMP" class="form-control"
                                    value="{{ old('lama_belajar_SMP', $siswaProfil->lama_belajar_SMP) }}">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-6">

                    <div class="form-group row align-items-center">
                        <label for="nama_ayah" class="col-sm-4 col-form-label text-end">Nama Ayah</label>
                        <div class="col-sm-8">
                            <input type="text" name="nama_ayah" class="form-control"
                                value="{{ old('nama_ayah', $siswaProfil->nama_ayah) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="tempat_lahir_ayah" class="col-sm-4 col-form-label text-end">Tempat Tanggal Lahir
                            Ayah</label>
                        <div class="col-sm-8">
                            <input type="text" name="tempat_lahir_ayah" class="form-control"
                                value="{{ old('tempat_lahir_ayah', $siswaProfil->tempat_lahir_ayah) }}">
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label for="tanggal_lahir_ayah" class="col-sm-4 col-form-label text-end">Tanggal Lahir
                            Ayah</label>
                        <div class="col-sm-8">
                            <input type="date" name="tanggal_lahir_ayah" class="form-control"
                                value="{{ old('tanggal_lahir_ayah', $siswaProfil->tanggal_lahir_ayah) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="alamat_ayah" class="col-sm-4 col-form-label text-end">Alamat Ayah</label>
                        <div class="col-sm-8">
                            <textarea name="alamat_ayah"
                                class="form-control">{{ old('alamat_ayah', $siswaProfil->alamat_ayah) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="nomor_telepon_ayah" class="col-sm-4 col-form-label text-end">Nomor Telepon
                            Ayah</label>
                        <div class="col-sm-8">
                            <input type="text" name="nomor_telepon_ayah" class="form-control"
                                value="{{ old('nomor_telepon_ayah', $siswaProfil->nomor_telepon_ayah) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="pekerjaan_ayah" class="col-sm-4 col-form-label text-end">Pekerjaan Ayah</label>
                        <div class="col-sm-8">
                            <input type="text" name="pekerjaan_ayah" class="form-control"
                                value="{{ old('pekerjaan_ayah', $siswaProfil->pekerjaan_ayah) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="penghasilan_perbulan_ayah" class="col-sm-4 col-form-label text-end">Penghasilan
                            Perbulan Ayah</label>
                        <div class="col-sm-8">
                            <input type="text" name="penghasilan_perbulan_ayah" class="form-control"
                                value="{{ old('penghasilan_perbulan_ayah', $siswaProfil->penghasilan_perbulan_ayah) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="pendidikan_ayah" class="col-sm-4 col-form-label text-end">Pendidikan
                            Ayah</label>
                        <div class="col-sm-8">
                            <input type="text" name="pendidikan_ayah" class="form-control"
                                value="{{ old('pendidikan_ayah', $siswaProfil->pendidikan_ayah) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="kewarganegaraan_ayah" class="col-sm-4 col-form-label text-end">Kewarganegaraan
                            Ayah</label>
                        <div class="col-sm-8">
                            <input type="text" name="kewarganegaraan_ayah" class="form-control"
                                value="{{ old('kewarganegaraan_ayah', $siswaProfil->kewarganegaraan_ayah) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="nama_ibu" class="col-sm-4 col-form-label text-end">Nama Ibu</label>
                        <div class="col-sm-8">
                            <input type="text" name="nama_ibu" class="form-control"
                                value="{{ old('nama_ibu', $siswaProfil->nama_ibu) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="tempat_lahir_ibu" class="col-sm-4 col-form-label text-end">Tempat Tanggal Lahir
                            Ibu</label>
                        <div class="col-sm-8">
                            <input type="text" name="tempat_lahir_ibu" class="form-control"
                                value="{{ old('tempat_lahir_ibu', $siswaProfil->tempat_lahir_ibu) }}">
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label for="tanggal_lahir_ibu" class="col-sm-4 col-form-label text-end">Tanggal Lahir
                            Ibu</label>
                        <div class="col-sm-8">
                            <input type="date" name="tanggal_lahir_ibu" class="form-control"
                                value="{{ old('tanggal_lahir_ibu', $siswaProfil->tanggal_lahir_ibu) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="alamat_ibu" class="col-sm-4 col-form-label text-end">Alamat Ibu</label>
                        <div class="col-sm-8">
                            <textarea name="alamat_ibu"
                                class="form-control">{{ old('alamat_ibu', $siswaProfil->alamat_ibu) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="nomor_telepon_ibu" class="col-sm-4 col-form-label text-end">Nomor Telepon
                            Ibu</label>
                        <div class="col-sm-8">
                            <input type="text" name="nomor_telepon_ibu" class="form-control"
                                value="{{ old('nomor_telepon_ibu', $siswaProfil->nomor_telepon_ibu) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="pekerjaan_ibu" class="col-sm-4 col-form-label text-end">Pekerjaan Ibu</label>
                        <div class="col-sm-8">
                            <input type="text" name="pekerjaan_ibu" class="form-control"
                                value="{{ old('pekerjaan_ibu', $siswaProfil->pekerjaan_ibu) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="penghasilan_perbulan_ibu" class="col-sm-4 col-form-label text-end">Penghasilan
                            Perbulan Ibu</label>
                        <div class="col-sm-8">
                            <input type="text" name="penghasilan_perbulan_ibu" class="form-control"
                                value="{{ old('penghasilan_perbulan_ibu', $siswaProfil->penghasilan_perbulan_ibu) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="pendidikan_ibu" class="col-sm-4 col-form-label text-end">Pendidikan Ibu</label>
                        <div class="col-sm-8">
                            <input type="text" name="pendidikan_ibu" class="form-control"
                                value="{{ old('pendidikan_ibu', $siswaProfil->pendidikan_ibu) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="kewarganegaraan_ibu" class="col-sm-4 col-form-label text-end">Kewarganegaraan
                            Ibu</label>
                        <div class="col-sm-8">
                            <input type="text" name="kewarganegaraan_ibu" class="form-control"
                                value="{{ old('kewarganegaraan_ibu', $siswaProfil->kewarganegaraan_ibu) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="nama_wali" class="col-sm-4 col-form-label text-end">Nama Wali</label>
                        <div class="col-sm-8">
                            <input type="text" name="nama_wali" class="form-control"
                                value="{{ old('nama_wali', $siswaProfil->nama_wali) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="alamat_wali" class="col-sm-4 col-form-label text-end">Alamat Wali</label>
                        <div class="col-sm-8">
                            <textarea name="alamat_wali"
                                class="form-control">{{ old('alamat_wali', $siswaProfil->alamat_wali) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="nomor_telepon_wali" class="col-sm-4 col-form-label text-end">Nomor Telepon
                            Wali</label>
                        <div class="col-sm-8">
                            <input type="text" name="nomor_telepon_wali" class="form-control"
                                value="{{ old('nomor_telepon_wali', $siswaProfil->nomor_telepon_wali) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="kegemaran_olah_raga" class="col-sm-4 col-form-label text-end">Kegemaran Olah
                            Raga</label>
                        <div class="col-sm-8">
                            <input type="text" name="kegemaran_olah_raga" class="form-control"
                                value="{{ old('kegemaran_olah_raga', $siswaProfil->kegemaran_olah_raga) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="kegemaran_kemasyarakatan" class="col-sm-4 col-form-label text-end">Kegemaran
                            Kemasyarakatan</label>
                        <div class="col-sm-8">
                            <input type="text" name="kegemaran_kemasyarakatan" class="form-control"
                                value="{{ old('kegemaran_kemasyarakatan', $siswaProfil->kegemaran_kemasyarakatan) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="kegemaran_hasta_karya" class="col-sm-4 col-form-label text-end">Kegemaran Hasta
                            Karya</label>
                        <div class="col-sm-8">
                            <input type="text" name="kegemaran_hasta_karya" class="form-control"
                                value="{{ old('kegemaran_hasta_karya', $siswaProfil->kegemaran_hasta_karya) }}">
                        </div>
                    </div>

                    <div class="form-group row align-items-center">
                        <label for="jurusan" class="col-sm-4 col-form-label text-end">Jurusan</label>
                        <div class="col-sm-8">
                            <select name="jurusan" class="form-control">
                                <option value="">-- Select Jurusan --</option>
                                <option value="TBSM" {{ old('jurusan', $siswaProfil->jurusan)=='TBSM' ? 'selected' :
                                    ''
                                    }}>TBSM</option>
                                <option value="TKR" {{ old('jurusan', $siswaProfil->jurusan)=='TKR' ? 'selected' :
                                    ''
                                    }}>TKR</option>
                                <option value="TITL" {{ old('jurusan', $siswaProfil->jurusan)=='TITL' ? 'selected' :
                                    ''
                                    }}>TITL</option>
                                <option value="TP" {{ old('jurusan', $siswaProfil->jurusan)=='TP' ? 'selected' : ''
                                    }}>TP</option>
                                <option value="TKJ" {{ old('jurusan', $siswaProfil->jurusan)=='TKJ' ? 'selected' :
                                    ''
                                    }}>TKJ</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('siswa-profil.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection