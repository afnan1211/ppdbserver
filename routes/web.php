<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\BiodataController;
use App\Http\Controllers\Admin\PeriodController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Admin\StudentsController;
use App\Http\Controllers\Admin\AnnouncementsController;
use App\Http\Controllers\User\AnnouncementsController as UserAnnouncementsController;
use App\Http\Controllers\User\ExamResultController;
use App\Http\Controllers\Admin\ParentsController;
use App\Http\Controllers\User\PrintStudentDataController;
use App\Http\Controllers\Admin\ExamsController;
use App\Http\Controllers\Admin\DocumentsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\SettingsController;
use App\Http\Controllers\MainController;
use Mews\Captcha\Facades\Captcha;


/*
|--------------------------------------------------------------------------
| Route Utama
|--------------------------------------------------------------------------
*/

Route::get('/', [MainController::class, 'index'])->name('home');

// Route::get('/', [MainController::class, 'index'])->name('periods.index');

Route::get('/get-csrf-token', function () {
    return response()->json(['token' => csrf_token()]);
})->name('get-csrf-token');

/*
|--------------------------------------------------------------------------
| Grup Route Tamu (Guest)
|--------------------------------------------------------------------------
*/
Route::middleware(['web', 'guest'])->group(function () {
    // Login
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    // Registrasi
    Route::get('daftar', [RegistrationController::class, 'index'])->name('registration.index');
    Route::post('daftar/proses', [RegistrationController::class, 'store'])->name('registration.store');
});
/*
|--------------------------------------------------------------------------
| Grup Route Pengguna Terautentikasi
|--------------------------------------------------------------------------
*/
Route::middleware(['web', 'auth'])->group(function () {
    // Logout
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Grup Route Admin
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {
        // Dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // CRUD Periods
        Route::resource('periods', PeriodController::class);

        // CRUD Students
        Route::resource('students', StudentsController::class);
        Route::put('students/{id}/status', [StudentsController::class, 'updateStatus'])->name('students.updateStatus');

        Route::get('/captcha/generate', [CaptchaController::class, 'generate'])->name('captcha.generate');;
        Route::get('/captcha/reset', function () {
            return response()->json(['captcha' => captcha_img()]);
        })->name('captcha.reset');

        // CRUD Announcements
        Route::resource('announcements', AnnouncementsController::class);
        Route::resource('parents', ParentsController::class);
        Route::resource('exams', ExamsController::class);

        // CRUD Documents
        Route::resource('documents', DocumentsController::class);
        Route::put('documents/{id}/verify', [DocumentsController::class, 'verify'])->name('documents.verify');
        Route::get('documents/preview/{studentId}', [DocumentsController::class, 'preview'])->name('documents.preview');

        // CRUD Users
        Route::resource('users', UserController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | Grup Route User
    |--------------------------------------------------------------------------
    */
    Route::prefix('user')->name('user.')->middleware(['role:user'])->group(function () {
        // Dashboard
        Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

        // Biodata
        Route::get('biodata', [BiodataController::class, 'index'])->name('biodata.index');
        Route::post('biodata/update', [BiodataController::class, 'update'])->name('biodata.update');
        Route::post('biodata/update-parents', [BiodataController::class, 'updateParents'])->name('biodata.updateParents');
        Route::post('biodata/upload-documents', [BiodataController::class, 'uploadDocuments'])->name('biodata.uploadDocuments');
        Route::post('biodata/delete-document', [BiodataController::class, 'deleteDocument'])->name('biodata.deleteDocument');

        // Cetak data siswa
        Route::get('documents', [PrintStudentDataController::class, 'index'])->name('documents.index');
        Route::get('documents/print', [PrintStudentDataController::class, 'print'])->name('print');

        // Pengumuman terbaru
        Route::resource('announcements', UserAnnouncementsController::class);

        // Pengumuman hasil ujian
        Route::resource('exam', ExamResultController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | Rute Settings (Akses Admin dan User)
    |--------------------------------------------------------------------------
    */
    Route::resource('settings', SettingsController::class);
});

/*
|--------------------------------------------------------------------------
| Route Fallback
|--------------------------------------------------------------------------
*/
// Route::fallback(function () {
//     return redirect()->route('home')->with('error', 'Halaman tidak ditemukan');
// });
