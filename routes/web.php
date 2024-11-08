<?php

use App\Http\Controllers\InertiaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* pedidos */ 
Route::get('/', [InertiaController::class,'mesas']);
Route::get('/pedidos', [InertiaController::class,'listaPedidos']);
Route::get('/pedidos/editar/{id}', [InertiaController::class,'editarPedido']);

/*produtos */
Route::get('/produtos', [InertiaController::class,'produtos']);
Route::post('/produtos/editar/{id}', [InertiaController::class,'editarProduto']);

/* Pessoas */ 
Route::get('/pessoas', [InertiaController::class,'pessoas']);
Route::post('/pessoas/editar/{id}', [InertiaController::class,'editarPessoa']);
