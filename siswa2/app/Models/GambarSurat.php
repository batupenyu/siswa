<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarSurat extends Model
{
    use HasFactory;
    protected $table = 'gambar_surat';
    protected $fillable = ['surat_id', 'gambar'];

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }
}
