<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpa extends Model
{
    use HasFactory;

    protected $table = 'kpa';

    protected $fillable = [
        'nama',
        'jabatan',
        'nip',
        'pangkat',
        'unitkerja',
        'instansi',
    ];
}
