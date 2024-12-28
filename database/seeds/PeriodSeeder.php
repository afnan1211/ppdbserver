<?php

namespace Database\Seeders;

use App\Models\Period;
use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
{
    public function run()
    {
        Period::create([
            'nama_periode' => 'Tahun Pelajaran 2024/2025',
            'status' => 1,
            'tanggal_mulai' => '2024-06-01',
            'tanggal_selesai' => '2025-05-31',
        ]);
    }
}
