<?php

use App\Http\Controllers\Api\ConvenioController;
use App\Http\Controllers\Api\InstituicaoController;
use App\Http\Controllers\Api\TaxaInstituicaoController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/instituicoes', [InstituicaoController::class, 'show']);

Route::get('/convenios', [ConvenioController::class, 'show']);

Route::get('/taxas-instituicoes', [TaxaInstituicaoController::class, 'show']);

Route::post('/simulacao', [TaxaInstituicaoController::class, 'simular']);