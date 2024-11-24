<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all(); // ou qualquer outro método para obter os clientes
        return view('clientes.index', compact('clientes'));
    }

    // Exibe o formulário para criar um novo cliente
    public function create()
    {
        return view('clientes.create');
    }

    // Armazena um novo cliente no banco de dados
    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'telefone' => 'required|string|max:20',
            'endereco' => 'required|string|max:255',
            'cpf' => 'nullable|string|max:14',
        ]);

        // Criando o cliente
        Cliente::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'endereco' => $request->endereco,
            'cpf' => $request->cpf,

        ]);

        // Redirecionando de volta para a lista de clientes
        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    // Exibe o formulário para editar um cliente existente
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    // Atualiza os dados de um cliente no banco de dados
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'telefone' => 'required|string|max:20',
            'endereco' => 'required|string|max:20',
            'cpf' => 'nullable|string|max:14',

        ]);

        $cliente->update($request->only(['nome', 'email', 'telefone', 'endereco', 'cpf']));

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    // Deleta um cliente
    public function destroy(Cliente $cliente)
    {
        try {
            $cliente->delete();
            return redirect()->route('clientes.index')->with('success', 'Cliente deletado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('clientes.index')->with('error', 'Erro ao tentar deletar o cliente!');
        }
    }
}
