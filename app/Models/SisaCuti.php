<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SisaCuti extends Model
{
    use HasFactory;

    protected $table = 'sisa_cutis';

    protected $fillable = [
        'pegawais_id',
        'sisa_tahun_n',
        'sisa_tahun_n_1',
        'sisa_tahun_n_2',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawais_id');
    }

    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'pegawais_id', 'pegawais_id');
    }
}
