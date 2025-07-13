<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['surat_id', 'path'];

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }
}
