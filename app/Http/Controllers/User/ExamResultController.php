<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exams;
use App\Models\Registration;

class ExamResultController extends Controller
{
    /**
     * Display the exam result for the authenticated student.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $studentId = auth()->user()->student->id;

        // Fetch the student's registration status
        $registration = Registration::where('siswa_id', $studentId)
            ->whereIn('status', ['lulus', 'tidak_lulus', 'terdaftar', 'ditunda'])
            ->first();

        // Fetch the student's exam result if the registration status is valid for results
        $exam = null;
        if ($registration && in_array($registration->status, ['lulus', 'tidak_lulus'])) {
            $exam = Exams::where('siswa_id', $studentId)->first();
        }

        return view('user.exam.index', compact('exam', 'registration'));
    }
}
