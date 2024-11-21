<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Editar Funcionário</title>

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
            max-width: 800px;
        }

        h1 {
            color: #f5f5f5;
            font-size: 2rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            color: #e0e0e0;
            font-size: 1.1rem;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #333;
            background-color: #2a2a2a;
            color: #e0e0e0;
        }

        .form-control:focus {
            border-color: #6200ea;
            background-color: #333;
        }

        .btn {
            padding: 10px 20px;
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
            background-color: #9e9e9e;
            color: #fff;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #757575;
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
        <h1>Editar Funcionário</h1>
        <form action="{{ route('funcionarios.update', $funcionario->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" value="{{ $funcionario->nome }}" required>
            </div>
            <div class="form-group">
                <label for="cargo">Cargo</label>
                <input type="text" name="cargo" id="cargo" class="form-control" value="{{ $funcionario->cargo }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $funcionario->email }}" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" id="telefone" class="form-control" value="{{ $funcionario->telefone }}" required>
            </div>
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" name="cpf" id="cpf" class="form-control" value="{{ $funcionario->cpf }}" required>
            </div>
            <div class="d-flex">
                <button type="submit" class="btn btn-success">Atualizar</button>
                <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

</body>

</html>
