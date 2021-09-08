<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\TrackingObjectsController;

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

Route::get('calcular', [TesteController::class, 'teste'])->name('teste.teste');
Route::get('frete/calc', [ShippingController::class, 'calc'])->name('frete.calc');
Route::get('objects/tracking', [TrackingObjectsController::class, 'getAll'])->name('objects.tracking.getAll');
Route::get('objects/tracking/{tracking_code}', [TrackingObjectsController::class, 'getOne'])->name('objects.tracking.getOne');
