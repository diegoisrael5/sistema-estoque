<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntradaEstoque;
use App\Models\Equipamento;
use App\Models\Fornecedores; 

class EntradaEstoqueController extends Controller
{

    public function index(Request $request)
    {
        
        $equipamentos = Equipamento::all();

      
        $entradaEstoques = EntradaEstoque::with(['equipamento', 'fornecedor']) 
            ->when($request->has('equipamento_id') && $request->equipamento_id != '', function ($query) use ($request) {
                return $query->where('equipamento_id', $request->equipamento_id);
            })
            ->get();

        
        return view('entrada_estoque.index', [
            'entradaEstoques' => $entradaEstoques,
            'equipamentos' => $equipamentos,
            'equipamentoSelecionado' => $request->equipamento_id
        ]);
    }

   
    public function create()
    {
      
        $equipamentos = Equipamento::all();
        $fornecedores = Fornecedores::all(); 

     
        return view('entrada_estoque.create', compact('equipamentos', 'fornecedores'));
    }


    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'equipamento_id' => 'required|exists:equipamentos,id',
            'fornecedor_id' => 'required|exists:fornecedores,id', 
            'quantidade' => 'required|integer|min:1',
            'valor' => 'required|numeric|min:0.01', 
            'data' => 'required|date', 
        ]);

        
        EntradaEstoque::create([
            'equipamento_id' => $request->equipamento_id,
            'fornecedor_id' => $request->fornecedor_id, 
            'quantidade' => $request->quantidade,
            'valor' => $request->valor, 
            'data' => $request->data, 
        ]);

        
        return redirect()->route('entrada_estoque.index')->with('success', 'Entrada de estoque criada com sucesso!');
    }

 
    public function edit($id)
    {
        $entradaEstoque = EntradaEstoque::findOrFail($id); 
        $equipamentos = Equipamento::all(); 
        $fornecedores = Fornecedores::all(); 
        return view('entrada_estoque.edit', compact('entradaEstoque', 'equipamentos', 'fornecedores'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'equipamento_id' => 'required|exists:equipamentos,id',
            'quantidade' => 'required|integer|min:1',
            'data_entrada' => 'required|date',
            
        ]);

        $entrada = EntradaEstoque::findOrFail($id);

        $entrada->update([
            'equipamento_id' => $request->equipamento_id,
            'quantidade' => $request->quantidade,
            'data_entrada' => $request->data_entrada,
            
        ]);

        return redirect()->route('entradas_estoque.index')->with('success', 'Entrada atualizada com sucesso!');
    }



    public function destroy($id)
    {
        $entradaEstoque = EntradaEstoque::findOrFail($id);
        $entradaEstoque->delete();

        return redirect()->route('entrada_estoque.index')
                         ->with('success', 'Entrada de estoque removida com sucesso!');
    }
}
