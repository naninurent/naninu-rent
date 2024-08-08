<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
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
