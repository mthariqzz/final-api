<?php

use App\Http\Controllers\API\HplController;
use App\Http\Controllers\API\IbuHamilController;
use App\Http\Controllers\API\PemeriksaanController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\EducationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::get('education', [EducationController::class, 'edukasi']);






Route::middleware(['auth:sanctum'])->group(function () {
    // Rute untuk ProfileController
    Route::get('/profile', [ProfileController::class, 'fetch']);
    Route::post('/profile/update', [ProfileController::class, 'update']);

    // Rute untuk PemeriksaanController
    Route::get('/pemeriksaan', [PemeriksaanController::class, 'fetch']);

    // Rute untuk HplController
    Route::get('/hpl', [HplController::class, 'fetch']);

    // Rute untuk IbuHamilController
    Route::get('/ibu-hamil', [IbuHamilController::class, 'index']);

    Route::post('logout', [UserController::class, 'logout']);
});
