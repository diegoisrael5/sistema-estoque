<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Editar Saída de Estoque</title>

    <!-- Estilo CSS Customizado -->
    <style>
        /* Saída de Estoque - Estilo Dark */
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

        .btn-warning {
            background-color: #ff9800;
            color: #fff;
            border: none;
        }

        .btn-warning:hover {
            background-color: #f57c00;
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
        <!-- Botão de Voltar -->
        <a href="{{ route('saidas_estoque.index') }}" class="btn btn-secondary">Voltar</a>

        <h1 class="mb-4">Editar Saída de Estoque</h1>

        <form action="{{ route('saidas_estoque.update', $saidaEstoque->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Seleção de Equipamento -->
            <div class="mb-3">
                <label for="equipamento_id" class="form-label">Equipamento</label>
                <select name="equipamento_id" id="equipamento_id" class="form-control" required>
                    @foreach($equipamentos as $equipamento)
                        <option value="{{ $equipamento->id }}"
                            {{ old('equipamento_id', $saidaEstoque->equipamento_id) == $equipamento->id ? 'selected' : '' }}>
                            {{ $equipamento->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Quantidade -->
            <div class="mb-3">
                <label for="quantidade" class="form-label">Quantidade</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" value="{{ $saidaEstoque->quantidade }}" required>
            </div>

            <!-- Data de Saída -->
            <div class="mb-3">
                <label for="data_saida" class="form-label">Data de Saída</label>
                <input type="datetime-local" class="form-control" id="data_saida" name="data_saida" value="{{ old('data_saida', \Carbon\Carbon::parse($saidaEstoque->data_saida)->format('Y-m-d\TH:i')) }}" required>
            </div>

            <!-- Botão de Atualizar -->
            <button type="submit" class="btn btn-warning">Atualizar</button>
        </form>
    </div>
</body>
</html>
