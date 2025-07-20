<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pergub extends Model
{
    use HasFactory;

    protected $table = 'pergub';

    protected $fillable = [
        'description',
    ];
}
