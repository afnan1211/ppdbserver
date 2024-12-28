<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Students;

class Exams extends Model
{
    use HasFactory;

    protected $table = 'tb_ujian';

    protected $fillable = [
        'siswa_id',
        'nilai',
        'keterangan',
    ];

    /**
     * Relation to the Students model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function students()
    {
        return $this->belongsTo(Students::class);
    }
}
