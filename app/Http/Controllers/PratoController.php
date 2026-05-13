<?php

namespace App\Http\Controllers;

use App\Models\Prato; 
use Illuminate\Http\Request;

class PratoController extends Controller
{
    public function index()
    {
        $pratos = Prato::all();
        return view('pratos.index', compact('pratos'));
    }

    public function create()
    {
        return view('pratos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco_venda' => 'required|numeric|min:0',
        ]);

        Prato::create($request->all());
        return redirect()->route('pratos.index')->with('success', 'Prato criado com sucesso!');
    }

    public function edit(Prato $prato)
    {
        return view('pratos.edit', compact('prato'));
    }

    public function update(Request $request, Prato $prato)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco_venda' => 'required|numeric|min:0',
        ]);

        $prato->update($request->all());
        return redirect()->route('pratos.index')->with('success', 'Prato atualizado!');
    }

    public function destroy(Prato $prato)
    {
        $prato->delete();
        return redirect()->route('pratos.index')->with('success', 'Prato excluído!');
    }
}