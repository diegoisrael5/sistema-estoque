<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Editar Cliente</title>

    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #1e1e1e;
            border-radius: 8px;
            padding: 20px;
            margin: 20px auto;
            max-width: 800px;
        }

        h1 {
            color: #f5f5f5;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            color: #e0e0e0;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #333;
            background-color: #2a2a2a;
            color: #e0e0e0;
        }

        .btn {
            padding: 10px 20px;
            margin-top: 10px;
        }

        .btn-success {
            background-color: #4caf50;
            color: #fff;
        }

        .btn-secondary {
            background-color: #9e9e9e;
            color: #fff;
        }

        .error-list {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Editar Cliente</h1>

        <!-- Exibição de erros de validação -->
        @if ($errors->any())
            <div class="error-list">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulário para atualizar os dados do cliente -->
        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Campo para Nome -->
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $cliente->nome) }}" required>
            </div>

            <!-- Campo para Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $cliente->email) }}" required>
            </div>

            <!-- Campo para Telefone -->
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" id="telefone" class="form-control" value="{{ old('telefone', $cliente->telefone) }}">
            </div>

            <!-- Campo para Endereço -->
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" name="endereco" id="endereco" class="form-control" value="{{ old('endereco', $cliente->endereco) }}" required>
            </div>

            <!-- Campo para CPF -->
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" name="cpf" id="cpf" class="form-control" value="{{ old('cpf', $cliente->cpf) }}" required>
            </div>

            <!-- Botões de Ação -->
            <div class="d-flex">
                <button type="submit" class="btn btn-success">Atualizar</button>
                <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>
