<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Students;
use App\Models\Period;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'tb_pendaftaran';

    protected $fillable = [
        'siswa_id',
        'periode_id',
        'status',
        'tanggal_daftar'
    ];

    public function students()
    {
        return $this->belongsTo(Students::class, 'siswa_id', 'id');
    }

    public function period()
    {
        return $this->belongsTo(Period::class, 'periode_id');
    }
}
