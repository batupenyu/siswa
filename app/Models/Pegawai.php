<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'pangkat',
        'integrasi',
        'no_karpeg'  ,
        'jenis_kelamin',
        'tgl_lahir',
        'tempat_lahir',
        'tgl_tmt_jabatan',
        'tgl_tmt_pangkat',
    ];

    public function stPegawai()
    {
        return $this->belongsToMany(StPegawai::class, 'pegawai_st_pegawai');
    }

    public function akKredits()
    {
        return $this->hasMany(AkKredit::class, 'pegawais_id');
    }
}