<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MbkmController;
use App\Http\Controllers\HasilKonversiController;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DosbingController;
use App\Http\Controllers\KpsController;
use App\Http\Controllers\PembimbingIndustriController;
use App\Http\Controllers\PembimbingAkademikController;
use App\Http\Controllers\WadirController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginSSOController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });



Route::get('/', [HomeController::class, 'index']);

Route::get('/about', [AboutController::class, 'index']);


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/login/forgot-password', [LoginController::class, 'forgotPassword']);
Route::post('/login/forgot-password', [LoginController::class, 'submitForgotPasswordForm']);
Route::get('/reset-password/{token}', [LoginController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('/reset-password', [LoginController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/auth/pnj', [LoginSSOController::class, 'redirectToSSOPNJ']);
Route::get('/dashboard/', [LoginSSOController::class, 'callback']);
Route::get('/dashboard/index', [DashboardController::class, 'welcome'])->middleware('auth');
Route::get('/dashboard/first-create/{sso}', [LoginSSOController::class, 'firstLogin']);
Route::post('/dashboard/first-create/{id}', [LoginSSOController::class, 'storeFirstLogin']);

// Forum Route
Route::resource('/dashboard/forum', ForumController::class)->middleware('auth');
Route::get('/dashboard/forum/detail/{id}', [ForumController::class, 'detailPost'])->middleware('auth');
Route::get('/dashboard/mypost', [ForumController::class, 'myPost'])->middleware('auth');
Route::post('/dashboard/mypost/{id}', [ForumController::class, 'deleted'])->middleware('auth');
Route::post('/dashboard/mypost/delete/file/{id}', [ForumController::class, 'deleteFile'])->middleware('auth');
Route::post('/dashboard/mypost/update/{forum}', [ForumController::class, 'updatePost'])->middleware('auth');
Route::get('/dashobard/file/download/{fileId}', [ForumController::class, 'downloadFile'])->middleware('auth');
Route::post('/dashboard/forum/detail/comment', [ForumController::class, 'postComment'])->middleware('auth');

// Mbkm Route
Route::get('/dashboard/informasi-mbkm', [DashboardController::class, 'pendaftaranMBKM'])->middleware('auth');
Route::get('/dashboard/informasi-mbkm/personal', [MbkmController::class, 'myForm'])->middleware('auth');
Route::get('/dashboard/informasi-mbkm/{id}', [MbkmController::class, 'editMyForm'])->middleware('auth');
Route::post('/dashboard/informasi-mbkm/create', [MbkmController::class, 'store'])->middleware('auth');
Route::post('/dashboard/informasi-mbkm/{id}/edit', [MbkmController::class, 'updateMyForm'])->middleware('auth');

// Upload Kurikulum Route
Route::get('/dashboard/upload-kurikulum', [DashboardController::class, 'uploadKurikulum'])->middleware('auth');
Route::post('/dashboard/upload-kurikulum', [KurikulumController::class, 'store'])->middleware('auth');

// Hasil Konversi Route
Route::get('/dashboard/hasil-konversi', [DashboardController::class, 'hasilKonversi'])->middleware('auth');
Route::get('/dashboard/hasil-konversi/{id}', [HasilKonversiController::class, 'index'])->middleware('auth');

// Logbook Route
Route::get('/dashboard/logbook/{id}/detail', [LogbookController::class, 'detail'])->middleware('auth');
Route::get('/dashboard/logbook/create/{id}', [LogbookController::class, 'create'])->middleware('auth');
Route::get('/dashboard/logbook/{id}', [LogbookController::class, 'myLogbook'])->middleware('auth');
Route::get('/dashboard/logbook', [LogbookController::class, 'index'])->middleware('auth');
Route::get('/dashboard/logbook/{id}/edit', [LogbookController::class, 'edit'])->middleware('auth');
Route::post('/dashboard/logbook/create', [LogbookController::class, 'store'])->middleware('auth');
Route::post('/dashboard/logbook/{id}/update', [LogbookController::class, 'update'])->middleware('auth');
Route::post('/dashboard/logbook/{id}/delete', [LogbookController::class, 'destroy'])->middleware('auth');

// Laporan Route
Route::post('/dashboard/laporan/save-document', [LaporanController::class, 'savePdf'])->middleware('auth');

Route::get('/dashboard/laporan/download', [LaporanController::class, 'saveAndRedirect'])->middleware('auth');
Route::get('/dashboard/laporan', [DashboardController::class, 'laporan'])->middleware('auth');
Route::get('/dashboard/laporan/{id}', [LaporanController::class, 'index'])->middleware('auth');
Route::get('/dashboard/laporan/preview/{id}', [LaporanController::class, 'previewPdf'])->middleware('auth');
Route::post('/dashboard/laporan/{id}', [LaporanController::class, 'update'])->middleware('auth');
Route::get('/dashboard/laporan/view-pdf/{id}', [LaporanController::class, 'viewPdf'])->middleware('auth');
Route::post('/api/fetch-dokumen', [LaporanController::class, 'fetchDokumen']);
Route::post('/dashboard/laporan/revisi/{id}', [LaporanController::class, 'revisi'])->middleware('auth');
// Route::post('/api/save-document', [LaporanController::class, 'savePdf'])->middleware('auth');

// Register Route
Route::get('/dashboard/register', [RegisterController::class, 'index'])->middleware('auth');
Route::get('/dashboard/register/kelola-akun', [RegisterController::class, 'kelolaAkun'])->middleware('auth');
Route::post('/dashboard/register', [RegisterController::class, 'store'])->middleware('auth');

//Fakultas Route
Route::get('/dashboard/fakultas', [FakultasController::class , 'index'])->middleware('auth');
Route::get('/dashboard/fakultas/create', [FakultasController::class, 'create'])->middleware('auth');
Route::get('/dashboard/fakultas/{id}', [FakultasController::class, 'edit'])->middleware('auth');
Route::post('/dashboard/fakultas', [FakultasController::class, 'store'])->middleware('auth');
Route::post('/dashboard/fakultas/{id}/delete', [FakultasController::class, 'destroy'])->middleware('auth');
Route::post('/dashboard/fakultas/{id}/edit', [FakultasController::class, 'update'])->middleware('auth');

// Jurusan Route
Route::get('/dashboard/jurusan', [JurusanController::class, 'index'])->middleware('auth');
Route::get('/dashboard/jurusan/create', [JurusanController::class, 'create'])->middleware('auth');
Route::get('/dashboard/jurusan/{id}', [JurusanController::class, 'edit'])->middleware('auth');
Route::post('/dashboard/jurusan', [JurusanController::class, 'store'])->middleware('auth');
Route::post('/dashboard/jurusan/{id}/delete', [JurusanController::class, 'destroy'])->middleware('auth');
Route::post('/dashboard/jurusan/{id}/edit', [JurusanController::class, 'update'])->middleware('auth');

// Role Route
Route::get('/dashboard/role', [RoleController::class, 'index'])->middleware('auth');
Route::get('/dashboard/role/create', [RoleController::class, 'create'])->middleware('auth');
Route::post('/dashboard/role', [RoleController::class, 'store'])->middleware('auth');
Route::get('/dashboard/role/{id}', [RoleController::class, 'edit'])->middleware('auth');
Route::post('/dashboard/role/{id}/edit', [RoleController::class, 'update'])->middleware('auth');

// ProgramMBKM Route
Route::get('/dashboard/program-mbkm', [MbkmController::class, 'programIndex'])->middleware('auth');
Route::get('/dashboard/program-mbkm/create', [MbkmController::class, 'create'])->middleware('auth');
Route::get('/dashboard/program-mbkm/{id}', [MbkmController::class, 'edit'])->middleware('auth');
Route::post('/dashboard/program-mbkm', [MbkmController::class, 'storeProgram'])->middleware('auth');
Route::post('/dashboard/program-mbkm/{id}/edit', [MbkmController::class, 'update'])->middleware('auth');

// Route Dosen Pembimbing
Route::get('/dashboard/dosbing/', [DosbingController::class, 'dashboard'])->middleware('auth');
Route::get('/dashboard/dosbing/detail/{id}', [DosbingController::class, 'detailMahasiswa'])->middleware('auth');
Route::get('/logbook/dosbing/', [DosbingController::class, 'logbook'])->middleware('auth');
Route::get('/logbook/dosbing/list-logbook/{id}', [DosbingController::class, 'listLogbookMahasiswa'])->middleware('auth');
Route::get('/logbook/dosbing/detail/{id}', [DosbingController::class, 'detailLogbook'])->middleware('auth');
Route::get('/logbook/dosbing/detail/logbook-mahasiswa/{id}', [DosbingController::class, 'logLogbook'])->middleware('auth');
Route::post('/logbook/dosbing/detail/finish/{id}', [DosbingController::class, 'logbookFinish'])->middleware('auth');
Route::get('/laporan/dosbing', [DosbingController::class, 'laporan'])->middleware('auth');
Route::get('/laporan/dosbing/{id}', [DosbingController::class, 'listLaporan'])->middleware('auth');
Route::get('/laporan/dosbing/detail/{id}', [DosbingController::class, 'detailLaporan'])->middleware('auth');
Route::get('/laporan/dosbing/view-pdf/{id}', [DosbingController::class, 'viewPdf'])->middleware('auth');
Route::post('/laporan/dosbing/view-pdf/approve/{file}', [DosbingController::class, 'approveFile'])->middleware('auth');
Route::post('/laporan/dosbing/view-pdf/canceled/{file}', [DosbingController::class, 'canceled'])->middleware('auth');
Route::get('/laporan/dosbing/sign-pdf/{id}', [DosbingController::class, 'signPdf'])->middleware('auth');
Route::post('/laporan/dosbing/sign-pdf/save', [DosbingController::class, 'savePdf'])->middleware('auth');
// End Route Dosen Pembimbing

// Route KPS
Route::get('/konversi/kps/hasil-konversi', [KpsController::class, 'hasilKonversi'])->middleware('auth');
Route::get('/konversi/kps/hasil-konversi/{id}', [KpsController::class, 'detailHasilKonversi'])->middleware('auth');
// Route::get('/konversi/kps/hasil-konversi/detail/{id}', [KpsController::class, 'detailHasilKonversi'])->middleware('auth');
Route::get('/dashboard/kps', [KpsController::class, 'dashboard'])->middleware('auth');
Route::get('/dashboard/kps/detail/{id}', [KpsController::class, 'detailMahasiswa'])->middleware('auth');
Route::get('/logbook/kps', [KpsController::class, 'logbook'])->middleware('auth');
Route::get('/logbook/kps/list/{id}', [KpsController::class, 'listLogbook'])->middleware('auth');
Route::get('/logbook/kps/list/detail/{id}', [KpsController::class, 'logLogbook'])->middleware('auth');
Route::post('/logbook/kps/list/detail/finish/{id}', [KpsController::class, 'logbookFinish'])->middleware('auth');
Route::get('/laporan/kps', [KpsController::class, 'laporan'])->middleware('auth');
Route::get('/laporan/kps/{id}', [KpsController::class, 'listLaporan'])->middleware('auth');
Route::get('/laporan/kps/detail/{id}', [KpsController::class, 'detailLaporan'])->middleware('auth');
Route::get('/laporan/kps/detail/sign-pdf/{id}', [KpsController::class, 'signPdf'])->middleware('auth');
Route::post('/laporan/kps/detail/save-pdf', [KpsController::class, 'savePdf'])->middleware('auth');
Route::get('/konversi/kps', [KpsController::class, 'konversi'])->middleware('auth');
Route::get('/konversi/kps/viewpdf/{id}', [KpsController::class, 'viewPdf'])->middleware('auth');
Route::get('/konversi/kps/{id}', [KpsController::class, 'detailKonversi'])->middleware('auth');
Route::post('/konversi/kps/correct/{id}', [KpsController::class, 'correct'])->middleware('auth');
Route::post('/konversi/kps/incorrect/{id}', [KpsController::class, 'incorrect'])->middleware('auth');
Route::post('/konversi/kps/confirm/{id}', [KpsController::class, 'konfirmasi'])->middleware('auth');
// Route::post('/konversi/kps/api/fetch-dokumen', [LaporanController::class, 'fetchDokumen']);
Route::post('/konversi/kps/api/fetch-dokumen', [KpsController::class, 'fetchDokumen']);


// End Route KPS

// Route Pembimbing Industri
Route::get('/dashboard/pi', [PembimbingIndustriController::class, 'dashboard'])->middleware('auth');
Route::get('/dashboard/pi/detail-mahasiswa/{id}', [PembimbingIndustriController::class, 'detailMahasiswa'])->middleware('auth');
Route::get('/logbook/pi', [PembimbingIndustriController::class, 'logbook'])->middleware('auth');
Route::get('/logbook/pi/detail/{id}', [PembimbingIndustriController::class, 'detailLogbook'])->middleware('auth');
Route::get('/logbook/pi/detail/logbook-mahasiswa/{id}', [PembimbingIndustriController::class, 'logLogbook'])->middleware('auth');
Route::post('/logbook/pi/detail/finish/{id}', [PembimbingIndustriController::class, 'logbookFinish'])->middleware('auth');
Route::get('/laporan/pi', [PembimbingIndustriController::class, 'laporan'])->middleware('auth');
Route::get('/laporan/pi/{id}', [PembimbingIndustriController::class, 'listLaporan'])->middleware('auth');
Route::get('/laporan/pi/detail/{id}', [PembimbingIndustriController::class, 'detailLaporan'])->middleware('auth');
Route::get('/laporan/pi/detail/sign-pdf/{id}', [PembimbingIndustriController::class, 'signPdf'])->middleware('auth');
Route::post('/laporan/pi/detail/sign-pdf/save', [PembimbingIndustriController::class, 'savePdf'])->middleware('auth');
// End Route Pembimbing Industri

// Route Pembimbing Akademik
Route::get('/dashboard/pa', [PembimbingAkademikController::class, 'dashboard'])->middleware('auth');
Route::get('/dashboard/pa/{id}', [PembimbingAkademikController::class, 'detailMahasiswa'])->middleware('auth');
Route::get('/dashboard/pa/logbook/{id}', [PembimbingAkademikController::class, 'logbookMahasiswa'])->middleware('auth');
Route::get('/dashboard/pa/logbook/detail/{id}', [PembimbingAkademikController::class, 'detailLogbook'])->middleware('auth');
Route::get('/dashboard/pa/laporan/view-pdf/{id}', [PembimbingAkademikController::class, 'viewPdf'])->middleware('auth');
// End Route Pembimbing Akademik

// Route Wadir
Route::get('/dashboard/wadir', [WadirController::class, 'dashboard'])->middleware('auth');
Route::get('/dashboard/wadir/{id}', [WadirController::class, 'detailMahasiswa'])->middleware('auth');
Route::get('/dashboard/wadir/logbook/{id}', [WadirController::class, 'logbookMahasiswa'])->middleware('auth');
Route::get('/dashboard/wadir/logbook/detail/{id}', [WadirController::class, 'detailLogbook'])->middleware('auth');
Route::get('/dashboard/wadir/view-pdf/{id}', [WadirController::class, 'viewPdf'])->middleware('auth');
// End Route Wadir

// Utility Route
Route::post('/api/fetch-jurusan', [DashboardController::class, 'fetchJurusan']);
Route::get('/export_excel', [LoginController::class, 'exportExcel']);
Route::get('/api/fetch-chart-label', [PembimbingAkademikController::class, 'fetchChartLabel']);
Route::get('/test/sign-pad', function(){
    return view('dashboard.signpad');
});




