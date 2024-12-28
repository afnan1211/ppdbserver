<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Registration;
use App\Models\Exams;
use App\Models\Announcements;
use App\Models\Period;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Siswa Terdaftar
        $totalStudents = $this->getTotalStudents();

        // Siswa yang Mengikuti Ujian
        $studentsWithExams = $this->getStudentsWithExams();

        // Siswa Terdaftar di Periode Aktif
        $studentsInActivePeriod = $this->getStudentsInActivePeriod();

        // Pengumuman Terbaru
        $latestAnnouncements = $this->getLatestAnnouncements();

        // Statistik Berdasarkan Periode
        $chartData = $this->getChartData();

        // Menyiapkan data untuk view
        return view('admin.dashboard', [
            'totalStudents' => $totalStudents,
            'studentsWithExams' => $studentsWithExams,
            'studentsInActivePeriod' => $studentsInActivePeriod,
            'latestAnnouncements' => $latestAnnouncements,
            'chartData' => $chartData
        ]);
    }

    // Helper Methods
    private function getTotalStudents()
    {
        return Students::count();
    }

    private function getStudentsWithExams()
    {
        return Exams::whereNotNull('nilai')->count();
    }

    private function getLatestAnnouncements()
    {
        // Ambil pengumuman terbaru dengan menambahkan field 'judul', 'tanggal_dibuat', dan 'isi' yang akan ditampilkan di modal
        return Announcements::latest()->limit(5)->get();
    }

    private function getStudentsInActivePeriod()
    {
        $activePeriod = Period::where('status', 1)->first();
        return $activePeriod ? Registration::where('periode_id', $activePeriod->id)->count() : 0;
    }

    private function getChartData()
    {
        // Mengambil data siswa berdasarkan periode
        $periods = Period::select('nama_periode')->pluck('nama_periode')->toArray();
        $studentsCount = Period::withCount('registration')->get()->pluck('registration_count')->toArray();

        return [
            'labels' => $periods,
            'data' => $studentsCount,
        ];
    }
}
