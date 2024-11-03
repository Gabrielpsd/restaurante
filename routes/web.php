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

Route::get('/', [InertiaController::class,'mesas']);
Route::get('/produtos', [InertiaController::class,'produtos']);
Route::post('/produtos/edit/{id}', [InertiaController::class,'editar']);
