<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Prato - PratoCerto</title>
</head>
<body>
    <nav>
        <a href="{{ url('/') }}">Início</a> |
        <a href="{{ route('ingredientes.index') }}">Ingredientes</a> |
        <a href="{{ route('pratos.index') }}">Pratos</a> |
        <a href="{{ route('fichas-tecnicas.index') }}">Ficha Técnica</a>
    </nav>

    <hr>
    <h1>Cadastrar novo prato</h1>

    @if ($errors->any())
        <div style="color: red;">
            <p>Existem erros no formulário:</p>

            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pratos.store') }}" method="POST">
        @csrf

        <label for="nome">Nome do prato:</label><br>
        <input type="text" name="nome" id="nome" value="{{ old('nome') }}">
        <br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea name="descricao" id="descricao" rows="4" cols="40">{{ old('descricao') }}</textarea>
        <br><br>

        <label for="preco_venda">Preço de venda:</label><br>
        <input type="number" step="0.01" name="preco_venda" id="preco_venda" value="{{ old('preco_venda') }}">
        <br><br>

        <button type="submit">Salvar prato</button>
    </form>

    <br>

    <a href="{{ route('pratos.index') }}">Voltar para a lista</a>
</body>
</html>