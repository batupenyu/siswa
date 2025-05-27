<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkKredit extends Model
{
    use HasFactory;
    protected $fillable = [
        'pegawais_id',
        'startDate',
        'endDate',
        'predikat'
    ];

    // Define the relationship: AkKredit belongs to Pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawais_id');
    }
}
