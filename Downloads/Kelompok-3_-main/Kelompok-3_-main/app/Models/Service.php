<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kegiatan',
        'jenis_kegiatan',
        'deskripsi',
        'lokasi',
        'tanggal_mulai',
        'tanggal_selesai',
    ];
}
