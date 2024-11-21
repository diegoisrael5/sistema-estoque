<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    /**
     * Exibe o formulário para criação de um novo funcionário.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('funcionario.create');
    }

    /**
     * Armazena um novo funcionário no banco de dados.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateFuncionario($request);

        Funcionario::create($validatedData);

        return redirect()->route('funcionarios.index')
                         ->with('success', 'Funcionário cadastrado com sucesso!');
    }

    /**
     * Exibe a lista de funcionários.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $funcionarios = Funcionario::all();
        return view('funcionario.index', compact('funcionarios'));
    }

    /**
     * Exibe as informações de um funcionário específico.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        return view('funcionario.show', compact('funcionario'));
    }

    /**
     * Exibe o formulário de edição de um funcionário.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        return view('funcionario.edit', compact('funcionario'));
    }

    /**
     * Atualiza as informações de um funcionário específico.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateFuncionario($request, $id);

        $funcionario = Funcionario::findOrFail($id);
        $funcionario->update($validatedData);

        return redirect()->route('funcionarios.index')
                         ->with('success', 'Funcionário atualizado com sucesso!');
    }

    /**
     * Remove um funcionário específico do banco de dados.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $funcionario->delete();

        return redirect()->route('funcionarios.index')
                         ->with('success', 'Funcionário removido com sucesso!');
    }

    /**
     * Valida os dados do funcionário.
     *
     * @param \Illuminate\Http\Request $request
     * @param int|null $id
     * @return array
     */
    private function validateFuncionario(Request $request, $id = null)
    {
        return $request->validate([
            'nome' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'email' => 'required|email|unique:funcionarios,email' . ($id ? ',' . $id : ''),
            'telefone' => 'required|string|max:15',
            'cpf' => 'required|string|max:15|unique:funcionarios,cpf' . ($id ? ',' . $id : ''),
        ]);
    }
}
