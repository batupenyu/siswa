<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas'; // Specify the table name if it differs from the pluralized model name
    protected $fillable = ['name'];

    // Relationship: A class has many students
    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }
}
