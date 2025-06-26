<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderIconImage extends Model
{
    use HasFactory;

    protected $table = 'header_icon_images';

    protected $fillable = [
        'filename',
        'path',
    ];
}
