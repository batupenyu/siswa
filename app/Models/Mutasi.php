<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory;

    protected $table = 'mutasi';

    protected $fillable = [
        'siswas_id',
        'alasan_pindah',
        'created_at',
        'updated_at',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswas_id');
    }
}
