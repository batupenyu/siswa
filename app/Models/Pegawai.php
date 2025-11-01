<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'pangkat',
        'status_kepegawaian',
        'integrasi',
        'no_karpeg',
        'jenis_kelamin',
        'tgl_lahir',
        'tempat_lahir',
        'tgl_tmt_jabatan',
        'tgl_tmt_pangkat',
        'agama',
        'alamat',
        'tgl_tmt_cpns',
    ];

    public function stPegawai()
    {
        return $this->belongsToMany(StPegawai::class, 'pegawai_st_pegawai');
    }

    public function akKredits()
    {
        return $this->hasMany(AkKredit::class, 'pegawais_id');
    }

    public function anak()
    {
        return $this->hasMany(Anak::class, 'pegawais_id');
    }

    public function pasangan()
    {
        return $this->hasOne(Pasangan::class, 'pegawais_id');
    }

    public function ppGaji()
    {
        return $this->belongsTo(PP_Gaji::class, 'digaji_menurut');
    }

    public function spmts()
    {
        return $this->hasMany(Spmt::class);
    }

<<<<<<< HEAD
=======
    public function sisaCuti()
    {
        return $this->hasOne(SisaCuti::class, 'pegawais_id');
    }

>>>>>>> 0da78d7 (commit)
    public function getMasaKerjaAttribute()
    {
        if (!$this->tgl_tmt_cpns) {
            return '-';
        }
        $start = Carbon::parse($this->tgl_tmt_cpns);
        $now = Carbon::now();

        $years = $start->diffInYears($now);
        $months = $start->copy()->addYears($years)->diffInMonths($now);

        $result = '';
        if ($years > 0) {
            $result .= $years . ' tahun ';
        }
        if ($months > 0) {
            $result .= $months . ' bulan';
        }
        return trim($result);
    }
}
