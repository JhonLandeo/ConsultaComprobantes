<?php

use App\Http\Controllers\DocumentoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;

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
Route::get('/', [DocumentoController::class, 'index']);

Route::get('total/{ruc}/{type}', [DocumentoController::class, 'total']);
Route::get('doc/{ruc}/{type}/{series}/{number}', [DocumentoController::class, 'doc']);
Route::get('pedido', [PedidoController::class, 'create']);
Route::get('producto/idProducto={id}', [PedidoController::class, 'producto']);
Route::get('proceso/{created_at}', [DocumentoController::class, 'procesar']);