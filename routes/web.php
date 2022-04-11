<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\petawbController;
use App\Http\Controllers\kegiatanController;
use App\Http\Controllers\cetakController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/a', function () {
    return view('welcome');
});

Route::get('/', [petawbController::class,'index']);
Route::get('/petawb-tabel', [petawbController::class,'tabel']);

Route::get('/kegiatan', [kegiatanController::class,'index']);
Route::get('/kegiatan-tabel', [kegiatanController::class,'tabel']);
Route::post('/kegiatan/create', [kegiatanController::class,'create']);
Route::get('/kegiatan/{idkeg}/delete', [kegiatanController::class,'delete']);
Route::get('/getkegiatanbyid/{id}', [kegiatanController::class,'getkegiatanbyid']);
Route::get('/cetak/{idbs}', [cetakController::class,'index']);
Route::get('/cetakkegiatan/{idkeg}', [cetakController::class,'cetakkegiatan']);
