<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Editar Fornecedor</title>

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
    </style>
</head>

<body>
    <div class="container">
        <h1>Editar Fornecedor</h1>

        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulário para atualizar o fornecedor -->
        <form action="{{ route('fornecedores.update', $fornecedor->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $fornecedor->nome) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $fornecedor->email) }}" required>
            </div>

            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" id="telefone" class="form-control" value="{{ old('telefone', $fornecedor->telefone) }}">
            </div>

            <div class="form-group">
                <label for="cnpj">CNPJ</label>
                <input type="text" name="cnpj" id="cnpj" class="form-control" value="{{ old('cnpj', $fornecedor->cnpj) }}" required>
            </div>

            <div class="d-flex">
                <button type="submit" class="btn btn-success">Atualizar</button>
                <a href="{{ route('fornecedores.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>
