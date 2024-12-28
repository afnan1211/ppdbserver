<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parents;
use Illuminate\Http\Request;
use App\Models\Students;
use Illuminate\Support\Facades\Log;

class ParentsController extends Controller
{
    /**
     * Menampilkan daftar orang tua dengan pencarian dan paginasi.
     */
    public function index(Request $request)
    {
        $parents = $this->getFilteredParents($request)->paginate(10);
        $students = Students::all();

        return view('admin.parents.index', compact('parents', 'students'));
    }

    /**
     * Menampilkan detail orang tua beserta siswa terkait.
     */
    public function show($id)
    {
        $parent = $this->findParent($id);
        // Eager load ayah and ibu relationships
        $parent->load(['ayah', 'ibu']);

        return view('admin.parents.partials.show-modal', compact('parent'));
    }

    /**
     * Menampilkan form untuk membuat orang tua baru.
     */
    public function create()
    {
        $studentsWithoutParents = $this->getStudentsWithoutParents();

        return view('admin.parents.partials.create-modal', compact('studentsWithoutParents'));
    }

    /**
     * Menyimpan data orang tua baru.
     */
    public function store(Request $request)
    {
        $validated = $this->validateParentRequest($request);

        // Pastikan ID siswa diterima dengan benar
        if (!$validated['siswa_id']) {
            return redirect()->back()->with('error', 'ID siswa tidak ditemukan.')->withInput();
        }

        // Temukan siswa berdasarkan ID
        $student = Students::find($validated['siswa_id']);

        // Pastikan siswa ditemukan
        if (!$student) {
            return redirect()->back()->with('error', 'Siswa tidak ditemukan.')->withInput();
        }

        // Pastikan tidak ada orang tua dengan jenis yang sama
        $this->ensureValidParentAssignment($student, $validated['jenis_orangtua']);

        // Jika validasi lulus, simpan orang tua baru
        $parent = Parents::create([
            'nama' => $validated['nama'],
            'jenis_orangtua' => $validated['jenis_orangtua'],
            'siswa_id' => $validated['siswa_id'],
            'tanggal_lahir' => $validated['tanggal_lahir'] ?? null,
            'tempat_lahir' => $validated['tempat_lahir'] ?? null,
        ]);

        // Menghubungkan orang tua dengan siswa
        $this->assignParentToStudent($student, $parent, $validated['jenis_orangtua']);

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('admin.parents.index')->with('success', 'Orang tua berhasil ditambahkan.');
    }

    /**
     * Memeriksa apakah siswa sudah memiliki orang tua dengan jenis yang sesuai.
     */
    private function hasExistingParent(Students $student, string $jenisOrangtua): bool
    {
        // Periksa apakah siswa sudah memiliki ayah
        if ($jenisOrangtua == 'ayah' && $student->ayah_id) {
            // Siswa sudah memiliki ayah
            return true;
        }

        // Periksa apakah siswa sudah memiliki ibu
        if ($jenisOrangtua == 'ibu' && $student->ibu_id) {
            // Siswa sudah memiliki ibu
            return true;
        }

        // Jika belum ada orang tua dengan jenis yang sama
        return false;
    }

    /**
     * Validasi apakah orang tua dapat ditambahkan ke siswa.
     */
    private function ensureValidParentAssignment(Students $student, string $jenisOrangtua)
    {
        if ($this->hasExistingParent($student, $jenisOrangtua)) {
            // Redirect dengan pesan error jika sudah ada orang tua dengan jenis yang sama
            return redirect()->back()->withErrors([
                'jenis_orangtua' => "Siswa ini sudah memiliki {$jenisOrangtua} yang terdaftar."
            ])->withInput();
        }
    }

    /**
     * Menyimpan orang tua yang sesuai dengan siswa.
     */
    private function assignParentToStudent(Students $student, Parents $parent, string $jenisOrangtua)
    {
        if ($jenisOrangtua == 'ayah') {
            $student->ayah_id = $parent->id;
        } else {
            $student->ibu_id = $parent->id;
        }

        $student->save();
    }

    /**
     * Menampilkan form edit untuk orang tua.
     */
    public function edit($id)
    {
        $parent = Parents::with(['ayah', 'ibu'])->find($id); // Eager load ayah and ibu relationships
        return view('admin.parents.partials.edit-modal', compact('parent'));
    }

    /**
     * Memperbarui data orang tua.
     */
    public function update(Request $request, $id)
    {
        $this->validateUpdateRequest($request);

        $parent = Parents::findOrFail($id);
        $parent->update([
            'nama' => $request->nama,
            'jenis_orangtua' => $request->jenis_orangtua,
            'tanggal_lahir' => $request->tanggal_lahir ?? $parent->tanggal_lahir,
            'tempat_lahir' => $request->tempat_lahir ?? $parent->tempat_lahir,
        ]);

        return redirect()->route('admin.parents.index')->with('success', 'Data orang tua berhasil diperbarui.');
    }

    /**
     * Menghapus orang tua berdasarkan ID.
     */
    /**
     * Menghapus orang tua berdasarkan ID.
     */
    public function destroy($id)
    {
        try {
            $parent = $this->findParent($id);

            // Cek apakah orang tua ini sudah dihubungkan ke siswa
            $students = Students::where('ayah_id', $parent->id)
                ->orWhere('ibu_id', $parent->id)
                ->get();

            foreach ($students as $student) {
                // Jika orang tua yang dihapus adalah ayah
                if ($parent->jenis_orangtua == 'ayah' && $student->ayah_id == $parent->id) {
                    $student->ayah_id = null; // Hapus referensi ayah pada siswa
                }

                // Jika orang tua yang dihapus adalah ibu
                if ($parent->jenis_orangtua == 'ibu' && $student->ibu_id == $parent->id) {
                    $student->ibu_id = null; // Hapus referensi ibu pada siswa
                }

                // Simpan perubahan pada siswa
                $student->save();
            }

            // Setelah menghapus referensi orang tua pada siswa, hapus orang tua dari database
            $parent->delete();

            return redirect()->route('admin.parents.index')->with('success', 'Data orang tua berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.parents.index')->with('error', 'Terjadi kesalahan saat menghapus data orang tua.');
        }
    }

    /**
     * Mendapatkan query orang tua dengan filter pencarian.
     */
    private function getFilteredParents(Request $request)
    {
        $query = Parents::query();

        if ($request->has('search')) {
            $query->where('nama', 'like', "%" . $request->search . "%");
        }

        return $query;
    }

    /**
     * Menemukan orang tua berdasarkan ID atau gagal dengan exception.
     */
    private function findParent($id)
    {
        return Parents::findOrFail($id);
    }

    /**
     * Mendapatkan daftar siswa yang belum memiliki orang tua.
     */
    private function getStudentsWithoutParents()
    {
        return Students::doesntHave('parents')->get();
    }

    /**
     * Validasi data saat menambah atau mengedit orang tua.
     */
    private function validateParentRequest(Request $request)
    {
        return $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_orangtua' => 'required|string|max:255',
            'siswa_id' => 'required|exists:tb_siswa,id',
            'tanggal_lahir' => 'nullable|date',
            'tempat_lahir' => 'nullable|string|max:255',
        ]);
    }

    /**
     * Validasi data saat update orang tua.
     */
    private function validateUpdateRequest(Request $request)
    {
        return $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_orangtua' => 'required|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'tempat_lahir' => 'nullable|string|max:255',
        ]);
    }
}
