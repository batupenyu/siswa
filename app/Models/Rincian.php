<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rincian extends Model
{
    use HasFactory;
    protected $fillable = [
        'biaya_transportasi',
        'biaya_penginapan',
        'biaya_tiket',
        'transport_lokal',
        'uang_makan',
        'uang_saku',
        'uang_representasi',
        'uang_kediklatan',
        'korek',
    ];

    public function stpegawai()
    {
        return $this->belongsTo(StPegawai::class);
    }
}
