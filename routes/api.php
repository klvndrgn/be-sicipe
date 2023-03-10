<?php

use App\Http\Controllers\FeedController;
use App\Http\Controllers\PenarikanSaldoController;
use App\Http\Controllers\TopUpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('feeds', FeedController::class);
Route::apiResource('top-up', TopUpController::class);
Route::apiResource('penarikan-saldo', PenarikanSaldoController::class);