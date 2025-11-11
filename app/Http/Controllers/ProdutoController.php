<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Http\Requests\ProdutoRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(): View
    {
        $produtos = Produto::orderBy('id', 'asc')->get();
        return view('produto.index', ['produtos' => $produtos]);
    }

    public function list(Request $request)
    {
        $query = Produto::query();

        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->whereLike('nome', "%{$search}%");
        }

        $produtos = $query->orderBy('id', 'asc')->get();
        return response()->json(['produtos' => $produtos]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:1'
        ]);

        $searchTerm = $request->q;
        $produtos = Produto::whereLike('nome', "%{$searchTerm}%")
            ->orderBy('nome', 'asc')
            ->get();

        return response()->json(['produtos' => $produtos]);
    }

    public function create(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return view('produto.create-form');
        }
        return view('produto.create');
    }

    public function store(ProdutoRequest $request)
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

        $produtoCriado = Produto::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'preco' => $request->preco,
            'quantidade' => $request->quantidade,
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Produto criado com sucesso.', 'produto' => $produtoCriado], 200);
        }
        return redirect()->route('produto.index')->with('success', 'Produto criado com sucesso.');
    }

    public function show(Request $request, Produto $produto)
    {
        if ($request->wantsJson()) {
            return response()->json(['produto' => $produto]);
        }
        if ($request->ajax()) {
            return view('produto.show-content', ['produto' => $produto]);
        }
        return view('produto.show', ['produto' => $produto]);
    }

    public function edit(Request $request, Produto $produto)
    {
        if ($request->ajax() || $request->wantsJson()) {
            return view('produto.edit-form', ['produto' => $produto]);
        }
        return view('produto.edit', ['produto' => $produto]);
    }

    public function update(ProdutoRequest $request, Produto $produto)
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

    public function updateQuantity(Request $request, Produto $produto)
    {
        $request->validate([
            'quantidade' => 'required|integer|min:0'
        ]);

        $produto->quantidade = $request->quantidade;
        $produto->save();
        
        return response()->json([
            'success' => true, 
            'message' => 'Quantidade atualizada com sucesso.', 
            'produto' => $produto
        ], 200);
    }

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
