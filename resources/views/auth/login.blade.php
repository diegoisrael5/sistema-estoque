<x-guest-layout>
    <div class="container">
        <h1>Login</h1>

        <!-- Session Status -->
        @if(session('status'))
            <div class="mb-4 text-green-500">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>

            <!-- Password -->
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control" required>

            <!-- Remember Me -->
            <div class="mt-3">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="form-checkbox">
                    <span class="ml-2 text-sm text-gray-300">Remember me</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Log in</button>
            </div>

            <!-- Forgot Password -->
            @if (Route::has('password.request'))
                <div class="mt-4 text-center">
                    <a href="{{ route('password.request') }}" class="text-link">Forgot your password?</a>
                </div>
            @endif
        </form>
    </div>

    <style>
        /* Defina o fundo de toda a página como preto */
        body {
            background-color: #000; /* Cor de fundo preta */
            color: #e0e0e0;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Container com fundo escuro */
        .container {
            background-color: #1e1e1e; /* Cor de fundo mais escura para o formulário */
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            max-width: 400px;
        }

        h1 {
            color: #f5f5f5;
            font-size: 1.8rem;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Estilo para os rótulos dos campos */
        .form-label {
            color: #f5f5f5;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        /* Estilo para os campos de entrada */
        .form-control {
            background-color: #333; /* Fundo escuro */
            color: #f5f5f5;
            border: 1px solid #444;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            margin-bottom: 15px;
        }

        /* Efeito no foco dos campos */
        .form-control:focus {
            border-color: #6200ea;
            box-shadow: 0 0 0 0.2rem rgba(98, 0, 234, 0.25);
        }

        /* Botão de login com estilo */
        .btn {
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            width: 100%;
            text-align: center;
            font-weight: bold;
        }

        /* Estilo para o botão primário */
        .btn-primary {
            background-color: #4caf50;
            color: #fff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #388e3c;
        }

        /* Link de "Esqueceu a senha?" */
        .text-link {
            text-align: center;
            display: block;
            margin-top: 10px;
            color: #f5f5f5;
            text-decoration: none;
        }

        .text-link:hover {
            text-decoration: underline;
            color: #ffffff;
        }

        /* Estilo do checkbox */
        .form-checkbox {
            margin-right: 5px;
            accent-color: #4caf50;
        }
    </style>
</x-guest-layout>
