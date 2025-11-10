<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $produtos = Produto::all();
        return view('produto.index', ['produtos' => $produtos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produto.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $produto = Produto::where(['nome' => $request->nome, 'descricao' => $request->descricao])->first();

        if ($produto) {
            $produto->quantidade += $request->quantidade;
            
            if ($request->preco < $produto->preco) {
                $produto->preco = $request->preco;
            }
            
            $produto->save();

            return redirect()->route('produtos.index')->with('success', 'Produto já existente, estoque atualizado com sucesso.');
        }

        Produto::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'quantidade' => $request->quantidade,
        ]);

        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        return view('produto.show', ['produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        return view('produto.edit', ['produto' => $produto]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        $produto->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'quantidade' => $request->quantidade,
        ]);

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        $deletado = $produto->delete();
        
        if (!$deletado) {
            return redirect()->route('produtos.index')->with('error', 'Erro ao deletar o produto.');
        }
        
        return redirect()->route('produtos.index')->with('success', 'Produto deletado com sucesso.');
    }
}
