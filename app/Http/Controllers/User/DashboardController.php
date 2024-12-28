<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcements;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard siswa dengan pengumuman terbaru.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Ambil data popup untuk pendaftaran berhasil
        $popupData = $this->getPopupData($request);

        // Ambil 3 pengumuman terbaru yang aktif
        $announcements = Announcements::latestAnnouncements()->get();

        return view('user.dashboard', compact('popupData', 'announcements'));
    }

    /**
     * Mendapatkan data untuk popup pendaftaran berhasil.
     *
     * @param  Request  $request
     * @return array
     */
    private function getPopupData(Request $request)
    {
        return [
            'email' => $request->session()->get('email'),
            'temporaryPassword' => $request->session()->get('temporaryPassword'),
            'nomorRegistrasi' => $request->session()->get('nomorRegistrasi'),
        ];
    }
}
