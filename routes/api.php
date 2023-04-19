<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenarikanSaldoController;
use App\Http\Controllers\TopUpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\KategoriResepController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->post('/user', [AuthController::class, 'editProfile']);

Route::resource('kategori-resep', KategoriResepController::class);
Route::resource('resep', ResepController::class);
Route::resource('feed', FeedController::class);
Route::get('/top-recipe-id', [ResepController::class, 'getTopRecipeId']);
Route::get('/reseps/{nama_kategori_resep}', [ResepController::class, 'showbasedkategori'])->name('reseps.showbasedkategori');
Route::get('/resepsaya/{id_pengguna}', [ResepController::class, 'showresepsaya'])->name('reseps.showresepsaya');


Route::apiResource('top-up', TopUpController::class);
Route::apiResource('penarikan-saldo', PenarikanSaldoController::class);
