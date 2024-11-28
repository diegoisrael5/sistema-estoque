<?php

namespace App\Http\Controllers;

use App\Models\Fornecedores;
use Illuminate\Http\Request;

class FornecedoresController extends Controller
{

    public function index()
    {
        $fornecedores = Fornecedores::all();
        return view('fornecedores.index', compact('fornecedores'));
    }


    public function create()
    {
        return view('fornecedores.create');
    }


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


    public function edit($id)
    {
        $fornecedor = Fornecedores::findOrFail($id);
        return view('fornecedores.edit', compact('fornecedor'));
    }


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


    public function destroy($id)
    {
        $fornecedor = Fornecedores::findOrFail($id);
        $fornecedor->delete();

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor deletado com sucesso!');
    }
}
