<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Students;
use App\Models\Registration;

class Period extends Model
{
    use HasFactory;

    protected $table = 'tb_periode';

    protected $fillable = ['nama_periode', 'status', 'tanggal_mulai', 'tanggal_selesai'];

    public function students()
    {
        return $this->hasMany(Students::class);
    }

    public function registration()
    {
        return $this->hasMany(Registration::class, 'periode_id');
    }
}
