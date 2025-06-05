<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configurasi extends Model
{
    use HasFactory;

    protected $table = 'configurasi';

    protected $fillable = [
        'code',
        'value',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public static function valueOf($code, $newValue = NULL)
    {
        $cfg = Configurasi::where('code', $code)->first();
        if (!$cfg) {
            return null;
        }
        if (isset($newValue)) {
            $cfg->value = $newValue;
            $cfg->save();
        }
        return $cfg->value;
    }
}
