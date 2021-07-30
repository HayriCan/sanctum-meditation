<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MeditationFinish;
use App\Http\Controllers\ReportController;
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

Route::post('/auth/register', [AuthController::class, 'register'])->name('register');

Route::post('/auth/login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/meditation-finish', MeditationFinish::class)->name('meditation-finish');
    Route::get('/first-item',[ReportController::class, 'reportFirstItem'])->name('first-item');
    Route::get('/second-item',[ReportController::class, 'reportSecondItem'])->name('second-item');
    Route::get('/third-item',[ReportController::class, 'reportThirdItem'])->name('third-item');
});
