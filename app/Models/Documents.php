<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Students;

class Documents extends Model
{
    use HasFactory;

    protected $table = 'tb_dokumen';

    protected $fillable = [
        'jenis_dokumen',
        'path_dokumen',
        'siswa_id'
    ];

    public function student()
    {
        return $this->belongsTo(Students::class);
    }
}
