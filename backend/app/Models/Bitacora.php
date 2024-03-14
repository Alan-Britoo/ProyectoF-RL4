<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'description',
        'date',
        'hour'
    ];

    public static function add($description)
    {
        $bitacora = Bitacora::create([
            'description' => $description,
            'date' => date('Y-m-d'),
            'hour' => date("H:i:s")
        ]);
        return $bitacora;
    }
}
