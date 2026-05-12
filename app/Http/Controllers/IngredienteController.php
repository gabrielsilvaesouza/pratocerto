<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
use Illuminate\Http\Request;

class IngredienteController extends Controller
{
    public function index()
    {
        $ingredientes = Ingrediente::all();

        return view('ingredientes.index', compact('ingredientes'));
    }

    public function create()
    {
        return view('ingredientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'unidade_medida' => 'required|string|max:50',
            'quantidade_estoque' => 'required|numeric|min:0',
            'custo_unitario' => 'required|numeric|min:0',
            'estoque_minimo' => 'required|numeric|min:0',
        ]);

        Ingrediente::create($request->all());

        return redirect()->route('ingredientes.index')
            ->with('success', 'Ingrediente cadastrado com sucesso!');
    }

    public function edit(Ingrediente $ingrediente)
    {
        return view('ingredientes.edit', compact('ingrediente'));
    }

    public function update(Request $request, Ingrediente $ingrediente)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'unidade_medida' => 'required|string|max:50',
            'quantidade_estoque' => 'required|numeric|min:0',
            'custo_unitario' => 'required|numeric|min:0',
            'estoque_minimo' => 'required|numeric|min:0',
        ]);

        $ingrediente->update($request->all());

        return redirect()->route('ingredientes.index')
            ->with('success', 'Ingrediente atualizado com sucesso!');
    }

    public function destroy(Ingrediente $ingrediente)
    {
        $ingrediente->delete();

        return redirect()->route('ingredientes.index')
            ->with('success', 'Ingrediente excluído com sucesso!');
    }
}