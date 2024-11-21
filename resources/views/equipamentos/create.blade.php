<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Adicionar Novo Equipamento</title>

    <!-- Estilo CSS Customizado -->
    <style>
        /* Equipamentos - Estilo Dark */
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 800px;
        }

        h1 {
            color: #f5f5f5;
            font-size: 2rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .btn {
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        .btn-success {
            background-color: #4caf50;
            color: #fff;
            border: none;
        }

        .btn-success:hover {
            background-color: #388e3c;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .form-label {
            color: #f5f5f5;
            font-weight: bold;
        }

        .form-control {
            background-color: #333;
            color: #f5f5f5;
            border: 1px solid #444;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            margin-bottom: 15px;
        }

        .form-control:focus {
            border-color: #6200ea;
            box-shadow: 0 0 0 0.2rem rgba(98, 0, 234, 0.25);
        }
    </style>
</head>
<body>
    <div class="container">

        <h1 class="mb-4">Adicionar Novo Equipamento</h1>

        <form action="{{ route('equipamentos.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>

            <div class="form-group">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" required>
            </div>

            <div class="form-group">
                <label for="quantidade" class="form-label">Quantidade</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" required>
            </div>

            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="{{ route('equipamentos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
