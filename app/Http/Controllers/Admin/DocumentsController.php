<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Students;
use App\Models\Documents;
use App\Models\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentsController extends Controller
{
    // Menampilkan halaman verifikasi dokumen dengan fitur pencarian dan filter
    public function index(Request $request)
    {
        $activePeriodId = Period::where('status', 1)->value('id');
        $periodId = $request->filled('period_id') ? $request->period_id : $activePeriodId;

        $students = Students::with(['registration', 'documents', 'registration.period'])
            ->whereHas('registration', function ($q) {
                $q->where('status', 'ditunda');
            })
            ->when($request->filled('search'), function ($q) use ($request) {
                return $this->applySearchFilter($q, $request);
            })
            ->when($periodId, function ($q) use ($periodId) {
                return $this->applyPeriodFilter($q, $periodId);
            })
            ->paginate(10);

        $periods = Period::all();

        return view('admin.documents.index', compact('students', 'periodId', 'periods'));
    }

    // Verifikasi dokumen siswa dan ubah status registrasi menjadi 'terdaftar' jika dokumen lengkap
    public function verify(Request $request, $studentId)
    {
        $student = Students::with('documents', 'registration')->findOrFail($studentId);
        $requiredDocuments = ['akta_kelahiran', 'kartu_keluarga', 'ijazah_sekolah', 'foto_diri'];
        $uploadedDocuments = $student->documents->pluck('jenis_dokumen')->toArray();

        // Cek dokumen yang hilang
        $missingDocuments = array_diff($requiredDocuments, $uploadedDocuments);

        if (count($missingDocuments) === 0) {
            // Jika tidak ada dokumen yang hilang, perbarui status menjadi terdaftar
            $student->registration->update(['status' => 'terdaftar']);
            return redirect()->route('admin.documents.index')->with('success', 'Dokumen siswa berhasil diverifikasi dan status diperbarui.');
        }

        // Jika ada dokumen yang hilang, tampilkan error dan dokumen yang hilang
        return redirect()->back()->with(['error' => 'Dokumen siswa tidak lengkap. Dokumen yang hilang: ' . implode(', ', $missingDocuments)]);
    }


    // Pratinjau dokumen siswa
    public function preview($studentId)
    {
        // Mengambil data student dengan dokumen yang diperlukan
        $student = Students::with('documents')->findOrFail($studentId);

        // Data dokumen yang ingin ditampilkan
        $documents = [];
        foreach ($student->documents as $document) {
            $documents[$document->jenis_dokumen] = asset('storage/' . $document->path_dokumen);
        }

        // Menyimpan data dokumen untuk digunakan di modal
        return view('admin.documents.partials.document_preview_modal', compact('documents'));
    }

    // Cek kelengkapan dokumen
    private function documentsComplete(array $required, array $uploaded)
    {
        return count(array_intersect($required, $uploaded)) === count($required);
    }

    // Terapkan filter pencarian pada query
    private function applySearchFilter($query, $request)
    {
        return $query->where('nisn', 'like', "%{$request->search}%")
            ->orWhere('nama_lengkap', 'like', "%{$request->search}%")
            ->orWhere('nomor_registrasi', 'like', "%{$request->search}%");
    }

    // Terapkan filter periode pada query
    private function applyPeriodFilter($query, $periodId)
    {
        return $query->whereHas('registration.period', function ($q) use ($periodId) {
            $q->where('id', $periodId);
        });
    }
}
