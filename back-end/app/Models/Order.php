<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = false;
    protected $fillable = [
        'car_id',
        'customer_id',
        'invoice',
        'alamat',
        'catatan',
        'layanan',
        'tujuan',
        'mulai_sewa',
        'selesai_sewa',
        'lama_sewa',
        'total_harga',
        'status',
        'snap_token'
    ];
}
