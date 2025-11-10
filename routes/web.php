<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

Route::get('/produtos', [ProdutoController::class, 'index'])->name('produto.index');
Route::get('/produtos/list', [ProdutoController::class, 'list'])->name('produto.list'); // Carregar produtos via AJAX
Route::redirect('/', '/produtos');

Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produto.create');
Route::post('/produtos', [ProdutoController::class, 'store'])->name('produto.store');
Route::get('/produtos/{produto}', [ProdutoController::class, 'show'])->name('produto.show');
Route::get('/produtos/{produto}/edit', [ProdutoController::class, 'edit'])->name('produto.edit');
Route::put('/produtos/{produto}', [ProdutoController::class, 'update'])->name('produto.update');
Route::delete('/produtos/{produto}', [ProdutoController::class, 'destroy'])->name('produto.destroy');