<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'ktp',
        'nama',
        'telp',
        'email',
        'alamat',
        'img_ktp',
        'img_sim',
        'img_kk'
    ];
}
