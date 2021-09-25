<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceInformacoesCadastraisController;
use App\Http\Controllers\ServiceGestaoEEstrategiaController;
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

//SERVIÇO DE AUTENTICAÇÃO
Route::post('auth', [AuthController::class, 'authLogin'])->name('auth.login');
Route::get('auth', [AuthController::class, 'authValidate'])->name('auth.verify');



//UC 01 - RASTREIO DE OBJETOS
Route::get('shippingcompany/objectstracking', [ServiceInformacoesCadastraisController::class, 'objectstracking'])->name('informacoes-cadastrais.objectstracking');
Route::get('shippingcompany/objectstracking/{tracking_code?}', [ServiceInformacoesCadastraisController::class, 'objectstracking'])->name('informacoes-cadastrais.objectstracking');

//UC 02 - CALCULO DE FRETE
Route::get('shippingcompany/calculateshipping', [ServiceInformacoesCadastraisController::class, 'calculateshipping'])->name('informacoes-cadastrais.calculateshipping');

//UC 03 - REALTORIO DE ENTREGAS
Route::get('report/{report_id?}', [ServiceGestaoEEstrategiaController::class, 'getReport'])->name('gestao-estrategia.report');
