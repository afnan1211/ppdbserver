<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Students;

class Parents extends Model
{
    use HasFactory;

    protected $table = 'tb_orangtua';

    protected $fillable = [
        'jenis_orangtua',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'siswa_id',
    ];

    public function student()
    {
        return $this->belongsTo(Students::class, 'siswa_id');
    }
    public function ayah()
    {
        return $this->belongsTo(Students::class, 'ayah_id');  // Untuk ayah
    }

    public function ibu()
    {
        return $this->belongsTo(Students::class, 'ibu_id');  // Untuk ibu
    }

}
