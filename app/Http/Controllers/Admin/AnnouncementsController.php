<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcements;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AnnouncementsController extends Controller
{
    // Menampilkan daftar pengumuman dengan filter bulan dan tahun
    public function index(Request $request)
    {
        $announcements = $this->filterAnnouncements($request);

        // Kirim data pengumuman ke view
        return view('admin.announcements.index', [
            'announcements' => $announcements,
            'isEmpty' => $announcements->isEmpty(),
        ]);
    }

    // Menampilkan form untuk membuat pengumuman
    public function create()
    {
        return view('admin.announcements.partials.create-modal');
    }

    // Menyimpan pengumuman baru
    public function store(Request $request)
    {
        $validated = $this->validateAnnouncement($request);

        try {
            Announcements::create($validated);

            return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.']);
        }
    }

    // Menampilkan form untuk mengedit pengumuman
    public function edit($id)
    {
        $announcement = Announcements::findOrFail($id);
        return view('admin.announcements.partials.edit-modal', compact('announcement'));
    }

    // Memperbarui pengumuman
    public function update(Request $request, $id)
    {
        $announcement = Announcements::findOrFail($id);

        $validated = $this->validateAnnouncement($request, $id);

        try {
            $announcement->update($validated);

            return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data.']);
        }
    }

    // Menghapus pengumuman
    public function destroy($id)
    {
        $announcement = Announcements::findOrFail($id);
        $announcement->delete();

        return redirect()->route('admin.announcements.index')->with('success', 'Pengumuman berhasil dihapus.');
    }

    // Filter pengumuman berdasarkan bulan dan tahun
    private function filterAnnouncements(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $query = Announcements::query();

        if ($month && $year) {
            $query->whereMonth('tanggal_dibuat', $month)
                ->whereYear('tanggal_dibuat', $year);
        }

        return $query->latest('created_at')->paginate(10);
    }

    // Validasi pengumuman
    private function validateAnnouncement(Request $request, $id = null)
    {
        return $request->validate([
            'judul' => 'required|string|max:255|unique:tb_pengumuman,judul,' . $id,
            'isi' => 'required|string',
            'status' => 'required|boolean',
        ]) + [
            'slug' => Str::slug($request->judul),
            'tanggal_dibuat' => Carbon::now()->format('Y-m-d'),
        ];
    }
}
