<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spmt extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'dasar_surat',
        'nomor_surat',
        'tgl_surat',
        'hal_surat',
        'keterangan',
        'tgl_ditetapkan',
        'tempat_ditetapkan',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
