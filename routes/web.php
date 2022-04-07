<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\petawbController;

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
Route::get('/petawb', [petawbController::class,'petawb']);
