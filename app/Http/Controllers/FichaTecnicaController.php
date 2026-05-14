<?php

namespace App\Http\Controllers;

use App\Models\FichaTecnica;
use App\Models\Ingrediente;
use App\Models\Prato;
use Illuminate\Http\Request;

class FichaTecnicaController extends Controller
{
    public function index()
    {
        $fichasTecnicas = FichaTecnica::with(['prato', 'ingrediente'])->get();

        return view('fichas-tecnicas.index', compact('fichasTecnicas'));
    }

    public function create()
    {
        $pratos = Prato::all();
        $ingredientes = Ingrediente::all();

        return view('fichas-tecnicas.create', compact('pratos', 'ingredientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'prato_id' => 'required|exists:pratos,id',
            'ingrediente_id' => 'required|exists:ingredientes,id',
            'quantidade_utilizada' => 'required|numeric|min:0.001',
        ]);

        FichaTecnica::create($request->all());

        return redirect()->route('fichas-tecnicas.index')
            ->with('success', 'Item adicionado à ficha técnica com sucesso!');
    }

    public function edit(FichaTecnica $fichas_tecnica)
    {
        $pratos = Prato::all();
        $ingredientes = Ingrediente::all();

        return view('fichas-tecnicas.edit', [
            'fichaTecnica' => $fichas_tecnica,
            'pratos' => $pratos,
            'ingredientes' => $ingredientes,
        ]);
    }

    public function update(Request $request, FichaTecnica $fichas_tecnica)
    {
        $request->validate([
            'prato_id' => 'required|exists:pratos,id',
            'ingrediente_id' => 'required|exists:ingredientes,id',
            'quantidade_utilizada' => 'required|numeric|min:0.001',
        ]);

        $fichas_tecnica->update($request->all());

        return redirect()->route('fichas-tecnicas.index')
            ->with('success', 'Item da ficha técnica atualizado com sucesso!');
    }

    public function destroy(FichaTecnica $fichas_tecnica)
    {
        $fichas_tecnica->delete();

        return redirect()->route('fichas-tecnicas.index')
            ->with('success', 'Item removido da ficha técnica com sucesso!');
    }
}