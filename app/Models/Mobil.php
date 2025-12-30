<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mobil extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='mobils';
    protected $ID='id';
    protected $fillable=['id', 'user_id', 'Plat_nomor', 'Merk', 'Jenis', 'Kapasitas', 'Harga', 'Foto', 'Status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}