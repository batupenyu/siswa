<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StPegawai extends Model
{
    protected $table = 'st_pegawai';
    protected $fillable = [
        'dasar_surat',
        'tgl_awal',
        'tgl_akhir',
        'nama_kegiatan',
        'tgl_kegiatan',
        'jam_kegiatan',
        'tempat_kegiatan',
        'tgl_ditetapkan',
        'tempat_ditetapkan',
        'biaya_transportasi',
        'biaya_penginapan',
        'biaya_tiket',
        'transport_lokal',
        'uang_makan',
        'uang_saku',
        'uang_representasi',
        'uang_kediklatan',
        'korek',
    ];

    public function pegawais()
    {
        return $this->belongsToMany(Pegawai::class, 'pegawai_st_pegawai');
    }

    public function rincian()
    {
        return $this->hasOne(Rincian::class);
    }
}
