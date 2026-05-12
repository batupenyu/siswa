<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPanggilan extends Model
{
    use HasFactory;

    protected $table = 'surat_panggilan';

    protected $fillable = [
        'tanggal_surat',
        'nomor_surat',
        'sifat',
        'lampiran',
        'perihal',
        'nama_siswa',
        'hari_tanggal',
        'tempat',
        'agenda',
        'paragraf_penutup',
        'nama_guru_bk',
        'pangkat_golongan',
        'nip',
        'an_guru_bk',
        'kop_id',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
        'hari_tanggal'  => 'date',
        'an_guru_bk'    => 'boolean',
    ];
}
