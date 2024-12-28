<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Period;
use App\Models\Registration;
use App\Models\User;
use App\Models\Parents;
use App\Models\Documents;
use App\Models\Exams;

class Students extends Model
{
    use HasFactory;

    protected $table = 'tb_siswa';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'nisn',
        'alamat_lengkap',
        'sekolah_asal',
        'alamat_sekolah_asal',
        'nomor_registrasi',
        'no_telp',
        'ayah_id',
        'ibu_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ayah()
    {
        return $this->belongsTo(Parents::class, 'ayah_id');
    }

    public function ibu()
    {
        return $this->belongsTo(Parents::class, 'ibu_id');
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function registration()
    {
        return $this->hasOne(Registration::class, 'siswa_id', 'id');
    }

    public function parents()
    {
        return $this->hasMany(Parents::class, 'siswa_id');
    }

    public function documents()
    {
        return $this->hasMany(Documents::class, 'siswa_id');
    }

    public function exams()
    {
        return $this->hasOne(Exams::class, 'siswa_id');
    }

    public function scopeFilterBySearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($query) use ($search) {
                $query->where('nama_lengkap', 'like', '%' . $search . '%')
                    ->orWhere('nisn', 'like', '%' . $search . '%')
                    ->orWhere('nomor_registrasi', 'like', '%' . $search . '%');
            });
        }
        return $query;
    }

    public function scopeFilterByPeriod($query, $periodId)
    {
        return $query->whereHas('registration', function ($query) use ($periodId) {
            $query->where('periode_id', $periodId);
        });
    }
}
