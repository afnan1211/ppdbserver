<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Exams;
use App\Models\Period;

class ExamsController extends Controller
{
    const STATUS_TIDAK_LULUS = 'tidak_lulus';
    const STATUS_LULUS = 'lulus';
    const STATUS_TERDAFTAR = 'terdaftar';
    const STATUS_DITUNDA = 'ditunda';

    public function index(Request $request)
    {
        $students = Students::with('registration', 'exams', 'period')
        ->whereHas('registration', function ($query) {
            $query->whereIn('status', [self::STATUS_TERDAFTAR, self::STATUS_LULUS, self::STATUS_TIDAK_LULUS])
                ->whereHas('period', function ($subQuery) {
                    $subQuery->where('status', 1); // Menggunakan nama kolom 'status' di tabel tb_periode
                });
        })
            ->when($request->periode, function ($query) use ($request) {
                return $query->whereHas('registration', function ($subQuery) use ($request) {
                    $subQuery->where('periode_id', $request->periode); // Pastikan menggunakan 'periode_id' di sini
                });
            })
            ->when($request->search, function ($query) use ($request) {
                return $this->searchStudents($query, $request->search);
            })
            ->paginate(10);

        $periods = Period::all();

        return view('admin.exams.index', compact('students', 'periods', 'request'));
    }

    private function searchStudents($query, $search)
    {
        return $query->where('nama_lengkap', 'like', '%' . $search . '%')
            ->orWhere('nisn', 'like', '%' . $search . '%')
            ->orWhere('nomor_registrasi', 'like', '%' . $search . '%');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'siswa_id' => 'required|exists:tb_siswa,id',
            'nilai' => 'required|numeric|min:0|max:100',
            'keterangan' => 'nullable|string',
        ]);

        if (Exams::where('siswa_id', $validated['siswa_id'])->exists()) {
            return redirect()->route('admin.exams.index')
                ->with('error', 'Siswa ini sudah memiliki nilai ujian.');
        }

        try {
            $exam = Exams::create([
                'siswa_id' => $validated['siswa_id'],
                'nilai' => $validated['nilai'],
                'keterangan' => $validated['keterangan'] ?? self::STATUS_LULUS,
            ]);

            $this->updateStudentRegistrationStatus($validated['siswa_id'], $validated['nilai']);

            return redirect()->route('admin.exams.index')->with('success', 'Nilai ujian berhasil disimpan.');
        } catch (\Exception $e) {
            return $this->handleError('Terjadi kesalahan saat menyimpan nilai.');
        }
    }

    private function updateStudentRegistrationStatus($studentId, $nilai)
    {
        $student = Students::findOrFail($studentId);
        $status = $nilai < 50 ? self::STATUS_TIDAK_LULUS : self::STATUS_LULUS;
        $student->registration->update(['status' => $status]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
            'keterangan' => 'nullable|string',
        ]);

        try {
            $exam = Exams::findOrFail($id);

            if (!$exam) {
                return redirect()->route('admin.exams.index')
                    ->with('error', 'Nilai ujian tidak ditemukan.');
            }

            $exam->update([
                'nilai' => $validated['nilai'],
                'keterangan' => $validated['keterangan'] ?? self::STATUS_LULUS,
            ]);

            $this->updateStudentRegistrationStatus($exam->siswa_id, $validated['nilai']);

            return redirect()->route('admin.exams.index')->with('success', 'Nilai ujian berhasil diperbarui.');
        } catch (\Exception $e) {
            return $this->handleError('Terjadi kesalahan saat memperbarui nilai.');
        }
    }

    private function handleError($message)
    {
        return redirect()->route('admin.exams.index')->with('error', $message);
    }
}
