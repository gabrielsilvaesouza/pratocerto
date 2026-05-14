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

        $pratos = Prato::with(['fichaTecnicas.ingrediente'])->get();

        return view('fichas-tecnicas.index', compact('fichasTecnicas', 'pratos'));
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
            'ingredientes' => 'required|array',
            'ingredientes.*.ingrediente_id' => 'required|exists:ingredientes,id',
            'ingredientes.*.quantidade_utilizada' => 'nullable|numeric|min:0.001',
        ]);

        $algumIngredienteAdicionado = false;

        foreach ($request->ingredientes as $item) {
            if (!empty($item['quantidade_utilizada'])) {
                FichaTecnica::create([
                    'prato_id' => $request->prato_id,
                    'ingrediente_id' => $item['ingrediente_id'],
                    'quantidade_utilizada' => $item['quantidade_utilizada'],
                ]);

                $algumIngredienteAdicionado = true;
            }
        }

        if (!$algumIngredienteAdicionado) {
            return redirect()->back()
                ->withErrors(['quantidade_utilizada' => 'Informe a quantidade utilizada em pelo menos um ingrediente.'])
                ->withInput();
        }

        return redirect()->route('fichas-tecnicas.index')
            ->with('success', 'Ficha técnica cadastrada com sucesso!');
    }

    public function edit(FichaTecnica $fichas_tecnica)
    {
        $pratos = Prato::all();
        $ingredientes = Ingrediente::all();

        $itensFicha = FichaTecnica::with('ingrediente')
            ->where('prato_id', $fichas_tecnica->prato_id)
            ->get();

        return view('fichas-tecnicas.edit', [
            'fichaTecnica' => $fichas_tecnica,
            'pratos' => $pratos,
            'ingredientes' => $ingredientes,
            'itensFicha' => $itensFicha,
        ]);
    }

    public function update(Request $request, FichaTecnica $fichas_tecnica)
    {
        $request->validate([
            'prato_id' => 'required|exists:pratos,id',
            'ingredientes' => 'required|array',
            'ingredientes.*.ingrediente_id' => 'required|exists:ingredientes,id',
            'ingredientes.*.quantidade_utilizada' => 'required|numeric|min:0.001',
        ]);

        $pratoOriginalId = $fichas_tecnica->prato_id;

        FichaTecnica::where('prato_id', $pratoOriginalId)->delete();

        foreach ($request->ingredientes as $item) {
            FichaTecnica::create([
                'prato_id' => $request->prato_id,
                'ingrediente_id' => $item['ingrediente_id'],
                'quantidade_utilizada' => $item['quantidade_utilizada'],
            ]);
        }

        return redirect()->route('fichas-tecnicas.index')
            ->with('success', 'Ficha técnica atualizada com sucesso!');
    }

    public function destroy(FichaTecnica $fichas_tecnica)
    {
        $fichas_tecnica->delete();

        return redirect()->route('fichas-tecnicas.index')
            ->with('success', 'Item removido da ficha técnica com sucesso!');
    }
}