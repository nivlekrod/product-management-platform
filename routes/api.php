<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

Route::get('/produtos', [ProdutoController::class, 'list']);
Route::post('/produtos', [ProdutoController::class, 'store']);
Route::get('/produtos/{produto}', [ProdutoController::class, 'show']);
Route::put('/produtos/{produto}', [ProdutoController::class, 'update']);
Route::delete('/produtos/{produto}', [ProdutoController::class, 'destroy']);
