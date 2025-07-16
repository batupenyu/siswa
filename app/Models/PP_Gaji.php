<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PP_Gaji extends Model
{
    use HasFactory;

    protected $table = 'pp_gajis';

    protected $fillable = [
        'description',
    ];
}
