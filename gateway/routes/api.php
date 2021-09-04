<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceInformacoesCadastraisController;
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

Route::get('shippingcompany/calculateshipping', [ServiceInformacoesCadastraisController::class, 'calculateshipping'])->name('informacoes-cadastrais.calculateshipping');

