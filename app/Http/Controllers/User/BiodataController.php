<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Documents;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{
    /**
     * Show the user's biodata.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $student = $this->getStudentData();
            $father = $student->ayah;
            $mother = $student->ibu;
            $documents = $student->documents;
            $registration = $student->registration;
            $periodName = $registration ? $registration->nama_periode : 'Tidak Diketahui';

            return view('user.biodata.index', compact('student', 'father', 'mother', 'documents', 'registration', 'periodName'));
        } catch (\Exception $e) {
            return redirect()->route('user.dashboard')->with('error', 'Terjadi kesalahan saat memuat biodata.');
        }
    }

    /**
     * Update student biodata.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $student = $this->getStudentData();

        // Validate the input data
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:10',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nisn' => 'required|numeric',
            'alamat_lengkap' => 'required|string',
            'sekolah_asal' => 'required|string|max:255',
            'alamat_sekolah_asal' => 'required|string|max:255',
            'no_telp' => 'required|numeric',
        ]);

        // Update student information
        $student->update($validated);

        return redirect()->route('user.biodata.index')->with('success', 'Biodata berhasil diperbarui.');
    }

    /**
     * Update student parent's data (father & mother).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateParents(Request $request)
    {
        $student = $this->getStudentData();

        // Validate parent's data
        $validated = $request->validate([
            'ayah_nama' => 'nullable|string|max:255',
            'ayah_tempat_lahir' => 'nullable|string|max:255',
            'ayah_tanggal_lahir' => 'nullable|date',
            'ibu_nama' => 'nullable|string|max:255',
            'ibu_tempat_lahir' => 'nullable|string|max:255',
            'ibu_tanggal_lahir' => 'nullable|date',
        ]);

        // Update or create parent's data using validated array
        $father = $student->ayah()->updateOrCreate(
            ['jenis_orangtua' => 'ayah', 'siswa_id' => $student->id],
            [
                'nama' => $validated['ayah_nama'],
                'tempat_lahir' => $validated['ayah_tempat_lahir'],
                'tanggal_lahir' => $validated['ayah_tanggal_lahir']
            ]
        );

        $mother = $student->ibu()->updateOrCreate(
            ['jenis_orangtua' => 'ibu', 'siswa_id' => $student->id],
            [
                'nama' => $validated['ibu_nama'],
                'tempat_lahir' => $validated['ibu_tempat_lahir'],
                'tanggal_lahir' => $validated['ibu_tanggal_lahir']
            ]
        );

        return redirect()->route('user.biodata.index')->with('success', 'Data orang tua berhasil diperbarui.');
    }

    /**
     * Upload documents for the student.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadDocuments(Request $request)
    {
        // Validate uploaded documents
        $validated = $request->validate([
            'akta_kelahiran' => 'nullable|mimes:pdf,jpg,png,jpeg,csv|max:10240',
            'kartu_keluarga' => 'nullable|mimes:pdf,jpg,png,jpeg,csv|max:10240',
            'ijazah_sekolah' => 'nullable|mimes:pdf,jpg,png,jpeg,csv|max:10240',
            'foto_diri' => 'nullable|mimes:pdf,jpg,png,jpeg,csv|max:10240',
        ]);

        $documents = [];

        // Upload and save documents
        foreach (['akta_kelahiran', 'kartu_keluarga', 'ijazah_sekolah', 'foto_diri'] as $docType) {
            if ($request->hasFile($docType)) {
                $file = $request->file($docType);
                $filePath = $file->store('dokumen', 'public');

                Documents::updateOrCreate(
                    ['siswa_id' => auth()->user()->student->id, 'jenis_dokumen' => $docType],
                    ['path_dokumen' => $filePath]
                );
                $documents[$docType] = $filePath;
            }
        }

        return back()->with('success', 'Dokumen berhasil diupload');
    }

    /**
     * Delete a specific document.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteDocument(Request $request)
    {
        $document = Documents::where('jenis_dokumen', $request->docType)->first();

        if ($document && Storage::exists('public/' . $document->path_dokumen)) {
            Storage::delete('public/' . $document->path_dokumen);
            $document->delete();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }

    /**
     * Retrieve the currently authenticated student's data.
     *
     * @return \App\Models\Student
     * @throws \Exception
     */
    private function getStudentData()
    {
        $student = auth()->user()->student;
        if (!$student) {
            throw new \Exception('Biodata siswa tidak ditemukan.');
        }
        return $student;
    }
}
