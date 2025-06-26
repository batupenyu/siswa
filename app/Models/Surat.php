<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $table = 'surat';
    protected $fillable = [
        'dasar_surat',
        'nama_kegiatan',
        'tgl_kegiatan',
        'tgl_akhir_kegiatan',
        'tempat_kegiatan',
        'jam_kegiatan',
        'ditetapkan_di',
        'tgl_ditetapkan',
        'nama_kegiatan',
    ];

    // protected $casts = [
    //     'photos' => 'array',
    // ];

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function gambarSurat()
    {
        return $this->hasMany(GambarSurat::class);
    }
}
