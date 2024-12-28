<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Students;
use App\Models\User;
use App\Models\Parents;
use App\Models\Period;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    private function generateUniqueRegistrationNumber()
    {
        do {
            $registrationNumber = str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);
        } while (Students::where('nomor_registrasi', $registrationNumber)->exists());

        return $registrationNumber;
    }

    public function store(Request $request)
    {
        $user = null;
        $student = null;
        $uniqueErrorId = Str::random(8);  // Unique ID for tracking error
        try {
            // Check CSRF token
            if (!$request->has('_token') || !Session::token() === $request->_token) {
                throw new \Exception('CSRF token is missing or invalid.');
            }

            Log::info('Session ID:', ['session_id' => session()->getId()]);
            Log::info('CSRF Token Valid:', ['token' => $request->_token, 'session_token' => session('_token')]);

            if ($request->_token !== session('_token')) {
                Log::error('CSRF Token Mismatch');
            }

            $validated = $this->validateRegistrationData($request);

            // Check if student already exists based on NISN or name and date of birth
            $existingStudent = Students::where('nisn', $validated['nisn'])
                ->orWhere(function ($query) use ($validated) {
                    $query->where('nama_lengkap', $validated['nama_lengkap'])
                        ->where('tanggal_lahir', $validated['tanggal_lahir']);
                })
                ->first();

            if ($existingStudent) {
                // Return with an error if the student already exists
                return redirect()->back()->withErrors(['error' => 'Siswa dengan data yang sama sudah terdaftar.'])->withInput();
            }

            // Buat akun user dengan email berdasarkan nama lengkap
            $userData = $this->createUser($validated);
            $user = $userData['user'];
            $temporaryPassword = $userData['temporaryPassword'];

            // Buat nomor registrasi unik
            $nomorRegistrasi = $this->generateUniqueRegistrationNumber();

            // Mendapatkan periode pendaftaran yang aktif
            $currentPeriod = $this->getActivePeriod();

            // Simpan data siswa
            $student = $this->createStudent($validated, $user, $nomorRegistrasi);

            // Simpan data orang tua setelah siswa dibuat
            $father = $this->createParent('ayah', $validated, $student->id);
            $mother = $this->createParent('ibu', $validated, $student->id);

            // Update data siswa dengan relasi ke orangtua
            $student->ayah_id = $father->id;
            $student->ibu_id = $mother->id;
            $student->save();

            // Simpan data pendaftaran
            $registration = $this->createRegistration($student, $currentPeriod);
            if (!$registration) {
                throw new \Exception('Data pendaftaran gagal disimpan.');
            }

            // Login user
            Auth::login($user);

            return redirect()->route('user.dashboard')->with([
                'success' => 'Pendaftaran berhasil!',
                'email' => $user->email,
                'temporaryPassword' => $temporaryPassword,
                'nomorRegistrasi' => $nomorRegistrasi,
            ]);
        } catch (ValidationException $e) {
            Log::error('Validation error during registration', [
                'errorId' => $uniqueErrorId,
                'validationErrors' => $e->errors(),
                'input' => $request->all(),
            ]);
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error during registration', [
                'errorId' => $uniqueErrorId,
                'message' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
                'input' => $request->all(),
                'user' => $user ? $user->id : null, // Log user ID if user was created
                'student' => $student ? $student->id : null, // Log student ID if student was created
            ]);

            // Hapus user jika sudah dibuat tetapi data lain gagal
            if ($user) {
                $user->delete();
            }

            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan. Mohon coba lagi.'])->withInput();
        }
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
            'nama_ayah' => 'required|string|max:255',
            'tempat_lahir_ayah' => 'required|string|max:255',
            'tanggal_lahir_ayah' => 'required|date',
            'nama_ibu' => 'required|string|max:255',
            'tempat_lahir_ibu' => 'required|string|max:255',
            'tanggal_lahir_ibu' => 'required|date',
        ]);
    }

    private function createUser(array $validated)
    {
        $email = strtolower(str_replace(' ', '.', $validated['nama_lengkap'])) . '@gmail.com';

        if (User::where('email', $email)->exists()) {
            throw new \Exception('Email sudah terdaftar. Silakan gunakan email lain.');
        }

        $temporaryPassword = Str::random(10);

        $user = User::create([
            'username' => $validated['nama_lengkap'],
            'email' => $email,
            'password' => Hash::make($temporaryPassword),
        ]);

        return ['user' => $user, 'temporaryPassword' => $temporaryPassword];
    }

    private function getActivePeriod()
    {
        $currentPeriod = Period::where('status', 1)->first();

        if (!$currentPeriod) {
            throw new \Exception('Tidak ada periode pendaftaran yang aktif.');
        }

        return $currentPeriod;
    }

    private function createParent(string $parentType, array $validated, int $studentId)
    {
        return Parents::create([
            'jenis_orangtua' => $parentType,
            'nama' => $validated["nama_{$parentType}"],
            'tempat_lahir' => $validated["tempat_lahir_{$parentType}"],
            'tanggal_lahir' => $validated["tanggal_lahir_{$parentType}"],
            'siswa_id' => $studentId, // Use the correct student ID here
        ]);
    }

    private function createStudent(array $validated, User $user, string $nomorRegistrasi)
    {
        return Students::create([
            'user_id' => $user->id,
            'nama_lengkap' => $validated['nama_lengkap'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'nisn' => $validated['nisn'],
            'alamat_lengkap' => $validated['alamat_lengkap'],
            'sekolah_asal' => $validated['sekolah_asal'],
            'alamat_sekolah_asal' => $validated['alamat_sekolah_asal'],
            'no_telp' => $validated['no_telp'],
            'nomor_registrasi' => $nomorRegistrasi,
        ]);
    }

    private function createRegistration(Students $student, Period $currentPeriod)
    {
        return Registration::create([
            'siswa_id' => $student->id,
            'periode_id' => $currentPeriod->id,
            'status' => 'ditunda',
            'tanggal_daftar' => now(),
        ]);
    }
}
