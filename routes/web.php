<?php

use App\Http\Controllers\DocumentoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PedidoController;


Route::get('/', [DocumentoController::class, 'index']);
Route::get('total/{ruc}/{type}/{month}/{year}', [DocumentoController::class, 'total']);
Route::get('totalMes/{month}/{year}', [DocumentoController::class, 'cantidadMes']);
Route::get('totalMesDash', [DocumentoController::class, 'cantidadMesDash']);
Route::get('cantidadCliente', [DocumentoController::class, 'getEnterprise']);
Route::get('topCliente', [DocumentoController::class, 'topClient']);
Route::get('list', [DocumentoController::class, 'list']);
Route::get('listActualizar', [DocumentoController::class, 'listActualizar']);
Route::get('totalGuias/{ruc}/{type}/{month}/{year}', [DocumentoController::class, 'totalGuias']);
Route::get('totalOrdenVenta/{ruc}/{type}/{month}/{year}', [DocumentoController::class, 'totalOrdenVenta']);
Route::get('totalCotizacion/{ruc}/{type}/{month}/{year}', [DocumentoController::class, 'totalCotizacion']);
Route::get('totalLiquidacion/{ruc}/{type}/{month}/{year}', [DocumentoController::class, 'totalLiquidacion']);
Route::get('totalPurchase/{ruc}/{type}/{month}/{year}', [DocumentoController::class, 'totalPurchase']);
Route::get('doc/{ruc}/{type}/{series}/{number}', [DocumentoController::class, 'doc']);
Route::get('pedido', [PedidoController::class, 'create']);
Route::get('producto/idProducto={id}', [PedidoController::class, 'producto']);
Route::get('proceso/{created_at}', [DocumentoController::class, 'procesar']);