<?php

use App\Http\Controllers\TesteController;
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

Route::get('calcular', [TesteController::class, 'teste'])->name('teste.teste');


Route::get('/', function (Request $request) {
    return "GET modulo informações cadastrais  -> " . ($request->get('name', 'ND')) . ' - ' . ($request->get('role', 'ND')) . '<-';
});


Route::post('/', function (Request $request) {
    return "POST modulo informações cadastrais  -> " . ($request->get('name', 'ND')) . ' - ' . ($request->get('role', 'ND')) . '<-';
});
