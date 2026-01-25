<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BendController;
use App\Http\Controllers\PPGajiController;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\PergubController;
use App\Http\Controllers\PerdaController;
use App\Http\Controllers\PasanganController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\HeaderIconImageController;
use App\Http\Controllers\SuratIzinPegawaiController;
use App\Http\Controllers\SuketController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\StPegawaiController;
use App\Http\Controllers\AkKreditController;
use App\Http\Controllers\DispensasiController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\GambarSuratController;
use App\Http\Controllers\PhotoSuratController;
use App\Http\Controllers\RincianController;
use App\Http\Controllers\RincianSuratController;
use App\Http\Controllers\PenilaiController;
use App\Http\Controllers\KpaController;
use App\Http\Controllers\BpController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\SiswaProfilController;
use App\Http\Controllers\SpmtController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\SisaCutiController;
use App\Http\Controllers\IppController;

Route::get('/test-route', function () {
    return 'Test route is working';
});

// Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('login', [LoginController::class, 'login']);

Route::get('/', [SiswaController::class, 'index'])->name('home');
Route::get('/siswa/{id}/pdf', [SiswaController::class, 'pdf'])->name('siswa.pdf');
Route::get('/siswa/{siswa}', [SiswaController::class, 'show'])->name('siswa.show');

Route::resource('siswas', SiswaController::class);
Route::get('siswas/export', [SiswaController::class, 'export'])->name('siswas.export');
Route::post('siswas/import', [SiswaController::class, 'import'])->name('siswas.import');

Route::resource('kelas', KelasController::class);
Route::resource('header_icon_images', HeaderIconImageController::class);
Route::resource('holidays', HolidayController::class);
Route::resource('pegawais', PegawaiController::class);
Route::get('pegawais/{id}/edit-modal', [PegawaiController::class, 'editModal'])->name('pegawais.edit-modal');
Route::get('pegawais/export-excel', [PegawaiController::class, 'exportExcel'])->name('pegawais.exportExcel');
Route::post('pegawais/import-excel', [PegawaiController::class, 'importExcel'])->name('pegawais.importExcel');
Route::delete('pegawais/destroy-all', [PegawaiController::class, 'destroyAll'])->name('pegawais.destroyAll');
Route::get('pegawais/{id}/kredit', [PegawaiController::class, 'kredit'])->name('pegawais.kredit');
Route::resource('penilai', PenilaiController::class);
Route::resource('kpa', KpaController::class);
Route::resource('bp', BpController::class);
Route::resource('surat_izin_pegawai', SuratIzinPegawaiController::class);
Route::resource('stPegawai', StPegawaiController::class);
// Redirect old akKredit URL to new akKredits URL for backward compatibility
Route::redirect('akKredit', 'akKredits', 301);
// Define custom routes BEFORE the resource route to avoid being caught by the wildcard
Route::get('akKredits/generate-pdf', [AkKreditController::class, 'generatePdf'])->name('akKredits.generatePdf');
Route::get('akKredits/penetapan', [AkKreditController::class, 'penetapan'])->name('akKredits.penetapan');
Route::get('akKredits/view-pdf/{id}', [AkKreditController::class, 'viewPdf'])->name('akKredits.viewPdf');
Route::get('akKredits/pegawai/{pegawaiId}', [AkKreditController::class, 'forPegawai'])->name('akKredits.forPegawai');
Route::get('akKredits/test-route', function() {
    return 'Test route after resource!';
})->name('akKredits.test');
Route::resource('akKredits', AkKreditController::class);
Route::get('test-generate-pdf', function() {
    return 'Test route works!';
})->name('test.generate.pdf');
Route::resource('mutasi', MutasiController::class);
Route::resource('sukets', SuketController::class);
Route::resource('surat', SuratController::class);
Route::resource('dispensasi', DispensasiController::class);
Route::resource('siswa-profil', SiswaProfilController::class);
Route::resource('anak', AnakController::class);
Route::get('anak/{id}/pdf', [AnakController::class, 'pdf'])->name('anak.pdf');
Route::resource('pasangan', PasanganController::class);
Route::resource('pp_gaji', PPGajiController::class);
Route::resource('pergub', PergubController::class);
Route::resource('perda', PerdaController::class);
Route::resource('bends', BendController::class);
Route::resource('ipps', IppController::class);
Route::resource('cuti', CutiController::class);
Route::resource('sisa_cuti', SisaCutiController::class);
Route::resource('spmts', SpmtController::class);


