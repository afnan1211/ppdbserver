<?php

namespace App\Http\Controllers\Admin;

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Period;
use Exception;
use Illuminate\Support\Facades\DB;

class PeriodController extends Controller
{
    public function index()
    {
        $periods = Period::orderBy('tanggal_mulai', 'desc')->get();
        return view('admin.periods.index', compact('periods'));
    }

    public function create()
    {
        return view('admin.periods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_periode' => 'required|string|max:255',
            'status' => 'required|boolean',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        try {
            // Validasi agar hanya ada satu periode aktif
            if ($request->status == true && Period::where('status', true)->exists()) {
                return redirect()->back()->withErrors(['error' => 'Hanya satu periode yang boleh aktif pada satu waktu.'])->withInput();
            }

            Period::create($request->all());
            return redirect()->route('admin.periods.index')->with('success', 'Periode berhasil ditambahkan.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {
        $period = Period::findOrFail($id);
        return view('admin.periods.edit', compact('period'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_periode' => 'required|string|max:255',
            'status' => 'required|boolean',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        try {
            // Validasi agar hanya ada satu periode aktif
            if ($request->status == true && Period::where('status', true)->where('id', '!=', $id)->exists()) {
                return redirect()->back()->withErrors(['error' => 'Hanya satu periode yang boleh aktif pada satu waktu.'])->withInput();
            }

            $period = Period::findOrFail($id);
            $period->update([
                'nama_periode' => $request->nama_periode,
                'status' => $request->status,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
            ]);
            return redirect()->route('admin.periods.index')->with('success', 'Data periode berhasil diperbarui.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $period = Period::findOrFail($id);

            // Pastikan jika periode yang akan dihapus adalah periode aktif, maka pastikan ada periode lain yang aktif
            if ($period->status == true && Period::where('status', true)->count() <= 1) {
                return redirect()->route('admin.periods.index')->withErrors(['error' => 'Tidak bisa menghapus periode aktif terakhir. Pastikan ada periode lain yang aktif.']);
            }

            $period->delete();
            return redirect()->route('admin.periods.index')->with('success', 'Periode berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->route('admin.periods.index')->withErrors(['error' => $e->getMessage()]);
        }
    }
}
