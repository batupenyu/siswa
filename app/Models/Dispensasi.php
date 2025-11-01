<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispensasi extends Model
{
    use HasFactory;
    protected $table = 'dispensasi';
    protected $fillable = [
        'nama_kegiatan',
        'tgl_kegiatan',
        'waktu_kegiatan',
        'tgl_ditetapkan',
        'description',
    ];

    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'siswa_dispensasi', 'dispensasi_id', 'siswa_id');
    }
}
