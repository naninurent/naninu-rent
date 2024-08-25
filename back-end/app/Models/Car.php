<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'merk',
        'type',
        'tahun',
        'jml_penumpang',
        'transmisi',
        'bbm',
        'harga',
        'image',
        'isActive'
    ];
}
