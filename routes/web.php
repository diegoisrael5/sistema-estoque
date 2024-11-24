<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\EntradaEstoqueController;
use App\Http\Controllers\SaidaEstoqueController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FornecedoresController;
use App\Http\Controllers\FuncionarioController;







/*
|----------------------------------------------------------------------
| Rotas Web
|----------------------------------------------------------------------
*/

// Página Inicial
Route::get('/', function () {
    return view('welcome');
});

// Rotas Autenticadas
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rota para a página de Equipamentos
    Route::get('/equipamentos', function () {
        return view('equipamentos.index');
    })->name('equipamentos.index');

    // Rota para as Entradas de Estoque
    Route::get('/entrada_estoque', [EntradaEstoqueController::class, 'index'])->name('entrada_estoque.index');

    // Rotas de Equipamentos
    Route::resource('equipamentos', EquipamentoController::class)->names([
        'index' => 'equipamentos.index',
        'create' => 'equipamentos.create',
        'store' => 'equipamentos.store',
        'show' => 'equipamentos.show',
        'edit' => 'equipamentos.edit',
        'update' => 'equipamentos.update',
        'destroy' => 'equipamentos.destroy',
    ]);

    // Rotas de Entradas de Estoque
    Route::resource('entradas_estoque', EntradaEstoqueController::class)->names([
        'index' => 'entradas_estoque.index',
        'create' => 'entradas_estoque.create',
        'store' => 'entradas_estoque.store',
        'edit' => 'entradas_estoque.edit',
        'update' => 'entradas_estoque.update',
        'destroy' => 'entradas_estoque.destroy',
    ]);


    Route::get('/entrada_estoque', [EntradaEstoqueController::class, 'index'])->name('entrada_estoque.index');
    Route::get('entrada-estoque/create', [EntradaEstoqueController::class, 'create'])->name('entrada_estoque.create');
    Route::post('entrada-estoque', [EntradaEstoqueController::class, 'store'])->name('entrada_estoque.store');

    Route::put('/entradas_estoque/{id}', [EntradaEstoqueController::class, 'update'])->name('entradas_estoque.update');


    Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/entrada_estoque/{entrada_estoque}/edit', [EntradaEstoqueController::class, 'edit'])->name('entrada_estoque.edit');
    Route::put('/entrada_estoque/{entrada_estoque}', [EntradaEstoqueController::class, 'update'])->name('entrada_estoque.update');
    });

    Route::resource('entrada_estoque', EntradaEstoqueController::class);



    // Rotas de Saídas de Estoque
    Route::resource('saidas_estoque', SaidaEstoqueController::class)->names([
        'index' => 'saidas_estoque.index',
        'create' => 'saidas_estoque.create',
        'store' => 'saidas_estoque.store',
        'show' => 'saidas_estoque.show',
        'edit' => 'saidas_estoque.edit',
        'update' => 'saidas_estoque.update',
        'destroy' => 'saidas_estoque.destroy',
    ]);

    Route::resource('saidas_estoque', SaidaEstoqueController::class);
    Route::get('/saidas_estoque', [SaidaEstoqueController::class, 'index']);
    Route::get('/saidas_estoque', [SaidaEstoqueController::class, 'index'])->name('saidas_estoque.index');
    Route::get('/saidas_estoque/create', [SaidaEstoqueController::class, 'create'])->name('saidas_estoque.create');
    Route::post('/saidas_estoque/store', [SaidaEstoqueController::class, 'store'])->name('saidas_estoque.store');
    Route::resource('saidas_estoque',  SaidaEstoqueController::class);
    Route::get('saidas_estoque/{id}/edit', [SaidaEstoqueController::class, 'edit'])->name('saidas_estoque.edit');
    Route::put('saidas_estoque/{id}', [SaidaEstoqueController::class, 'update'])->name('saidas_estoque.update');





    Route::resource('clientes', App\Http\Controllers\ClienteController::class);
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::resource('clientes', ClienteController::class);
    Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('/clientes/store', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{id}', [ClienteController::class, 'show'])->name('clientes.show');
    Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');



    Route::resource('fornecedores', App\Http\Controllers\FornecedoresController::class);
    Route::resource('fornecedores', FornecedoresController::class);
    Route::get('/fornecedores', [FornecedoresController::class, 'index'])->name('fornecedores.index');
    Route::get('/fornecedores/create', [FornecedoresController::class, 'create'])->name('fornecedores.create');
    Route::post('/fornecedores/store', [FornecedoresController::class, 'store'])->name('fornecedores.store');
    Route::get('/fornecedores/{id}', [FornecedoresController::class, 'show'])->name('fornecedores.show');
    Route::get('/fornecedores/{fornecedor}/edit', [FornecedoresController::class, 'edit'])->name('fornecedores.edit');
    Route::put('/fornecedores/{fornecedor}', [FornecedoresController::class, 'update'])->name('fornecedores.update');
    Route::delete('/fornecedores/{id}', [FornecedoresController::class, 'destroy'])->name('fornecedores.destroy');
    





    Route::resource('funcionarios', App\Http\Controllers\FuncionarioController::class);
    Route::resource('funcionarios', FuncionarioController::class);
    Route::get('/funcionario', [FuncionarioController::class, 'index'])->name('funcionario.index');
    Route::get('/funcionarios/create', [FuncionarioController::class, 'create'])->name('funcionarios.create');
    Route::post('/funcionario/store', [FuncionarioController::class, 'store'])->name('funcionario.store');
    Route::get('/funcionario/{id}', [FuncionarioController::class, 'show'])->name('funcionario.show');
    Route::get('/funcionario/{id}/edit', [FuncionarioController::class, 'edit'])->name('funcionario.edit');
    Route::put('/funcionario/{id}', [FuncionarioController::class, 'update'])->name('funcionario.update');
    Route::delete('/funcionario/{id}', [FuncionarioController::class, 'destroy'])->name('funcionario.destroy');




    // Perfil de Usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Autenticação
require __DIR__.'/auth.php';
