<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cadastrar Nova Saída de Estoque</title>

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
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background-color: #4caf50;
            color: #fff;
            border: none;
        }

        .btn-primary:hover {
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

        label {
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
        <h1>Cadastrar Nova Saída de Estoque</h1>

        <form action="{{ route('saidas_estoque.store') }}" method="POST">
            @csrf

            <!-- Equipamento -->
            <div class="form-group">
                <label for="equipamento_id">Equipamento</label>
                <select name="equipamento_id" id="equipamento_id" class="form-control" required>
                    <option value="">Selecione um Equipamento</option>
                    @foreach($equipamentos as $equipamento)
                        <option value="{{ $equipamento->id }}">{{ $equipamento->nome }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Cliente -->
            <div class="form-group">
                <label for="cliente_id">Cliente</label>
                <select name="cliente_id" id="cliente_id" class="form-control" required>
                    <option value="">Selecione um Cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Funcionário -->
            <div class="form-group">
                <label for="funcionario_id">Funcionário</label>
                <select name="funcionario_id" id="funcionario_id" class="form-control" required>
                    <option value="">Selecione um Funcionário</option>
                    @foreach($funcionarios as $funcionario)
                        <option value="{{ $funcionario->id }}">{{ $funcionario->nome }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Quantidade -->
            <div class="form-group">
                <label for="quantidade">Quantidade</label>
                <input type="number" name="quantidade" id="quantidade" class="form-control" required min="1">
            </div>

            <!-- Motivo -->
            <div class="form-group">
                <label for="motivo">Motivo da Saída</label>
                <input type="text" name="motivo" id="motivo" class="form-control" required>
            </div>

            <!-- Data de Saída -->
            <div class="form-group">
                <label for="data_saida">Data de Saída</label>
                <input type="date" name="data_saida" id="data_saida" class="form-control" required>
            </div>

            <!-- Botões de Ação -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{ route('saidas_estoque.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>
