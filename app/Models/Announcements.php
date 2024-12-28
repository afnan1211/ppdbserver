<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Announcements extends Model
{
    use HasFactory;

    protected $table = 'tb_pengumuman';

    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'tanggal_dibuat',
        'status',
    ];

    // Memformat tanggal 'tanggal_dibuat' menjadi format 'd M Y'
    public function getTanggalDibuatAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y');
    }

    // Scope untuk mengambil pengumuman yang aktif
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Scope untuk mengambil 3 pengumuman terbaru yang aktif
    public function scopeLatestAnnouncements($query)
    {
        return $query->active() // Hanya pengumuman aktif
            ->orderBy('tanggal_dibuat', 'desc') // Urutkan berdasarkan tanggal terbaru
            ->take(3); // Ambil 3 pengumuman terbaru
    }
}
