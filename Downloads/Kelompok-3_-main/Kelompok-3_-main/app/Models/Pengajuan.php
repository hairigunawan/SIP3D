<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'nip_nim',
        'jurusan',
        'fakultas',
        'jenis_kegiatan',
        'judul_kegiatan',
        'deskripsi_kegiatan',
    ];
}
