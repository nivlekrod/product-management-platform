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
     * Return products list as JSON for AJAX requests.
     */
    public function list()
    {
        $produtos = Produto::orderBy('id', 'asc')->get();
        return response()->json(['produtos' => $produtos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return view('produto.create-form');
        }
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

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Produto já existente, estoque atualizado com sucesso.', 'produto' => $produto], 200);
            }
            return redirect()->route('produto.index')->with('success', 'Produto já existente, estoque atualizado com sucesso.');
        }

        Produto::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'quantidade' => $request->quantidade,
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Produto criado com sucesso.', 'produto' => $request->all()], 200);
        }
        return redirect()->route('produto.index')->with('success', 'Produto criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Produto $produto)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['produto' => $produto]);
        }
        return view('produto.show', ['produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Produto $produto)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return view('produto.edit-form', ['produto' => $produto]);
        }
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

        if (!$produto) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Erro ao atualizar o produto.'], 400);
            }
            return redirect()->route('produto.index')->with('error', 'Erro ao atualizar o produto.');
        }
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Produto atualizado com sucesso.', 'produto' => $produto], 200);
        }
        return redirect()->route('produto.index')->with('success', 'Produto atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Produto $produto)
    {
        $deletado = $produto->delete();
        
        if (!$deletado) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Erro ao deletar o produto.'], 400);
            }
            return redirect()->route('produto.index')->with('error', 'Erro ao deletar o produto.');
        }
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Produto deletado com sucesso.']);
        }
        return redirect()->route('produto.index')->with('success', 'Produto deletado com sucesso.');
    }
}
