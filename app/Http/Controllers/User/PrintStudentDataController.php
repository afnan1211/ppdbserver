<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use \PDF;

class PrintStudentDataController extends Controller
{
    /**
     * Menampilkan halaman pilihan cetak data siswa atau kartu ujian.
     */
    public function index()
    {
        $student = auth()->user()->student;
        $father = $student->ayah;
        $mother = $student->ibu;

        return view('user.documents.index', compact('student', 'father', 'mother'));
    }

    /**
     * Cetak data siswa atau kartu ujian sesuai dengan pilihan pengguna.
     */
    public function print(Request $request)
    {
        // Mendapatkan data siswa berdasarkan user yang sedang login
        $student = auth()->user()->student;

        if (!$student) {
            return redirect()->route('user.documents.index')->with('error', 'Biodata siswa tidak ditemukan.');
        }

        // Ambil data orang tua (ayah dan ibu) dari data siswa
        $father = $student->ayah;
        $mother = $student->ibu;

        // Ambil pilihan cetakan dari request
        $printOption = $request->input('printOption');

        // Pilihan untuk mencetak data siswa
        if ($printOption == 'data_siswa') {
            // Generate PDF untuk data siswa
            $pdf = PDF::loadView('user.documents.data_siswa', compact('student', 'father', 'mother'));

            // Menyediakan nama file PDF untuk data siswa
            return $pdf->download('data_siswa_' . $student->nama_lengkap . '.pdf');
        }

        // Pilihan untuk mencetak kartu ujian
        if ($printOption == 'kartu_ujian') {
            // Generate PDF untuk kartu ujian
            $pdf = PDF::loadView('user.documents.kartu_ujian', compact('student'));

            // Menyediakan nama file PDF untuk kartu ujian
            return $pdf->download('kartu_ujian_' . $student->nama_lengkap . '.pdf');
        }

        // Jika pilihan cetakan tidak valid
        return redirect()->route('user.documents.index')->with('error', 'Pilihan cetakan tidak valid.');
    }
}
