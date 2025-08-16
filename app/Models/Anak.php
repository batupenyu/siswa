<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;

    protected $table = 'anak_table';

    protected $fillable = [
        'pegawais_id',
        'nama',
        'tgl_lahir',
        'tempat_lahir',
        'status_pekerjaan',
        'status_pernikahan',
        'pendidikan',
        'nama_sekolah',
        'status_tanggungan',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawais_id');
    }
}
