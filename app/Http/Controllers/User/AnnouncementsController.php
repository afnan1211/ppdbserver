<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcements;

class AnnouncementsController extends Controller
{
    public function index(Request $request)
    {
        $query = Announcements::where('status', 1); // Only fetch active announcements

        // Filter by search term
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('isi', 'like', "%{$search}%");
            });
        }

        $announcements = $query->latest()->paginate(10);

        return view('user.announcements.index', compact('announcements'));
    }

    public function show($id)
    {
        $announcement = Announcements::findOrFail($id);
        return view('user.announcements.show-modal', compact('announcement'));
    }
}
