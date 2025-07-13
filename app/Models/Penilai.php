<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilai extends Model
{
    use HasFactory;

    protected $table = 'penilai';

    protected $fillable = [
        'nama',
        'jabatan',
        'nip',
        'pangkat',
        'unitkerja',
        'instansi',
    ];
}
