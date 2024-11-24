<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fornecedores</title>

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
            margin-bottom: 20px;
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
        <h1 class="mb-4">Lista de Fornecedores</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>CNPJ</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fornecedores as $fornecedor)
                    <tr>
                        <td>{{ $fornecedor->id }}</td>
                        <td>{{ $fornecedor->nome }}</td>
                        <td>{{ $fornecedor->email }}</td>
                        <td>{{ $fornecedor->telefone }}</td>
                        <td>{{ $fornecedor->cnpj }}</td>
                        <td>
                            <a href="{{ route('fornecedores.edit', $fornecedor->id) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('fornecedores.destroy', $fornecedor->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Nenhum fornecedor encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex">
            <a href="{{ route('fornecedores.create') }}" class="btn btn-primary">Criar Novo Fornecedor</a>
            <a href="{{ route('dashboard') }}" class="btn btn-warning">Voltar Dash</a>
        </div>
    </div>

</body>

</html>
