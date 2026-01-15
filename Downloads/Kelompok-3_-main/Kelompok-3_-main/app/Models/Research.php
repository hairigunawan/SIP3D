<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;

    // Nama tabel (opsional, kalau nama tabel sama dengan jamak model, tidak perlu)
    protected $table = 'research';

    // Field yang bisa diisi mass-assignment
    protected $fillable = [
        'judul',
        'bidang',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    // Jika kamu mau tanggal otomatis di-cast ke Carbon (opsional)
    protected $dates = [
        'tanggal_mulai',
        'tanggal_selesai',
    ];
}
