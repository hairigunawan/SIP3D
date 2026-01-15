<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    // ⛔ Jangan pakai 'prestasis'
    // ✅ Tabel asli di database
    protected $table = 'achievements';

    protected $fillable = [
        'code',
        'nama',
        'skor_sinta',
        'skor_sinta_3yr',
        'jumlah_buku',
        'jumlah_hibah',
        'publikasi_scholar',
    ];
}
