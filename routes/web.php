<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\PasanganController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\HeaderIconImageController;
use App\Http\Controllers\SuratIzinPegawaiController;

Route::get('/pegawais/exportExcel', [PegawaiController::class, 'exportExcel'])->name('pegawais.exportExcel');

Route::get('/pasangan', [PasanganController::class, 'viewIndex'])->name('pasangan.index');
Route::get('/pasangan/create', [PasanganController::class, 'viewCreate'])->name('pasangan.create');
Route::post('/pasangan', [PasanganController::class, 'store'])->name('pasangan.store');
Route::get('/pasangan/{id}', [PasanganController::class, 'viewShowWeb'])->name('pasangan.show');
Route::get('/pasangan/{id}/edit', [PasanganController::class, 'viewEdit'])->name('pasangan.edit');
Route::put('/pasangan/{id}', [PasanganController::class, 'updateWeb'])->name('pasangan.update');
Route::delete('/pasangan/{id}', [PasanganController::class, 'destroy'])->name('pasangan.destroy');

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
//     return view('welcome');
// });

Route::resource('holidays', \App\Http\Controllers\HolidayController::class);


Route::resource('kelas', KelasController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::resource('penilai', PenilaiController::class);
Route::resource('kpa', KpaController::class);
Route::resource('bp', BpController::class);

Route::resource('mutasi', MutasiController::class);
Route::get('mutasi/{mutasi}/pdf', [MutasiController::class, 'viewPdf'])->name('mutasi.pdf');

// Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::resource('siswas', SiswaController::class);
Route::resource('siswa-profil', SiswaProfilController::class);
Route::post('/siswas', [SiswaController::class, 'store'])->name('siswa.store');
Route::get('/', [SiswaController::class, 'index'])->name('siswas.index');
Route::get('/siswa/{id}/pdf', [SiswaController::class, 'pdf'])->name('siswa.pdf');
Route::get('/siswa/{siswa}', [SiswaController::class, 'show'])->name('siswa.show');

Route::get('surat', [SuratController::class, 'index'])->name('surat');
Route::resource('surats', SuratController::class);
Route::get('surats/{id}/pdf', [SuratController::class, 'pdf'])->name('surats.pdf');
Route::get('surats/{id}/TabelPdf', [SuratController::class, 'tabel'])->name('tabelPdf');
Route::put('/surats/{surat}', [SuratController::class, 'update']);
Route::post('/surat_siswa/{id}/upload', [SuratController::class, 'uploadFile'])->name('surats.upload'); // surat
Route::post('/surats/{surat}/upload-photos', [SuratController::class, 'uploadPhotos'])->name('surats.upload.photos');
Route::delete('/surats/{surat}/photos/{index}', [SuratController::class, 'deletePhoto'])->name('surats.delete.photo');
Route::get('/photos/{id}', [PhotoController::class, 'show'])->name('photos.show');



Route::resource('pegawais', PegawaiController::class);
Route::get('/pegawais/{id}/pdf', [PegawaiController::class, 'pdf'])->name('pegawais.pdf');
Route::get('/pegawais/{id}/kredit', [PegawaiController::class, 'kredit'])->name('pegawais.kredit');

Route::resource('st-pegawai', StPegawaiController::class);
Route::get('stPegawai', [StPegawaiController::class, 'index'])->name('stPegawai.index');
Route::get('/st-pegawai/{id}/pdf', [StPegawaiController::class, 'pdf'])->name('st-pegawai.pdf');
Route::get('/rincian/{id}/pdf', [StPegawaiController::class, 'rincianPdf'])->name('rincian_pdf');
Route::get('/spb/{id}/pdf', [StPegawaiController::class, 'spbPdf'])->name('spb_pdf');
Route::get('/sppd/{id}/pdf', [StPegawaiController::class, 'sppdPdf'])->name('sppd_pdf');
Route::get('/sppd/{id}/depan', [StPegawaiController::class, 'sppd_depan'])->name('sppd_depan');
Route::get('/kwitansi/{id}/pdf', [StPegawaiController::class, 'kwitansiPdf'])->name('kwitansi_pdf');
Route::post('/surats/{id}/upload', [StPegawaiController::class, 'uploadFile'])->name('st-surat.upload'); // st_surat
Route::get('/st-pegawai/laporan/{id}', [StPegawaiController::class, 'laporan'])->name('st-pegawai.laporan');

Route::resource('akKredits', AkKreditController::class);


Route::get('/akKredit.index', [AkKreditController::class, 'index'])->name('akKredit.index');
Route::get('/akKredit.create', [AkKreditController::class, 'create'])->name('akKredit.create');
Route::get('/akKredit/{id}/pdf', [AkKreditController::class, 'pdf'])->name('akKredit.pdf');
Route::get('/akumulasi', [AkKreditController::class, 'akumulasi'])->name('akKredit.akumulasi');
Route::get('/akKredits/pdf', [AkKreditController::class, 'generatePdf'])->name('akKredits.pdf');
Route::get('/ak-kredits/generate-pdf', [AkKreditController::class, 'generatePdf'])->name('akKredits.generatePdf');
Route::get('/akKredits/{id}/view-pdf', [AkKreditController::class, 'viewPdf'])->name('akKredits.viewPdf');
Route::get('/ak-kredits/penetapan', [AkKreditController::class, 'penetapan'])->name('akKredits.penetapan');


Route::get('/photos', [PhotoController::class, 'index'])->name('photos.index');
Route::get('/photos/create', [PhotoController::class, 'create'])->name('photos.create');
Route::post('/photos', [PhotoController::class, 'store'])->name('photos.store');
Route::get('/photos/{photo}/edit', [PhotoController::class, 'edit'])->name('photos.edit');
Route::put('/photos/{photo}', [PhotoController::class, 'update'])->name('photos.update');
Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');


Route::prefix('surat/{surat_id}/gambar')->group(function () {
    Route::get('/', [GambarSuratController::class, 'index'])->name('gambar_surat.index');
    Route::get('/create', [GambarSuratController::class, 'create'])->name('gambar_surat.create');
    Route::post('/store', [GambarSuratController::class, 'store'])->name('gambar_surat.store');
    Route::get('/print-pdf', [GambarSuratController::class, 'printPdf'])->name('gambar_surat.printPdf');
});

Route::delete('/gambar_surat/{surat_id}/{gambar}', [GambarSuratController::class, 'destroy'])
    ->name('gambar_surat.destroy');

Route::prefix('st_surat/{surat_id}/photo')->group(function () {
    Route::get('/', [PhotoSuratController::class, 'index'])->name('photo_surat.index');
    Route::get('/create', [PhotoSuratController::class, 'create'])->name('photo_surat.create');
    Route::post('/store', [PhotoSuratController::class, 'store'])->name('photo_surat.store');
    Route::get('/print-pdf', [PhotoSuratController::class, 'printPdf'])->name('photo_surat.printPdf');
});

Route::delete('/photo_surat/{st_surat_id}/{photo}', [PhotoSuratController::class, 'destroy'])
    ->name('photo_surat.destroy');

Route::get('/rincian_surat', [RincianController::class, 'index'])->name('rincian_surat.index');
Route::get('/rincian_surat/create', [RincianController::class, 'create'])->name('rincian_surat.create');
Route::post('/rincian_surat', [RincianController::class, 'store'])->name('rincian_surat.store');

Route::resource('dispensasi', \App\Http\Controllers\DispensasiController::class);
Route::get('dispensasi/{id}/pdf', [\App\Http\Controllers\DispensasiController::class, 'pdf'])->name('dispensasi.pdf');
Route::get('surats/{id}/tabeldispensasi', [DispensasiController::class, 'tabeldispensasi'])->name('tabeldispensasi');

Route::resource('sukets', \App\Http\Controllers\SuketController::class);

Route::get('sukets/{id}/pdf', [\App\Http\Controllers\SuketController::class, 'pdf'])->name('sukets.pdf');

Route::resource('surat_izin_pegawai', SuratIzinPegawaiController::class);
Route::get('surat_izin_pegawai/{id}/pdf', [SuratIzinPegawaiController::class, 'pdf'])->name('surat_izin_pegawai.pdf');

Route::resource('header_icon_images', HeaderIconImageController::class);

Route::get('/anak', [AnakController::class, 'viewIndex'])->name('anak.index');
Route::get('/anak/create', [AnakController::class, 'viewCreate'])->name('anak.create');
Route::get('/anak/{id}', [AnakController::class, 'viewShowWeb'])->name('anak.show');
Route::get('/anak/{id}/pdf', [AnakController::class, 'pdf'])->name('anak.pdf');
Route::get('/anak/{id}/edit', [AnakController::class, 'viewEdit'])->name('anak.edit');
Route::put('/anak/{id}', [AnakController::class, 'updateWeb'])->name('anak.updateWeb');
