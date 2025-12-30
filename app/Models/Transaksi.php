<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory; 

    protected $casts = [
        'expired_at' => 'datetime',
        'Tanggal_pesan' => 'datetime'
    ];

    protected $fillable = [
        'user_id', 'mobil_id', 'Nama', 'No_telp', 'Alamat', 
        'Lama_sewa', 'Tanggal_pesan', 'Total', 'Status', 
        'expired_at', 'qris_code'
    ];

    protected $attributes = [
        'Status' => 'Menunggu Pembayaran' 
    ];

    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'mobil_id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}