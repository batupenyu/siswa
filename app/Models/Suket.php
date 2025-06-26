<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suket extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswas_id',
        'description',
        'tgl_ditetapkan',
        'tempat_ditetapkan',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswas_id');
    }
}
