<?php

namespace App\Http\Controllers;

use App\Models\Fornecedores;
use Illuminate\Http\Request;

class FornecedoresController extends Controller
{
    /**
     * Exibe a lista de fornecedores.
     */
    public function index()
    {
        $fornecedores = Fornecedores::all();
        return view('fornecedores.index', compact('fornecedores'));
    }

    /**
     * Exibe o formulário para criar um novo fornecedor.
     */
    public function create()
    {
        return view('fornecedores.create');
    }

    /**
     * Armazena um novo fornecedor no banco de dados.
     */
    public function store(Request $request)
    {
        // Validação dos dados do fornecedor
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:fornecedores,email',
            'telefone' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
        ]);

        // Criação do fornecedor
        Fornecedores::create($validatedData);

        // Redireciona para a lista de fornecedores com mensagem de sucesso
        return redirect()->route('fornecedores.index')
                         ->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    /**
     * Exibe os detalhes de um fornecedor específico.
     */
    public function show(Fornecedores $fornecedor)
    {
        return view('fornecedores.show', compact('fornecedor'));
    }

    /**
     * Exibe o formulário para editar um fornecedor específico.
     */
    public function edit(Fornecedores $fornecedor)
    {
        return view('fornecedores.edit', compact('fornecedor'));
    }

    /**
     * Atualiza as informações de um fornecedor específico.
     */
    public function update(Request $request, Fornecedores $fornecedor)
    {
        // Validação dos dados do fornecedor
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:fornecedores,email,' . $fornecedor->id,
            'telefone' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
        ]);

        // Atualização dos dados do fornecedor
        $fornecedor->update($validatedData);

        // Redireciona para a lista de fornecedores com mensagem de sucesso
        return redirect()->route('fornecedores.index')
                         ->with('success', 'Fornecedor atualizado com sucesso!');
    }

    /**
     * Exclui um fornecedor específico.
     */
    public function destroy(Fornecedores $fornecedor)
    {
        // Exclui o fornecedor do banco de dados
        $fornecedor->delete();

        // Redireciona para a lista de fornecedores com mensagem de sucesso
        return redirect()->route('fornecedores.index')
                         ->with('success', 'Fornecedor excluído com sucesso!');
    }
}
