<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Entrada de Estoque</title>

    <style>
        /* Entrada de Estoque - Estilo Dark */
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
            max-width: 1200px;
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

        .btn-primary {
            background-color: #6200ea;
            color: #fff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #3700b3;
        }

        .btn-warning {
            background-color: #ff9800;
            color: #fff;
            border: none;
        }

        .btn-warning:hover {
            background-color: #f57c00;
        }

        .btn-danger {
            background-color: #f44336;
            color: #fff;
            border: none;
        }

        .btn-danger:hover {
            background-color: #d32f2f;
        }

        .table {
            width: 100%;
            margin-top: 20px;
            color: #e0e0e0;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: center;
        }

        .table th {
            background-color: #333;
            color: #fff;
            font-weight: bold;
        }

        .table tr:nth-child(even) {
            background-color: #2a2a2a;
        }

        .table tr:hover {
            background-color: #3b3b3b;
        }

        .d-flex {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

    </style>
</head>
<body>

    <div class="container">
        <h1 class="mb-4">Lista de Entradas de Estoque</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Equipamento</th>
                    <th>Quantidade</th>
                    <th>Data de Entrada</th>
                    <th>Fornecedor</th>
                    <th>Valor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($entradaEstoques as $entrada)
                <tr>
                    <td>{{ $entrada->id }}</td>
                    <td>
                        @if($entrada->equipamento)
                            {{ $entrada->equipamento->nome }}
                        @else
                            Equipamento não encontrado
                        @endif
                    </td>
                    <td>{{ $entrada->quantidade }}</td>
                    <td>{{ \Carbon\Carbon::parse($entrada->created_at)->format('d/m/Y H:i') }}</td>
                    <td>
                        @if($entrada->fornecedor)
                            {{ $entrada->fornecedor->nome }} <!-- Exibe o nome do fornecedor -->
                        @else
                            Fornecedor não encontrado
                        @endif
                    </td>
                    <td>
                        {{ number_format($entrada->valor, 2, ',', '.') }} <!-- Exibe o valor formatado -->
                    </td>
                    <td>
                        <a href="{{ route('entrada_estoque.edit', $entrada->id) }}" class="btn btn-warning btn-sm">Atualizar</a>
                        <form action="{{ route('entrada_estoque.destroy', $entrada->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Nenhum registro encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('entrada_estoque.create') }}" class="btn btn-primary">Criar Nova Entrada</a>
            <a href="{{ route('dashboard') }}" class="btn btn-warning ms-auto">Voltar Dash</a>
        </div>

    </div>

</body>
</html>
