<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntradaEstoque;
use App\Models\Equipamento;
use App\Models\Fornecedores; // Ajustando para o nome correto do modelo

class EntradaEstoqueController extends Controller
{
    /**
     * Exibe a lista de todas as entradas de estoque com a opção de filtragem por equipamento.
     */
    public function index(Request $request)
    {
        // Busca os equipamentos para popular o select
        $equipamentos = Equipamento::all();

        // Inicializa a consulta para buscar as entradas de estoque com o relacionamento de equipamentos e fornecedores
        $entradaEstoques = EntradaEstoque::with(['equipamento', 'fornecedor']) // Carrega o fornecedor junto com equipamento
            ->when($request->has('equipamento_id') && $request->equipamento_id != '', function ($query) use ($request) {
                return $query->where('equipamento_id', $request->equipamento_id);
            })
            ->get();

        // Retorna para a view com os dados necessários
        return view('entrada_estoque.index', [
            'entradaEstoques' => $entradaEstoques,
            'equipamentos' => $equipamentos,
            'equipamentoSelecionado' => $request->equipamento_id
        ]);
    }

    /**
     * Exibe o formulário para criar uma nova entrada de estoque.
     */
    public function create()
    {
        // Obter todos os equipamentos e fornecedores para preencher os campos de seleção
        $equipamentos = Equipamento::all();
        $fornecedores = Fornecedores::all(); // Usando o modelo Fornecedores

        // Retornar a view de criação de entrada de estoque com os dados necessários
        return view('entrada_estoque.create', compact('equipamentos', 'fornecedores'));
    }

    /**
     * Armazena uma nova entrada de estoque no banco de dados.
     */
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'equipamento_id' => 'required|exists:equipamentos,id',
            'fornecedor_id' => 'required|exists:fornecedores,id', // Validação para fornecedor
            'quantidade' => 'required|integer|min:1',
            'valor' => 'required|numeric|min:0.01', // Validação para o valor
            'data' => 'required|date', // Validação para a data
        ]);

        // Criar uma nova entrada de estoque
        EntradaEstoque::create([
            'equipamento_id' => $request->equipamento_id,
            'fornecedor_id' => $request->fornecedor_id, // Incluindo o fornecedor na criação
            'quantidade' => $request->quantidade,
            'valor' => $request->valor, // Salvando o valor
            'data' => $request->data, // Salvando a data
        ]);

        // Redirecionar de volta para a lista de entradas de estoque com uma mensagem de sucesso
        return redirect()->route('entrada_estoque.index')->with('success', 'Entrada de estoque criada com sucesso!');
    }

    /**
     * Exibe o formulário para editar uma entrada de estoque existente.
     */
    public function edit($id)
    {
        $entradaEstoque = EntradaEstoque::findOrFail($id); // Recupera a entrada de estoque pelo ID
        $equipamentos = Equipamento::all(); // Recupera todos os equipamentos
        $fornecedores = Fornecedores::all(); // Recupera todos os fornecedores
        return view('entrada_estoque.edit', compact('entradaEstoque', 'equipamentos', 'fornecedores'));
    }

    /**
     * Atualiza uma entrada de estoque existente no banco de dados.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'equipamento_id' => 'required|exists:equipamentos,id',
            'quantidade' => 'required|integer|min:1',
            'data_entrada' => 'required|date',
            // Adicione outras validações conforme necessário
        ]);

        $entrada = EntradaEstoque::findOrFail($id);

        $entrada->update([
            'equipamento_id' => $request->equipamento_id,
            'quantidade' => $request->quantidade,
            'data_entrada' => $request->data_entrada,
            // Outros campos
        ]);

        return redirect()->route('entradas_estoque.index')->with('success', 'Entrada atualizada com sucesso!');
    }


    /**
     * Remove uma entrada de estoque existente do banco de dados.
     */
    public function destroy($id)
    {
        $entradaEstoque = EntradaEstoque::findOrFail($id);
        $entradaEstoque->delete();

        return redirect()->route('entrada_estoque.index')
                         ->with('success', 'Entrada de estoque removida com sucesso!');
    }
}
