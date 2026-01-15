<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengabdian extends Model
{
    use HasFactory;

    protected $fillable = [
        'ketua_dosen_id',
        'judul',
        'bidang',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'tahun',
        'mahasiswa_id',
    ];

    /* =========================
     | RELATION
     ========================= */

    // ✅ KETUA (DOSEN)
    public function ketuaDosen()
    {
        return $this->belongsTo(Dosen::class, 'ketua_dosen_id');
    }

    // ✅ ANGGOTA DOSEN (PIVOT)
    public function anggotaDosens()
    {
        return $this->belongsToMany(
            Dosen::class,
            'pengabdian_dosen',
            'pengabdian_id',
            'dosen_id'
        );
    }

    // ✅ MAHASISWA DOKUMENTASI
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    /* =========================
     | ACCESSOR (UNTUK TABEL)
     ========================= */

    // Ketua
    public function getKetuaPengabdianAttribute()
    {
        return $this->ketuaDosen?->nama ?? '-';
    }

    // Anggota (gabung nama dosen)
    public function getAnggotaAttribute()
    {
        if ($this->anggotaDosens->isEmpty()) {
            return '-';
        }

        return $this->anggotaDosens
            ->pluck('nama')
            ->implode(', ');
    }

    // Mahasiswa dokumentasi
    public function getMahasiswaDokumentasiAttribute()
    {
        return $this->mahasiswa?->nama ?? '-';
    }
}
