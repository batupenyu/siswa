<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaProfil extends Model
{
    use HasFactory;

    protected $table = 'siswa_profil';

    protected $fillable = [
        'siswa_id',
        'nama_panggilan',
        'jenis_kelamin',
        'tempat_tanggal_lahir',
        'agama',
        'kewarganegaraan',
        'anak_ke_berapa',
        'jumlah_saudara_kandung',
        'jumlah_saudara_tiri',
        'jumlah_saudara_angkat',
        'status_anak',
        'bahasa_sehari_hari_di_rumah',
        'alamat',
        'nomor_telepon',
        'tinggal_dengan',
        'jarak_tempat_tinggal_ke_sekolah',
        'golongan_darah',
        'penyakit_yang_pernah_diderita',
        'kelainan_jasmani',
        'tinggi_dan_berat_badan',
        'pendidikan_sebelumnya',
        'lulusan_dari',
        'tanggal_dan_nomor_sttb',
        'lama_belajar',
        'dari_sekolah',
        'alasan_pindah',
        'diterima_di_sekolah_ini',
        'di_kelas',
        'kelompok',
        'kompetensi_keahlian',
        'tanggal_diterima',
        'kesenian_kegemaran_siswa',
        'olahraga_kegemaran_siswa',
        'kegiatan_kemasyarakatan_kegemaran_siswa',
        'kegemaran_lain_lain',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
