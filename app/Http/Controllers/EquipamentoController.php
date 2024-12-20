<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use Illuminate\Http\Request;


class EquipamentoController extends Controller
{

    public function index()
    {
        $equipamentos = Equipamento::all();
        return view('equipamentos.index', compact('equipamentos'));
    }



 
    public function create()
    {
        return view('equipamentos.create');
    }

 
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
            'quantidade' => 'required|integer|min:1',
        ]);

        Equipamento::create($request->all());
        return redirect()->route('equipamentos.index');
    }

   
    public function edit($id)
    {
        $equipamento = Equipamento::findOrFail($id);
        return view('equipamentos.edit', compact('equipamento'));
    }

  
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
            'quantidade' => 'required|integer|min:1',
        ]);

        $equipamento = Equipamento::findOrFail($id);
        $equipamento->update($request->all());
        return redirect()->route('equipamentos.index');
    }

    
    public function destroy($id)
    {
        Equipamento::destroy($id);
        return redirect()->route('equipamentos.index');
    }
}
