<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use App\Models\Cliente;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use App\Models\SaidaEstoque; // Corrigido para usar 'SaidaEstoque'

class SaidaEstoqueController extends Controller
{
    // Exibe todas as saídas de estoque e os equipamentos para filtro
    public function index()
    {
        $saidasEstoques = SaidaEstoque::all();  // Obtém todas as saídas de estoque
        $equipamentos = Equipamento::all();     // Obtém todos os equipamentos

        return view('saidas_estoque.index', compact('saidasEstoques', 'equipamentos'));
    }

    // Exibe o formulário de criação de saída de estoque
    public function create()
    {
        // Carrega todos os clientes, equipamentos e funcionários
        $equipamentos = Equipamento::all();
        $clientes = Cliente::all();
        $funcionarios = Funcionario::all();

        return view('saidas_estoque.create', compact('equipamentos', 'clientes', 'funcionarios'));
    }

    // Armazena uma nova saída de estoque
    public function store(Request $request)
    {
        // Valida os dados recebidos no formulário
        $request->validate([
            'equipamento_id' => 'required|exists:equipamentos,id',
            'cliente_id' => 'required|exists:clientes,id',
            'funcionario_id' => 'required|exists:funcionarios,id',
            'quantidade' => 'required|integer|min:1',
            'data_saida' => 'required|date',
            'motivo' => 'nullable|string',
        ]);


        SaidaEstoque::create([
            'equipamento_id' => $request->equipamento_id,
            'cliente_id' => $request->cliente_id,
            'funcionario_id' => $request->funcionario_id,
            'quantidade' => $request->quantidade,
            'data_saida' => $request->data_saida,
            'motivo' => $request->motivo,
        ]);

        
        return redirect()->route('saidas_estoque.index')->with('success', 'Saída de estoque cadastrada com sucesso!');
    }

    
    public function edit($id)
    {
        
        $saidaEstoque = SaidaEstoque::findOrFail($id);
        $equipamentos = Equipamento::all();

        return view('saidas_estoque.edit', compact('saidaEstoque', 'equipamentos'));
    }

   
    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'equipamento_id' => 'required|exists:equipamentos,id',
            'quantidade' => 'required|integer|min:1',
            'data_saida' => 'required|date',
            'motivo' => 'nullable|string',
        ]);

        
        $saidaEstoque = SaidaEstoque::findOrFail($id);
        $saidaEstoque->update($validatedData);

        
        return redirect()->route('saidas_estoque.index')->with('success', 'Saída de estoque atualizada com sucesso!');
    }

   
    public function destroy($id)
    {
       
        $saidaEstoque = SaidaEstoque::findOrFail($id);

        
        $saidaEstoque->delete();

    
        return redirect()->route('saidas_estoque.index')->with('success', 'Saída de estoque excluída com sucesso!');
    }
}
