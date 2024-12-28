<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Period;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    public function index()
    {
        // Ambil periode pertama yang aktif
        $period = Period::where('status', 1)->first();

        if (!$period) {
            // Jika tidak ada periode aktif, kirim pesan error
            return view('main.index', ['error' => 'Periode Tidak Ditemukan']);
        }

        return view('main.index', compact('period'));
    }
}
