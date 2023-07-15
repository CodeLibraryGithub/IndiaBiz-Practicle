<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//   return view('welcome');
// });

Route::get('/', [UserController::class,'index']);
Route::get('/view', [UserController::class,'view']);
Route::get('/deleteprofille/{id}', [UserController::class,'deleteprofille']);
Route::post('/saveuserdetails', [UserController::class,'saveuserdetails'])->name('saveuserdetails');