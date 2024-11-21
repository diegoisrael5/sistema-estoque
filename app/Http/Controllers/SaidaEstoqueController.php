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

        // Cria a nova saída de estoque
        SaidaEstoque::create([
            'equipamento_id' => $request->equipamento_id,
            'cliente_id' => $request->cliente_id,
            'funcionario_id' => $request->funcionario_id,
            'quantidade' => $request->quantidade,
            'data_saida' => $request->data_saida,
            'motivo' => $request->motivo,
        ]);

        // Redireciona para a lista de saídas com uma mensagem de sucesso
        return redirect()->route('saidas_estoque.index')->with('success', 'Saída de estoque cadastrada com sucesso!');
    }

    // Exibe o formulário de edição de uma saída de estoque
    public function edit($id)
    {
        // Obtém a saída de estoque e os equipamentos
        $saidaEstoque = SaidaEstoque::findOrFail($id);
        $equipamentos = Equipamento::all();

        return view('saidas_estoque.edit', compact('saidaEstoque', 'equipamentos'));
    }

    // Atualiza os dados de uma saída de estoque existente
    public function update(Request $request, $id)
    {
        // Valida os dados de atualização
        $validatedData = $request->validate([
            'equipamento_id' => 'required|exists:equipamentos,id',
            'quantidade' => 'required|integer|min:1',
            'data_saida' => 'required|date',
            'motivo' => 'nullable|string',
        ]);

        // Localiza a saída de estoque e a atualiza
        $saidaEstoque = SaidaEstoque::findOrFail($id);
        $saidaEstoque->update($validatedData);

        // Redireciona para a lista de saídas com uma mensagem de sucesso
        return redirect()->route('saidas_estoque.index')->with('success', 'Saída de estoque atualizada com sucesso!');
    }

    // Exclui uma saída de estoque
    public function destroy($id)
    {
        // Localiza a saída de estoque pelo ID
        $saidaEstoque = SaidaEstoque::findOrFail($id);

        // Exclui a saída de estoque
        $saidaEstoque->delete();

        // Redireciona para a lista com uma mensagem de sucesso
        return redirect()->route('saidas_estoque.index')->with('success', 'Saída de estoque excluída com sucesso!');
    }
}
