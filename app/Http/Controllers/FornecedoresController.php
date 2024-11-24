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
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:fornecedores,email',
            'telefone' => 'nullable|string|max:20',
            'cnpj' => 'nullable|string|max:255',
        ]);

        Fornecedores::create($validatedData);

        return redirect()->route('fornecedores.index')
            ->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    /**
     * Exibe o formulário para editar um fornecedor específico.
     */
    public function edit($id)
    {
        $fornecedor = Fornecedores::findOrFail($id);
        return view('fornecedores.edit', compact('fornecedor'));
    }

    /**
     * Atualiza as informações de um fornecedor específico.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'nullable|string|max:255',
            'cnpj' => 'required|string|max:18', // Verifique a validação do CNPJ conforme necessário
        ]);

        $fornecedor = Fornecedores::findOrFail($id);

        $fornecedor->update([
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'telefone' => $request->input('telefone'),
            'cnpj' => $request->input('cnpj'),
        ]);

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    /**
     * Exclui um fornecedor específico.
     */
    public function destroy($id)
    {
        $fornecedor = Fornecedores::findOrFail($id);
        $fornecedor->delete();

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor deletado com sucesso!');
    }
}
