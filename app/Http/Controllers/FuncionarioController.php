<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    /**
     
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('funcionario.create');
    }

    /**
     
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
     
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $funcionarios = Funcionario::all();
        return view('funcionario.index', compact('funcionarios'));
    }

    /**
     
     
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        return view('funcionario.show', compact('funcionario'));
    }

    /**
     
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
   .
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
