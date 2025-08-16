<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoSurat extends Model
{
    use HasFactory;

    protected $table = 'photo_surat';

    protected $fillable = [
        'st_surat_id',
        'photo',
    ];

    public function stSurat()
    {
        return $this->belongsTo(StPegawai::class, 'st_surat_id');
    }
}
