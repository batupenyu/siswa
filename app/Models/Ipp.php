<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ipp extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'bulan',
        'nominal',
        'tgl_ditetapkan',
        'tempat_ditetapkan',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
