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
<<<<<<< HEAD
        'penilai_id',
        'kpa_id',
=======
>>>>>>> 0da78d7 (commit)
        'jenis_cuti',
        'status_penilai',
        'status_kpa',
        'alasan',
        'lama_cuti',
        'tanggal_mulai',
        'tanggal_selesai',
        'telepon',
        'alamat_selama_cuti',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawais_id');
    }

<<<<<<< HEAD
=======
    public function sisaCuti()
    {
        return $this->belongsTo(SisaCuti::class, 'pegawais_id', 'pegawais_id');
    }

>>>>>>> 0da78d7 (commit)
    public function penilai()
    {
        return $this->belongsTo(Penilai::class, 'penilai_id');
    }
<<<<<<< HEAD

    public function kpa()
    {
        return $this->belongsTo(Kpa::class, 'kpa_id');
    }
=======
>>>>>>> 0da78d7 (commit)
}
