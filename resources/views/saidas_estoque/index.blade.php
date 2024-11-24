<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Saída de Estoque</title>

    <!-- Estilo CSS Customizado -->
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

        .form-inline {
            display: flex;
            align-items: center;
        }

        .form-inline .form-group {
            margin-right: 15px;
        }

        .form-inline .btn {
            margin-top: 0;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1 class="mb-4">Lista de Saídas de Estoque</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Equipamento</th>
                    <th>Cliente</th>
                    <th>Funcionário</th>
                    <th>Quantidade</th>
                    <th>Motivo</th>
                    <th>Data de Saída</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($saidasEstoques as $saida)
                    <tr>
                        <td>{{ $saida->id }}</td>
                        <td>
                            @if ($saida->equipamento)
                                {{ $saida->equipamento->nome }}
                            @else
                                Equipamento não encontrado
                            @endif
                        </td>
                        <td>
                            @if ($saida->cliente)
                                {{ $saida->cliente->nome }}
                            @else
                                Cliente não encontrado
                            @endif
                        </td>
                        <td>
                            @if ($saida->funcionario)
                                {{ $saida->funcionario->nome }}
                            @else
                                Funcionário não encontrado
                            @endif
                        </td>
                        <td>{{ $saida->quantidade }}</td>
                        <td>{{ $saida->motivo }}</td>
                        <td>{{ \Carbon\Carbon::parse($saida->data_saida)->format('d/m/Y H:i') }}</td> <!-- Exibe a data no formato desejado -->
                        <td>
                            <!-- Ações: Editar e Deletar -->
                            <a href="{{ route('saidas_estoque.edit', $saida->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('saidas_estoque.destroy', $saida->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Deletar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">Nenhuma saída de estoque encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex">
            <a href="{{ route('saidas_estoque.create') }}" class="btn btn-primary">Criar Nova Saída</a>
            <a href="{{ route('dashboard') }}" class="btn btn-warning">Voltar Dash</a>
        </div>
    </div>

</body>

</html>
