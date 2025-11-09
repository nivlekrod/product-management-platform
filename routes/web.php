<?php

use Illuminate\Support\Facades\Route;
use App\Models\Produto;
use App\Http\Controllers\ProdutoController;

Route::get('/', function () {
    return view('produto.index', ['produtos' => Produto::all()] );
});

Route::resource('produtos', ProdutoController::class);