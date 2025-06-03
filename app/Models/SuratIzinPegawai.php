<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratIzinPegawai extends Model
{
    use HasFactory;

    protected $table = 'surat_izin_pegawai';

    protected $fillable = [
        'pegawais_id',
        'tanggal',
        'jam',
        'keperluan',
        'keterangan',
        'status',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawais_id');
    }
}
