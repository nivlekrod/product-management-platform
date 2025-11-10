<?php

use Illuminate\Support\Facades\Route;
use App\Models\Produto;
use App\Http\Controllers\ProdutoController;

Route::get('/', function () {
    return view('produto.index', ['produtos' => Produto::all()] );
});

Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');
Route::get('/produto/{produto}', [ProdutoController::class, 'show'])->name('produtos.show');
Route::get('/produto/{produto}/edit', [ProdutoController::class, 'edit'])->name('produtos.edit');
Route::put('/produto/{produto}', [ProdutoController::class, 'update'])->name('produtos.update');
Route::delete('/produto/{produto}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');

Route::resource('produtos', ProdutoController::class);