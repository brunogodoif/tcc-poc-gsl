<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::post('auth', [AuthController::class, 'authLogin'])->name('auth.login');
Route::get('auth', [AuthController::class, 'authValidate'])->name('auth.verify');
Route::get('teste', [AuthController::class, 'teste'])->name('auth.verify');
Route::get('teste2', [AuthController::class, 'teste2'])->name('auth.verify');
