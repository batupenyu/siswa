<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawais_id',
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'tgl_perkawinan',
        'pekerjaan',
        'status_pernikahan',
        'status_tunjangan',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawais_id');
    }
}
