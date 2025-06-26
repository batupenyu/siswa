<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaProfil extends Model
{
    use HasFactory;

    protected $table = 'siswa_profil';

    protected $fillable = [
        'nama_lengkap',
        'nama_panggilan',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'kewarganegaraan',
        'anak_ke_berapa',
        'jumlah_saudara_kandung',
        'jumlah_saudara_tiri',
        'jumlah_saudara_angkat',
        'bahasa_sehari_hari_di_rumah',
        'alamat',
        'nomor_telepon',
        'tinggal_dengan',
        'jarak_tempat_tinggal_ke_sekolah',
        'alat_transportasi_ke_sekolah',
        'berat_badan',
        'tinggi_badan',
        'golongan_darah',
        'penyakit_yang_pernah_diderita',
        'asal_SD',
        'nomor_sttb_SD',
        'tanggal_sttb_SD',
        'lama_belajar_SD',
        'asal_SMP',
        'nomor_sttb_SMP',
        'tanggal_sttb_SMP',
        'lama_belajar_SMP',
        'nama_ayah',
        'tempat_lahir_ayah',
        'tanggal_lahir_ayah',
        'alamat_ayah',
        'nomor_telepon_ayah',
        'pekerjaan_ayah',
        'penghasilan_perbulan_ayah',
        'pendidikan_ayah',
        'kewarganegaraan_ayah',
        'nama_ibu',
        'tempat_lahir_ibu',
        'tanggal_lahir_ibu',
        'alamat_ibu',
        'nomor_telepon_ibu',
        'pekerjaan_ibu',
        'penghasilan_perbulan_ibu',
        'pendidikan_ibu',
        'kewarganegaraan_ibu',
        'nama_wali',
        'alamat_wali',
        'nomor_telepon_wali',
        'kegemaran_olah_raga',
        'kegemaran_kemasyarakatan',
        'kegemaran_hasta_karya',
        'jurusan',

    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
