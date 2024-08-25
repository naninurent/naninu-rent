<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = false;
    protected $fillable = [
        'no_invoice',
            'driver',
            'user',
            'tanggal',
            'uang_makan',
            'penginapan',
            'bbm',
            'tol',
            'parkir',
            'steam',
            'nitrogen',
            'harga_invoice'
    ];
}
