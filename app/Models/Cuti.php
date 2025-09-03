<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'cuti';

    protected $fillable = [
        'pegawais_id',
        'penilai_id',
        'kpa_id',
        'jenis_cuti',
        'status_penilai',
        'status_kpa',
        'alasan',
        'lama_cuti',
        'tanggal_mulai',
        'tanggal_selesai',
        'telepon',
        'alamat_selama_cuti',
        'sisa_cuti_n',
        'sisa_cuti_n_1',
        'sisa_cuti_n_2',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawais_id');
    }

    public function penilai()
    {
        return $this->belongsTo(Penilai::class, 'penilai_id');
    }

    public function kpa()
    {
        return $this->belongsTo(Kpa::class, 'kpa_id');
    }
}
