<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'nis', 'npsn', 'kelas_id'];

    // Relationship: A student belongs to a class
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    // public function surat()
    // {
    //     return $this->hasMany(Surat::class, 'siswas_id');
    // }

    public function surat()
    {
        return $this->belongsToMany(Surat::class);
    }

    public function dispensasi()
    {
        return $this->belongsToMany(Dispensasi::class);
    }

    public function sukets()
    {
        return $this->hasMany(Suket::class, 'siswas_id');
    }

    public function ipps()
    {
        return $this->hasMany(Ipp::class, 'siswa_id');
    }
}
