<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bp extends Model
{
    use HasFactory;

    protected $table = 'bp';

    protected $fillable = [
        'nama',
        'jabatan',
        'nip',
        'pangkat',
        'unitkerja',
        'instansi',
    ];
}
