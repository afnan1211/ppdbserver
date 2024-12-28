<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Registration;
use App\Models\Period;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentsController extends Controller
{
    public function index(Request $request)
    {
        $periods = Period::all();
        $activePeriod = Period::where('status', 1)->first();

        $students = Students::with(['registration', 'ayah', 'ibu'])
            ->filterBySearch($request->search)
            ->filterByPeriod($request->period ?? $activePeriod->id)
            ->paginate(10);

        return view('admin.students.index', compact('students', 'periods', 'activePeriod'));
    }

    public function show($id)
    {
        $student = Students::with(['registration', 'ayah', 'ibu', 'period'])->findOrFail($id);
        return view('admin.students.show', compact('student'));
    }

    public function create()
    {
        $periods = Period::all();
        return view('admin.students.partials.create', compact('periods'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $this->validateRegistrationData($request);

            $registrationNumber = $this->generateUniqueRegistrationNumber();

            $student = $this->createStudent($validatedData, $registrationNumber);
            $user = $this->createUserForStudent($student);

            $student->user_id = $user->id;
            $student->save();

            $this->createRegistrationForStudent($student, $request->periode_id);

            return redirect()->route('admin.students.index')->with([
                'success' => 'Siswa berhasil ditambahkan beserta akun usernya.',
                'email' => $user->email,
                'temporaryPassword' => '12345678',
                'nomorRegistrasi' => $registrationNumber
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withInput()->with(['nisn' => 'NISN sudah terdaftar!'])->with('error', 'Gagal menambahkan siswa.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:ditunda,terdaftar,lulus,tidak_lulus',
        ]);

        $student = Students::findOrFail($id);
        $student->registration->update(['status' => $request->status]);

        return redirect()->route('admin.students.index')->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate($this->validationRules());

            $student = Students::findOrFail($id);
            $student->update($request->all());

            if ($student->registration) {
                $student->registration->update(['periode_id' => $request->periode_id]);
            }
            return redirect()->route('admin.students.index')->with('success', 'Data siswa berhasil diperbarui.');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withInput()->with(['nisn' => 'NISN sudah terdaftar!'])->with('error', 'Gagal menambahkan siswa.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }

    public function destroy(Request $request, $id)
    {
        $student = Students::findOrFail($id);

        // Validasi konfirmasi nama
        $request->validate([
            'confirm_name' => 'required|string',
        ]);

        if (strtolower($request->confirm_name) !== strtolower($student->nama_lengkap)) {
            return redirect()->route('admin.students.index')->with('error', 'Nama siswa tidak sesuai. Penghapusan dibatalkan.');
        }

        $registration = Registration::where('siswa_id', $id)->first();

        $this->deleteStudentData($student, $registration);

        return redirect()->route('admin.students.index')->with('success', 'Data siswa beserta akun user berhasil dihapus.');
    }

    private function validateRegistrationData(Request $request)
    {
        return $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'nisn' => 'required|string|unique:tb_siswa,nisn',
            'alamat_lengkap' => 'required|string',
            'sekolah_asal' => 'required|string',
            'alamat_sekolah_asal' => 'required|string',
            'no_telp' => 'required|string',
        ]);
    }

    private function validationRules()
    {
        return [
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'nisn' => 'nullable|string|max:10',
            'alamat_lengkap' => 'nullable|string',
            'sekolah_asal' => 'nullable|string',
            'alamat_sekolah_asal' => 'nullable|string',
            'no_telp' => 'nullable|string|max:15',
            'periode_id' => 'required|exists:tb_periode,id',
            'ayah_id' => 'nullable|exists:tb_ayah,id',
            'ibu_id' => 'nullable|exists:tb_ibu,id',
        ];
    }

    private function createUserForStudent(Students $student)
    {
        $email = strtolower(str_replace(' ', '.', $student->nama_lengkap)) . '@example.com';
        if (User::where('email', $email)->exists()) {
            $email = strtolower(str_replace(' ', '.', $student->nama_lengkap)) . rand(1, 9999) . '@example.com';
        }

        return User::create([
            'username' => $student->nama_lengkap,
            'email' => $email,
            'password' => Hash::make('12345678'),
        ]);
    }

    private function createStudent(array $validated, string $nomorRegistrasi)
    {
        return Students::create(array_merge($validated, ['nomor_registrasi' => $nomorRegistrasi]));
    }

    private function createRegistrationForStudent(Students $student, $periodeId)
    {
        Registration::create([
            'siswa_id' => $student->id,
            'periode_id' => $periodeId,
            'status' => 'ditunda',
            'tanggal_daftar' => now(),
        ]);
    }

    private function deleteStudentData(Students $student, $registration)
    {
        if ($student->user) {
            $student->user->delete();
        }

        if ($registration) {
            $registration->delete();
        }

        $student->delete();
    }

    private function generateUniqueRegistrationNumber()
    {
        do {
            $registrationNumber = str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);
        } while (Students::where('nomor_registrasi', $registrationNumber)->exists());

        return $registrationNumber;
    }
}
