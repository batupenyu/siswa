<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnakController;

use App\Http\Controllers\SiswaProfilController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('siswa-profil', SiswaProfilController::class)->names([
    'index' => 'api.siswa-profil.index',
    'create' => 'api.siswa-profil.create',
    'store' => 'api.siswa-profil.store',
    'show' => 'api.siswa-profil.show',
    'edit' => 'api.siswa-profil.edit',
    'update' => 'api.siswa-profil.update',
    'destroy' => 'api.siswa-profil.destroy',
]);
Route::apiResource('anak', AnakController::class)->names([
    'index' => 'api.anak.index',
    'create' => 'api.anak.create',
    'store' => 'api.anak.store',
    'show' => 'api.anak.show',
    'edit' => 'api.anak.edit',
    'update' => 'api.anak.update',
    'destroy' => 'api.anak.destroy',
]);
