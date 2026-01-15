<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    use HasFactory;

    protected $table = 'penelitians';

    protected $fillable = [
        'ketua_dosen_id',
        'ketua_manual',
        'judul',
        'bidang',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'tahun',
        'mahasiswa_id',
    ];

    // Ketua penelitian
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'ketua_dosen_id');
    }

    // 🔥 ANGGOTA DOSEN (PIVOT)
    public function anggotaDosens()
    {
        return $this->belongsToMany(
            Dosen::class,
            'penelitian_dosen',
            'penelitian_id',
            'dosen_id'
        );
    }

    // Mahasiswa dokumentasi
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
